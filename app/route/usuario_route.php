<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\UsuarioValidation,
    App\Middleware\AuthMiddleware;

$app->group('/usuario/', function () {
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
        $this->get('obtenerJefe/{COD_EMPLEADO}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuario->obtenerJefe($args['COD_EMPLEADO']))
                   );
    });

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

    $this->put('actualizar/{email_usuario}', function ($req, $res, $args) {
        $r = UsuarioValidation::validate($req->getParsedBody(), true);

        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }

        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuario->actualizar($req->getParsedBody(), $args['email_usuario']))
                   );
    });

    $this->delete('eliminar/{email_usuario}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->usuario->eliminar($args['email_usuario']))
                   );
    });
});//->add(new AuthMiddleware($app));
