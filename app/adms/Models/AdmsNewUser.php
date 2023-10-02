<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//ARQUIVO DA CADASTRO DE USUÁRIO
class AdmsNewUser
{
  private array|null $data; // RECEBE OS DADOS DO FORMULARIO
  private $result; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
   private string $fromEmail; // RECEBE O RESULTADO DO METODO FORMEMAIL() DA CLASSE SENDEMAIL, NO RECUPERA O EMAIL DO DESTINATARIO
   private string $firstName; // RECEBE O PRIMEIRO NOME DO USUARIO
   private array $emailData; //RECEBE OS DADOS A SER ENVIADO PARA O EMAIL
    private string $url; // recebe os dados para o usuario confirmar o email

  public function getResult()
  {
    return $this->result;
  }

  public function creatUsr(array $data = null)
  {
    $this->data = $data;
 
    //intancia o arquivo que valida os dados
    $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
    $valEmptyField->valField($this->data);
    //intanciar o resultado da validação, dentro de uma condição
    if ($valEmptyField->getResult()) {
      $this->valInput();
    } else {
      //    $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Necessário Preencher todos os Campos!</p>";
      $this->result = false;
    }
  }
  //METODO PARA VALIDAÇAO DE EMAIL
  private function valInput(): void
  {
    $valEmail = new \App\adms\Models\helper\AdmsValEmail();
    $valEmail->validateEmail($this->data['email']);

    $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
    $valEmailSingle->validateEmailSingle($this->data['email']);

    $valpassword = new \App\adms\Models\helper\AdmsValPassword();
    $valpassword->validatePassword($this->data['password']);

    $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingleLogin();
    $valUserSingleLogin->validateUserSingleLogin($this->data['email']);

    if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valpassword->getResult()) and ($valUserSingleLogin->getResult())) {
      $this->addEmail();
    } else {
      $this->result = false;
    }
  }
  //METODO DE PARA ADICIONAR EMAIL
  private function addEmail(): void
  {
    //criptografar senha
    $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
    // converter email em user
    $this->data['user'] = $this->data['email'];
    //CRIAR UMA CHAVE DE CONFIRMAÇÃO DO EMAIL
    $this->data['conf_email'] = password_hash($this->data['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
    //converter a data para o padrão comum
    $this->data['created'] = date("Y-m-d H:i:s");

    $creatUser =  new \App\adms\Models\helper\AdmsCreate();
    $creatUser->exeCreate("adms_users", $this->data);
    
    if ($creatUser->getResult()) {
      $this->sendEmail();
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario Nao Cadastrado </p>";
      $this->result = false;
    }
  }
  private function sendEmail(): void
  {//METODO CONTEUDO HTML
    $this->contentEmailHtml();
    //METODO CONTEUDO TXT
    $this->contentEmailText();
    //CLASSE DE CONFIGURAÇÃO DE ENVIO DE EMAIL
    $sendEmail = new \App\adms\Models\helper\AdmsSendEmail();
    //METODE DA CLASSE DE CONFIGURAÇÃO DE ENVIO DE EMAIL
    $sendEmail->sendEmail($this->emailData, 2);
    //METODE QUE TEM O RESULTADO DA EXECUÇÃO DA CLASSE DE ENVIO DE EMAIL
    if ($sendEmail->getResult()) { 
      $_SESSION['msg'] = "<p style='color:green;'>Usuario Cadastrado com Sucesso!
       Acesse a sua caixa de email para confirma o email</p>";
      $this->result = true;
    } else {
      $this->fromEmail = $sendEmail->getFromEmail();
      $_SESSION['msg'] = "<p style='color:#f00;'>Usuario Cadastrado com Sucesso!
       Erro no envio de email de confirmação entre em contato com o suporte {$this->fromEmail} !</p>";
      $this->result = false;
    }
  }
  //CONTEUDO HTML A SER ENVIADO PARA O EMAIL
  private function contentEmailHtml(): void
  {
    $name = explode(" ",$this->data['name']);
   // var_dump($name);
    $this->firstName = $name[0];
    $this->emailData['toEmail'] = $this->data['email'];
    $this->emailData['toName'] = $this->data['name'];
    $this->emailData['subject'] = "Confirme sua conta";
    //fazendo um redirecionamento de pagina
    $this->url = URLADM ."Con-Email/index?key=". $this->data['conf_email'];

    $this->emailData['contentHtml'] = "Presado(a) {$this->firstName} <br><br>";
    $this->emailData['contentHtml'] .="Agradecemos a sua solicitação de cadastro em nosso site<br>";
    $this->emailData['contentHtml'] .= "Para que possamos concluir o cadastro em nosso sistema solicite
     a confirmação do email clicando no link abaixo<br>";
    $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}<a> <br><br>";
    $this->emailData['contentHtml'] .= "Esta mensagem foi enviada pela empresa XXX. 
    Informamos  que não enviamos aquivos em anexo, e nem solicitamos nenhum prenchimento de senha ou
     informações de cadrastro<br>";
  }

  //CONTEUDO TXT A SER ENVIADO PARA O EMAIL
  private function contentEmailText():void
  {
      $this->emailData['contentText'] = "Presado(a) {$this->firstName}<b> \n\n";
    $this->emailData['contentText'] .="Agradecemos a sua solicitação de cadastro em nosso site\n";
    $this->emailData['contentText'] .= "Para que possamos concluir o cadastro em nosso sistema solicite
     a confirmação do email clicando no link abaixo\n";
    $this->emailData['contentText'] .= $this->url ." \n\n";
    $this->emailData['contentText'] .= "Esta mensagem foi enviada pela empresa XXX\n 
    Informamos  que não enviamos aquivos em anexo, e nem solicitamos nenhum prenchimento de senha ou
     informações de cadrastro\n";

  }
}
