<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\UsuarioValidation,
    App\Middleware\AuthMiddleware;

$app->group('/usudisconnect/', function () {
    
    $this->post('registrar', function ($req, $res, $args) {

      $r = UsuarioValidation::validate($req->getParsedBody());

      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));
      }

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->usuario->registrar($req->getParsedBody()))
                   );
    });

    
});
