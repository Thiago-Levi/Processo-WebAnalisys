<?php

namespace Usuario\Model;


class Usuario{
  private $id;
  private $nome;
  private $email;
  private $senha;

  public function exchageArray(array $data){
    $this->id = !empty($data["id"]) ? $data["id"] : null;
    $this->nome = !empty($data["nome"]) ? $data["nome"] : null;
    $this->email = !empty($data["email"]) ? $data["email"] : null;
    $this->senha = !empty($data["senha"]) ? $data["senha"] : null;

  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id = $id;
  }

  public function getNome(){
    return $this->nome;
  }
  public function setNome($nome){
    $this->nome = $nome;
  }

  public function getEmail(){
    return $this->email;
  }
  public function setEmail($email){
    $this->email = $email;
  }

  public function getSenha(){
    return $this->senha;
  }
  public function setSenha($senha){
    $this->senha = $senha;
  }

}


