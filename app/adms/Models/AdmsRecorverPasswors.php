<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

// ARQUIVO DE RECUPERAÇÃO DE SENHA, RECEBE O EMAIL DE USUÁRIO E VERIFICA SE O MESMO EXISTE E ENVIA A CHAVE PARA A RECUPERAÇÃO DA SENHA
class AdmsRecorverPasswors
{
  private array $dataSave; //RECEBE OS DADOS QUE VAI SER ENVIADO PARA O EXEUPDATE
  private array|null $data; // RECEBE OS DADOS DO FORMULARIO 
  private string $firstName; // RECEBE O PRIMEIRO NOME DO USUARIO
  private array $emailData; //RECEBE OS DADOS A SER ENVIADO PARA O EMAIL
  private bool $result; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private array $resultBd; // recebe os registro do banco de dados
  private string $url; // RECEBE A CHAVE DA URL
  //RECEBE O RESULTADO DA CLASS
  public function getResult()
  {
    return $this->result;
  }
  //METODO DE CONFIRMAÇÃO, SE EXISTE DADOS NO FORMULARIO
  public function recoverPass(array $data = NULL): void
  {
    $this->data = $data;
   // var_dump($this->data);
    $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
    $valEmptyField->valField($this->data);
    if ($valEmptyField->getResult()) {
      $this->valUserConfNewUser();
      $this->result = true;
    } else {
      $this->result = false;
    }
  }
  //METODO DE VALIDAÇÃO DE USUARIO, VERIFICA SE AQUELE EMAIL EXISTE PARA AQUELE ID
  private function valUserConfNewUser(): void
  {
    $newConfEmail = new \App\adms\Models\helper\AdmsRead();
    $newConfEmail->fullRead("SELECT id,name,email FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->data['email']}&limit=1");
    $this->resultBd = $newConfEmail->getResult();
    if ($this->resultBd) {
      $this->valNewConfEmail();
    } else {
      $this->result = false;
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: E-mail Digitado Errado, ou Não Cadastrado! </p>";
      
    }
  }
  // METODO DE PARA ENVIO DO NOVO CHAVE, PARA RECUPERA A SENHA
  private function valNewConfEmail(): void
  {
    $this->dataSave['recover_password'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
    $this->dataSave['modified'] = date("Y-m-d H:i:s");
    
    $upNewConfEmail = new \App\adms\Models\helper\AdmsUpdate();
    $upNewConfEmail->exeUpdate("adms_users", $this->dataSave,  "WHERE  id=:id", "id={$this->resultBd[0]['id']}");

    if ($upNewConfEmail->getResult()) {
      $this->resultBd[0]['recover_password'] = $this->dataSave['recover_password'];
      $this->sendEmail();
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Email link Nao enviado tente novamente</p>";
      $this->result = false;
    }
  }
  //METODO DE ENVIO ALTOMATICO DE EMAIL
  private function sendEmail(): void
  {
    $objSendEmail = new \App\adms\Models\helper\AdmsSendEmail();
    $this->emailHtml();
    $this->emailTxt();
    $objSendEmail->sendEmail($this->emailData, 1);

    if ($objSendEmail->getResult()) {
      $_SESSION['msg'] = "<p style='color:green;'>Novo Link enviado com Sucesso!
    Acesse a sua caixa de email, para recuperar sua senha.</p>";
      $this->result = true;
    } else {
      $this->fromEmail = $objSendEmail->getFromEmail();
      $_SESSION['msg'] = "<p style='color:#f00;'> Email com as intruções para recuperação de senha na enviado, 
      entre em contato com o suporte {$this->fromEmail} !</p>";
      $this->result = false;
    }
  }
  private function emailHtml(): void
  {
    $name = explode(" ", $this->resultBd[0]['name']);
    $this->firstName = $name[0];

    $this->emailData['toEmail'] = $this->data['email'];
    $this->emailData['toName'] = $this->resultBd[0]['name'];
    $this->emailData['subject'] = "Recuperar seu Senha ";
    //criando o redirecionamento da url coma chave
    $this->url = URLADM . "update-password/index?key=" . $this->resultBd[0]['recover_password'];

    $this->emailData['contentHtml'] = "Presado(a) {$this->firstName} <br><br>";
    $this->emailData['contentHtml'] .= "Voçê solicitação uma recuperação de senha em nosso site<br>";
    $this->emailData['contentHtml'] .= "Para que possamos concluir a alteração em nosso sistema, clicando no link abaixo,
     se voçê não fez essa solicitação ignore a mensagem<br>";
    $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}<a> <br><br>";
    $this->emailData['contentHtml'] .= "Esta mensagem foi enviada pela empresa XXX. 
     Informamos  que não enviamos aquivos em anexo, e nem solicitamos nenhum prenchimento de senha ou
      informações de cadrastro<br>";
  }
  private function emailTxt(): void
  {
    $this->emailData['contentText'] = "Presado(a) {$this->firstName}<b> \n\n";
    $this->emailData['contentText'] .= "Voçê solicitação uma recuperação de senha em nosso site\n";
    $this->emailData['contentText'] .= "Para que possamos concluir a alteração em nosso sistema, clicando no link abaixo\n";
    $this->emailData['contentText'] .= $this->url . " \n\n";
    $this->emailData['contentText'] .= "Esta mensagem foi enviada pela empresa XXX\n 
    Informamos  que não enviamos aquivos em anexo, e nem solicitamos nenhum prenchimento de senha ou
     informações de cadrastro\n";
  }
}
