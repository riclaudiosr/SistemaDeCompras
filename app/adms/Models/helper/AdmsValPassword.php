<?php
namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
   
//ARQUIVO RELPE DE VALIDAÇÃO DE SENHA EM PHP, COM EXIGÊNCIA ESPECIFICA

class AdmsValPassword
{
    private string $password; //$password Recebe a senha que deve ser validada 
    private bool $result; //$result Recebe true quando executar o processo com sucesso e false quando houver erro 
    function getResult(): bool //Retorna true quando executar o processo com sucesso e false quando houver erro
    {
        return $this->result;
    }

    public function validatePassword(string $password): void
    {
        $this->password = $password;
        if (stristr($this->password, "'")) {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Caracter ( ' ) utilizado na senha inválido!</p>";
            $this->result = false;
        } else {
            if (stristr($this->password, " ")) {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Proibido utilizar espaço em branco no campo senha!</p>";
                $this->result = false;
            } else {
                $this->valExtensPassword();
            }
        }
    }
    private function valExtensPassword(): void
    {
        if (strlen($this->password) < 6) {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
            $this->result = false;
        } else {
            $this->valValuePassword();
        }
    }
    private function valValuePassword(): void
    {
        if(preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9-@#$%;*]{6,}$/', $this->password)){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: A senha deve ter letras e números!</p>";
            $this->result = false;
        }
    }
}
