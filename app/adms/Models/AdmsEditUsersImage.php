<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

// Editar a imagem do usuário no banco de dados
class AdmsEditUsersImage
{
    private bool $result = false; // $result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private array|null $resultBd; //$resultBd Recebe os registros do banco de dados
    private int|string|null $id; //$id Recebe o id do registro 
    private array|null $data; // $data Recebe as informações do formulário 
    private array|null $dataImage; //$dataimage Recebe os dados da imagem
    private string $diretory; //$diretório Recebe o endereço de upload da imagem 
    private string $delImg; //$delImg Recebe o endereço da image que deve ser deletada
    private string $nameImg; //$nameImg Recebe o nome da imagem com as correções de caracteres especiais
    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function viewEditUser(int $id): bool
    {
        $this->id = $id;
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead(
            "SELECT id, image
                            FROM adms_users
                            WHERE id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );

        $this->resultBd = $viewUser->getResult();
        if ($this->resultBd) {
            $this->result = true;
            return  true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuário não encontrado!</p>";
            $this->result = false;
            return false;
        }
    }
    // Editar a image no banco
    public function update(array $data = null): void
    {
        $this->data = $data;
        $this->dataImage = $this->data['new_image'];
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
    //VERIFICAR SE EXISTE O USUÁRIO COM O ID RECEBIDO
    private function valInput(): void
    {
        $validateImage = new \App\adms\Models\helper\AdmsValExtImg();
        $validateImage->validateExtImg($this->dataImage['type']);

        if (($this->viewEditUser($this->data['id'])) and ($validateImage->getResult())) {
            //  $this->result = false;
            $this->upload();
        } else {

            $this->result = false;
        }
    }
    // mandar a imagem para o servidor
    private function upload(): void
    {
        $slugImg = new \App\adms\Models\helper\AdmsSlugText();
        $this->nameImg = $slugImg->slug($this->dataImage['name']);

        $this->diretory = "app/adms/assets/img/users/" . $this->data['id'] . "/";

        $uploadImageRes = new \App\adms\Models\helper\AdmsUploadimgRes();
        $uploadImageRes->upload($this->dataImage, $this->diretory, $this->nameImg, 300, 300);

        if ($uploadImageRes->getResult()) {
            $this->editImage();
        } else {
            $this->result = false;
        }
    }
    // 
    private function editImage(): void
    {
        unset($this->data['new_image']);

        $this->data['image'] = $this->nameImg;
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<p style='color:green'>Imagem editado com sucesso!</p>";

            $this->delitImage();
        } else {
            //   $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
            $this->result = false;
        }
    }
    //APAGA O ARQUIVO QUE JA EXIASTE NO BANCO
    private function delitImage(): void
    {
        if (((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null)) and ($this->resultBd[0]['image'] != $this->nameImg)) {
            $this->delImg =  "app/adms/assets/img/users/" . $this->data['id'] . "/" . $this->resultBd[0]['image'];
            if (file_exists($this->delImg)) {
                unlink($this->delImg);
            }
        }
        $_SESSION['msg'] = "<p style='color:green;'>Imagem editado com sucesso!</p>";
        $this->result = true;
    }
}
