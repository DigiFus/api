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
                                usuarios.carrera_usuario
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


    public function obtener($acronimo,$consecutivo)
    {
      $row =  $this->db->from($this->table)
                        ->select(null)->select('
                                solicitudes.fecha_solicitud,
                                solicitudes.acronimo_solicitud,
                                solicitudes.consecutivo_solicitud,
                                usuarios.nom_usuario,
                                usuarios.carrera_usuario
                            ')
                        ->innerJoin('usuarios on solicitudes.email_usuario = usuarios.email_usuario')
                        ->where('acronimo_solicitud', $acronimo)
                        ->where('consecutivo_solicitud',$consecutivo)
                        ->fetch();
        return $row;


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
                        ->fetchAll();
      return $resp;
    }
    public function registrar($data)
    {
        $dateTime=date('Y/m/d h:i:s', time());
        $this->db->insertInto($this->table, $data)
                  ->execute();
        return $this->response->SetResponse(true);

    }


    /*public function actualizar($data, $email_usuario)
    {

          /*EN DATA MAIL*/
         /* $this->db->update($this->table, $data)
                      ->where('COD_SOLICITUD',$email_usuario)
                      ->execute();

          return $this->response->SetResponse(true);
        
    }*/
    /*public function eliminar($cod_solicitud)
    {
        $this->db->deleteFrom($this->table)
                 ->where('COD_SOLICITUD', $cod_solicitud)
                 ->execute();

        return $this->response->SetResponse(true);
    }*/

}
