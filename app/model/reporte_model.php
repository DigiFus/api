<?php
namespace App\Model;

use App\Lib\Response;

class ReporteModel
{
    private $db;
    private $table = 'usuarios';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }

    public function listar($l, $p)
    {
        $data = $this->db->from($this->table)
        //select(null) sirve para mostrar los campos indicados en el select
                         ->select(null)->select(
                            ' email_usuario,
                              carrera_usuario,
                              semestre_usuario
                            ')
                         ->limit($l)
                         ->offset($p)
                         ->orderBy('email_usuario DESC')
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

    public function obtener($email_usuario)
    {

        return $this->db->from($this->table)
                        ->select(null)->select(
                            ' email_usuario,
                              nom_usuario,
                              rol_usuario,
                              estado_usuario
                            ')
                        ->where('email_usuario', $email_usuario)
                        ->fetch();
    }
    
    public function registrar($data)
    {
        $data['pass_usuario'] = md5($data['pass_usuario']);

        $this->db->insertInto($this->table, $data)
                 ->execute();

        return $this->response->SetResponse(true);
    }

    public function actualizar($data, $email_usuario)
    {
        if(isset($data['pass_usuario'])){
            $data['pass_usuario'] = md5($data['pass_usuario']);
        }

        $this->db->update($this->table, $data)
                 ->where('email_usuario', $email_usuario)
                 ->execute();

        return $this->response->SetResponse(true);
    }

    public function eliminar($email_usuario)
    {
        $this->db->deleteFrom($this->table)
        		 ->where('email_usuario',$email_usuario)
                 ->execute();

        return $this->response->SetResponse(true);
    }
}
