<?php

namespace Usuario\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class UsuarioTable{
  private $tableGateway;
  
  public function __construct(TableGatewayInterface $tableGateway)
  {
      $this->tableGateway = $tableGateway;
  }

  public function getAll(){
    return $this->tableGateway->select();
  }

  public function getUsuario($nome){
    $rowset = $this->tableGateway->select(['nome' => $nome]);
    $row = current($rowset);
  
    if(!$row){
      throw new RuntimeException("Não há usuárío com esse nome.");
    }

    return $row;
  }

  public function salvarUsuario(Usuario $usuario){
    $data = [
      "nome" => $usuario->getNome(),
      "email" => $usuario->getEmail(),
      "senha" => $usuario->getSenha()

    ];

    $id = (int) $usuario->getId();
    
    if($id === 0){
      $this->tableGateway->insert($data);
      return;
    }

    $this->tableGateway->update($data, ["id"=>$id]);

  }

  public function deletarUsuario($id){
    $this->tableGateway->delete(["id" =>(int)$id]);
  }
}

