<?php

namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;

//ARQUIVO RELPE DE ENVIO DE EMAIL ALTOMATIVO ATRAVES DO PHPMAILLER
class AdmsSendEmail
{
    private array $data; // $data Receber as informações do conteúdo do e-mail
    private array $dataInfoEmail; //$dataInfoEmail Receber as credenciais do e-mail
    private int $optionEmail; //recebe o id do email que sera enviado
    private bool $result; //$result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private string $fromEmail = EMAILADM; //$fromEmail Recebe o e-mail do remetente 

    // Retorna true quando executar o processo com sucesso e false quando houver erro
    function getResult(): bool
    {
        return $this->result;
    }
    function getFromEmail(): string
    {
        return $this->fromEmail;
    }
    public function sendEmail(array $data, int $optionEmail): void
    {
        $this->optionEmail = $optionEmail;
        $this->data = $data;

        $this->infoPhpMailer();
    }
    private function infoPhpMailer(): void
    {
        $connEmail = new \App\adms\Models\helper\AdmsRead();
        $connEmail->fullRead("SELECT name,email,host,username,password,smtpsecure,port FROM adms_conf_email
                             WHERE id =:id LIMIT :limit", "id={$this->optionEmail}&limit=1");
        $dataBanco = $connEmail->getResult();
        if ($dataBanco) {
            // QUEM ESTA ENVIANDO busca do banco de dados
            $this->dataInfoEmail['host'] = $dataBanco[0]['host'];
            $this->dataInfoEmail['fromEmail'] = $dataBanco[0]['email'];
            $this->fromEmail = $this->dataInfoEmail['fromEmail'];
            $this->dataInfoEmail['fromName'] = $dataBanco[0]['name'];
            $this->dataInfoEmail['username'] = $dataBanco[0]['username'];
            $this->dataInfoEmail['password'] = $dataBanco[0]['password'];
            $this->dataInfoEmail['smtpsecure'] = $dataBanco[0]['smtpsecure'];
            $this->dataInfoEmail['port'] = $dataBanco[0]['port'];
            $this->sendEmailPhpMailer();
        } else {
            $this->result = false;
        }
    }

    private function sendEmailPhpMailer(): void
    {
        //  $mail = new PHPailer(true);
        $mail = new PHPMailer(true);
        //  $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = $this->dataInfoEmail['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->dataInfoEmail['username'];
            $mail->Password   = $this->dataInfoEmail['password'];
            $mail->SMTPSecure = $this->dataInfoEmail['smtpsecure'];
            $mail->Port       = $this->dataInfoEmail['port'];
            // REMETENTE
            $mail->setFrom($this->dataInfoEmail['fromEmail'], $this->dataInfoEmail['fromName']);
            //DESTINATARIO
            $mail->addAddress($this->data['toEmail'], $this->data['toName']);

            $mail->isHTML(true);
            //ASSUNTO
            $mail->Subject = $this->data['subject'];
            //CONTEUDO HTML
            $mail->Body    = $this->data['contentHtml'];
            //CONTEUDO TEXT
            $mail->AltBody = $this->data['contentText'];

            $mail->send();
            $this->result = true;
        } catch (GlobalException $err) {
            $this->result = false;
        }
    }
}
