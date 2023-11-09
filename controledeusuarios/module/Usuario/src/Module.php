<?php

namespace Usuario;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Usuario\Controller\UsuarioController;
use Usuario\Model\UsuarioTable;


class Module implements ConfigProviderInterface{
  
  public function getConfig()
  {
    return include __DIR__."/../config/module.config.php";
  }

  public function getServiceConfig(){
    return [
      'factories' =>[
        Model\UsuarioTable::class => function($container){
          $tableGateway = $container->get(Model\UsuarioTableGateway::class);
          return new UsuarioTable($tableGateway);
          var_dump($tableGateway);
          die;
        },
        Model\UsuarioTableGateway::class => function($container){
          $dbAdapter = $container->get(AdapterInterface::class);
          $resultSetPrototype = new ResultSet();
          $resultSetPrototype->setArrayObjectPrototype(new Model\Usuario());
          return new TableGateway('usuario', $dbAdapter, null, $resultSetPrototype);
        },
      ] 
    ];
  }

  public function getControllerConfig(){
    return [
      'factories' => [
        UsuarioController::class => function($container){
          $tableGateway = $container->get(Model\UsuarioTable::class);
          return new UsuarioController($tableGateway);
        },
      ]
    ];
  }
}

//Pdo_Pgsql: PostgreSQL via the PDO extension

