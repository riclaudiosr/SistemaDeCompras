<?php

namespace App\adms\Controllers;

if (!defined('RSR1937NA')) {
   //   header("Location: /");
   die("Erro: pagina nao encontrada");
}
// pagina listar usuario no banco
class ListUsers
{
   private array|string|null $data;

   /** @var array $dataForm Recebe os dados do formulario */
   private array|null $dataForm;

   /** @var string|int|null $page Recebe o número página */
   private string|int|null $page;

   /** @var string|null $searchName Recebe o nome do usuario */
   private string|null $searchName;

   /** @var string|null $searchEmail Recebe o email do usuario */
   private string|null $searchEmail;

   public function index(string|int|null $page = null): void
   {

      $this->page = (int) $page ? $page : 1;

      $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
   //   var_dump($this->dataForm);


      $this->searchName = filter_input(INPUT_GET, 'search_name', FILTER_DEFAULT);
      $this->searchEmail = filter_input(INPUT_GET, 'search_email', FILTER_DEFAULT);

      $listUsers = new \App\adms\Models\AdmsListUsers();

      if (isset($this->dataForm['SendSearchUser'])) {

         $listUsers->listSearchUsers($this->page, $this->dataForm['search_name'], $this->dataForm['search_email']);
         $this->data['form'] = $this->dataForm;
      } elseif ((!empty($this->searchName)) or (!empty($this->searchEmail))) {
         $listUsers->listSearchUsers($this->page, $this->searchName, $this->searchEmail);
         $this->data['form']['search_name'] = $this->searchName;
         $this->data['form']['search_email'] = $this->searchEmail;
      } else {
         $listUsers->listUsers($this->page);
      }

      if ($listUsers->getResult()) {
         $this->data['listUsers'] = $listUsers->getResultBd();
         $this->data['pagination'] = $listUsers->getResultPg();
      } else {
         $this->data['listUsers'] = [];
         $this->data['pagination'] = "";
      }

      $this->data['sidebarActive'] = "list-users";

      $viewCon = new \Core\ConfigView("adms/Views/users/listUser", $this->data);
      $viewCon->loadViewLogin();
   }
}
