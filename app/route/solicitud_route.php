<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\SolicitudValidation,
    App\Middleware\AuthMiddleware;

$app->group('/solicitud/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->listar($args['l'], $args['p']))
                   );
    });
    $this->get('obtener/{acronimo}/{consecutivo}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->obtener($args['acronimo'],$args['consecutivo']))
                   );
    });
        $this->get('obtenerDeptoCompras', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->obtenerDeptoCompras())
                   );
    });
    $this->post('registrar', function ($req, $res, $args) {

      $r = SolicitudValidation::validate($req->getParsedBody());

      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));
      }

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->solicitud->registrar($req->getParsedBody()))
                   );
    });
/*
    $this->put('actualizar/{cod_solicitud}', function ($req, $res, $args) {
        /*$r = SolicitudValidation::validate($req->getParsedBody(), true);

        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        */
/*        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->actualizar($req->getParsedBody(), $args['cod_solicitud']))
                   );
    });
     $this->delete('eliminar/{cod_solicitud}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->eliminar($args['cod_solicitud']))
                   );
    });*/
})->add(new AuthMiddleware($app));
