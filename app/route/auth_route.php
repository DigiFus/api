<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\EmpleadoValidation,
    App\Middleware\AuthMiddleware;

$app->group('/auth/', function () {
    $this->post('autenticar', function ($req, $res, $args) {
        $parametros = $req->getParsedBody();        
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->auth->autenticar($parametros['Correo'], $parametros['Password']))
                   );
    });
    $this->post('validaToken', function ($req, $res, $args) {
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->auth->validar($req->getParsedBody()))
                   );
    });
});