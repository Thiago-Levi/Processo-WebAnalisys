<?php

namespace Usuario;

use Laminas\ServiceManager\Factory\InvokableFactory;

return [
  'router' => [
    'routes' =>[
      'usuario' =>[
        'type' => \Laminas\Router\Http\Segment::class,
        'options' => [
          'route' => '/usuario[/:action[/:id]]',
          'constraints' => [
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]+'
          ],
          'defaults' => [
            'controller' => Controller\UsuarioController::class,
            'action' => 'index',
          ],
        ],
      ],
    ],
  ],
  'controllers' => [
    'factories' =>[
     // Controller\UsuarioController::class => InvokableFactory::class,
    ],
  ],
  'view_manager' => [
    'template_path_stack' => [
      'usuario' => __DIR__ . '/../view'
    ],
  ],
  'db' =>[
    'driver' => 'Pdo_Pgsql',
    'database' => 'usuario',
    'username' => 'troquePorSeuUserNameLocal',
    'password' => 'troquePorSuaSenhaNameLocal',
    'hostname' => 'localhost'
  ],

];
