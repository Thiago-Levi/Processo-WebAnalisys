<?php

namespace Usuario\Controller;

use Exception;
use Usuario\Form\UsuarioForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use PhpParser\Node\Stmt\TryCatch;

class UsuarioController extends AbstractActionController{
  
  private $table;

  public function __construct($table)
  {
    $this->table = $table;
  }
  
  public function indexAction(){
    return new ViewModel(["usuarios" => $this->table->getAll()]);
  }

  public function cadastrarAction(){

    $form = new UsuarioForm();
    $form->get("submit");
    $request = $this->getRequest();
    
    if($request['REQUEST_METHOD'] != 'POST'){
      return new ViewModel(['form' => $form]);

    }
  
    $usuario = new \Usuario\Model\Usuario();
    $form->setData($request->getPost());

    if(!$form->isValid()){
      return new ViewModel(['form' => $form]);
    }
    
    $usuario->exchageArray($form->getData());
    $this->table->salvarUsuario($usuario);
    return $this->redirect()->toRoute('usuario');
  }


  public function editarAction(){
    $id = (int) $this -> params()->fromRoute('id');
    
    if(0 === $id){
      return $this->redirect()->toRoute('usuario', ['action' => 'cadastrar']);
    }

    Try{ 
      $usuario = $this->table->getUsuario($id);
    } catch(Exception $exc){
      return $this->redirect()->toRoute('usuario', ['action' => 'index']);
    }

    $form = new UsuarioForm();
    $form->bind($usuario);
    $form->get('submit')->setAttribute('value', 'Cadastrar');
    $request = $this->getRequest();
    $viewData  = ['id' =>$id, 'form' => $form];
    
    if($request['REQUEST_METHOD'] != 'POST'){
      return $viewData;
    }

    $form->setData($request->getPost());

    if(!$form->isValid()){
      return $viewData;
    }
    
    $this->table->salvarUsuario($form->getData());
    return $this->redirect()->toRoute('usuario');

  
  }

  public function removerAction(){
    $id = (int) $this -> params()->fromRoute('id', 0);
    
    if(0 === $id){
      return $this->redirect()->toRoute('usuario');
    }

    $request = $this->getRequest();

    if($request['REQUEST_METHOD'] == 'POST'){
      $del = $request->getPost('del', 'Não');
      if($del == 'Sim'){
        $id = (int) $request->getPost('id');
        $this->table->deletePessoa($id);

      }

      return $this->redirect()->toRoute('usuario');
    }

    return ['id' =>$id, 'usuario' => $this->table->getUsuario($id)];
  }

  
}

// a rota /usuario --> retorna o indexAction()
// a rota /usuario/cadastrar --> retorna cadastrarAction()
// a rota /usuario/salvar --> retorna salvarAction()
// a rota /usuario/editar/1 --> editarAction()
// a rota /usuario/remover/1 --> removerAction()
// a rota /usuario/confirmacao --> confirmacaoAction()
