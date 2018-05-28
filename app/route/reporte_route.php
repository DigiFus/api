<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\UsuarioValidation,
    App\Middleware\AuthMiddleware;

$app->group('/reporte/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuario->listar($args['l'], $args['p']))
                   );
    });

    $this->get('obtener/{email_usuario}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuario->obtener($args['email_usuario']))
                   );
    });
    
});//->add(new AuthMiddleware($app));
