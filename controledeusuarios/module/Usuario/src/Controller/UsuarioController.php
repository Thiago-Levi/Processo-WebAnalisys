<?php

namespace Usuario\Controller;

use Usuario\Form\UsuarioForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class UsuarioController extends AbstractActionController{
  
  private $table;

  public function __construct($table)
  {
    $this->table = $table;
  }
  
  public function indexAction()
  {
    return new ViewModel(["usuarios" => $this->table->getAll()]);
  }

  public function cadastrarAction()
  {

    $form = new UsuarioForm();
    $form->get("Cadastrar");
    $request = $this->getRequest();
    
    if($request['REQUEST_METHOD'] != 'POST'){
      return new ViewModel(['form' => $form]);

    }
  
    $usuario = new \Usuario\Model\Usuario();
    $form->setData($request->getPost());
    
    return new ViewModel();
  }

  public function salvarAction(){
    return new ViewModel();
  }

  public function editarAction(){
    return new ViewModel();
  }

  public function removerAction(){
    return new ViewModel();
  }

  public function confirmacaoAction(){

  }
}

// a rota /usuario --> retorna o indexAction()
// a rota /usuario/cadastrar --> retorna cadastrarAction()
// a rota /usuario/salvar --> retorna salvarAction()
// a rota /usuario/editar/1 --> editarAction()
// a rota /usuario/remover/1 --> removerAction()
// a rota /usuario/confirmacao --> confirmacaoAction()
