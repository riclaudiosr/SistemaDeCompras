<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}

//ARQUIVO PARA Editar a imagem do perfil do usuaário USUARIO
class AdmsEditProfileImg
{
    private array $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
    private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
    private array|null $data; // RECEBE OS DADOS DO FORMULARIO
    private string $nameImg; 
    private string $diretory; 
    private  $dataImage; 
    private string $delImg; 
    

    //RECEBE O RESULTADO DA CLASSE E RETORNA OS REGISTRO DO BANCO
    public function getResult(): bool
    {
        return $this->result;
    }
    //RECEBE O RESULTADO DA BUSCA NO BANCO, E RETORNA
    public function getResultBd(): array
    {
        return $this->resultBd;
    }

    public function viewEditProfileImg()
    {
        //BUSCAR O DADOS QUE JÁ EXITE NO BANCO 
        $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
        $viewAdmsRead->fullRead("SELECT id,image FROM adms_users WHERE id=:id LIMIT :limit", "id=" . $_SESSION['user_id'] . "&limit=1");
        $this->resultBd = $viewAdmsRead->getResult();
        if ($this->resultBd) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Perfil não encontrado!!<p>";
            $this->result = false;
            return false;
        }
    }
    //RECEBE O DADOS PASSADO PELO FORMULÁRIO
    public function update(array $data = null): void
    {
        $this->data = $data;
        $this->dataImage = $this->data['new_image'];
        //VERIFICA SE TEM COMPOS VAZIO NO FORMULÁRIO
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {

            if (!empty($this->dataImage['name'])) {
                $this->result = false;
                $this->valInput();
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Necessário selecionar uma imagem!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    //REALIZA O UPLOAD
    private function valInput(): void
    {
        //VERIFICA A EXTENÇÃO DA IMAGEM
        $validateImage = new \App\adms\Models\helper\AdmsValExtImg();
        $validateImage->validateExtImg($this->dataImage['type']);

        if (($this->viewEditProfileImg()) and ($validateImage->getResult())) {
            $this->upload();
        } else {
            $this->result = false;
        }
    }
    //RELIZA O UPLOADE DA IMAGEM
    private function upload(): void
    {
        //RELPE PRA EDITAR O TESTO ENVIADO PELO USUARIO COMO O NOME DA IMAGEM 
        $slugImg = new \App\adms\Models\helper\AdmsSlugText();
        $this->nameImg = $slugImg->slug($this->dataImage['name']);

        $this->diretory = "app/adms/assets/img/users/" . $_SESSION['user_id'] . "/";
        //RELPE DE REDIMENCIONAMENTE PADRÃO PARA A IMAGEM
        $uploadImageRes = new \App\adms\Models\helper\AdmsUploadimgRes();
        $uploadImageRes->upload($this->dataImage, $this->diretory, $this->nameImg, 300, 300);

        if ($uploadImageRes->getResult()) {
            $this->editImage();
        } else {
            $this->result = false;
        }
    }
    //TROCA A IMAGEM ANTIGA PELA NOVA ENVIADA PELO USUÁRIO
    private function editImage(): void
    {
        //DESTROI A POSIÇÃO DO ARRAY QUE NAO SERAR USADA PELO BANCO
        unset($this->data['new_image']);

        $this->data['image'] = $this->nameImg;
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$_SESSION['user_id']}");

        if ($upUser->getResult()) {
            //A VARIAVEL GLOBAL DA IMAGEM RECEBE A IMAGEM NOVA
            $_SESSION['user_image'] =  $this->nameImg;

            $this->delitImage();
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Imagem não editado com sucesso!</p>";
            $this->result = false;
        }
    }
    //METODO APAGA A IMAGEM ANTIGA 
    private function delitImage(): void
    {
        if (((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null)) and ($this->resultBd[0]['image'] != $this->nameImg)) {
            $this->delImg =  "app/adms/assets/img/users/" . $_SESSION['user_id'] . "/" . $this->resultBd[0]['image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }
        $_SESSION['msg'] = "<p style='color:green;'>Imagem editado com sucesso!</p>";
        $this->result = true;
    }
}
