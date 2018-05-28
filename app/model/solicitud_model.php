<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Mail;

class SolicitudModel
{
    private $db;
    private $table = 'solicitudes';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
        //$this->mail = new Mail();
    }

    public function listar($l, $p)
    {
        $data = $this->db->from($this->table)
                        ->select(null)->select('
                                solicitudes.fecha_solicitud,
                                solicitudes.acronimo_solicitud,
                                solicitudes.consecutivo_solicitud,
                                usuarios.nom_usuario,
                                usuarios.rol_usuario
                            ')
                            ->innerJoin('usuarios on solicitudes.email_usuario = usuarios.email_usuario')
                            ->orderBy('fecha_solicitud DESC')
                            ->limit($l)
                            ->offset($p)
                            ->fetchAll();


        $total = $this->db->from($this->table)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;

        return [
            'data'  => $data,
            'total' => $total
        ];
    }


    public function obtener($acronimo)
    {
        date_default_timezone_set('America/Bogota');
        $dateTime=date('Y/m/d ', time());
        //return $dateTime;
      $row =  $this->db->from($this->table)
                        ->select(null)->select('
                                solicitudes.fecha_solicitud,
                                solicitudes.acronimo_solicitud,
                                solicitudes.consecutivo_solicitud,
                                solicitudes.estado_solicitud,
                                usuarios.nom_usuario
                            ')
                        ->innerJoin('usuarios on solicitudes.email_usuario = usuarios.email_usuario')
                        ->where('acronimo_solicitud', $acronimo)
                        ->where('fecha_solicitud',$dateTime)
                        ->where('estado_solicitud', 'NUEVA')
                        ->fetchAll();
        return $row;


    }
    public function calcularTiempoUAE($fecha){
        $resp = $this->db->from($this->table)
                        ->select(null)->select('*')
                        ->where('fecha_solicitud', $fecha)
                        ->where('estado_solicitud', 'NUEVA')
                        ->where('acronimo_solicitud','UAE')
                        ->fetchAll();
        $filas = count($resp);
      return [
        'numTurnos' =>$filas
      ];
    }
    public function calcularTiempoFAC($fecha){
        $resp = $this->db->from($this->table)
                        ->select(null)->select('*')
                        ->where('fecha_solicitud', $fecha)
                        ->where('estado_solicitud', 'NUEVA')
                        ->where('acronimo_solicitud','FAC')
                        ->fetchAll();
        $filas = count($resp);
      return [
        'numTurnos' =>$filas
      ];
    }
    public function obtenerPorFecha($fecha)
    {
      $resp = $this->db->from($this->table)
                        ->select(null)->select('
                            solicitudes.fecha_solicitud,
                            solicitudes.acronimo_solicitud,
                            solicitudes.consecutivo_solicitud,
                            usuarios.nom_usuario,
                            usuarios.carrera_usuario
                          ')
                        ->innerJoin('usuarios on solicitudes.email_usuario = usuarios.email_usuario')
                        ->where('fecha_solicitud', $fecha)
                        ->where('estado_solicitud', 'NUEVA')
                        ->fetchAll();
      return $resp;
    }
    public function registrar($data)
    {
        date_default_timezone_set('America/Bogota');
        $dateTime=date('Y/m/d h:i:s', time());

        $data['fecha_solicitud'] = $dateTime;
        
        $consecutivo = $this->db->insertInto($this->table, $data)
                  ->execute();

        

        return $this->response->SetResponse(true,$consecutivo);

    }


    public function actualizar($data, $consecutivo)
    {

        date_default_timezone_set('America/Bogota');
        $dateTime=date('Y/m/d', time());
          /*EN DATA MAIL*/
          $this->db->update($this->table, $data)
                      ->where('fecha_solicitud',$dateTime)
                      ->where('consecutivo_solicitud',$consecutivo)
                      ->execute();

          return $this->response->SetResponse(true);
        
    }
    /*public function eliminar($cod_solicitud)
    {
        $this->db->deleteFrom($this->table)
                 ->where('COD_SOLICITUD', $cod_solicitud)
                 ->execute();

        return $this->response->SetResponse(true);
    }*/

}
