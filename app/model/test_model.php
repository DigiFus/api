<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Mail;

class TestModel
{
    private $db;
    private $table = 'empleado';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
        $this->mail = new Mail();
    }

    public function getAll($l, $p)
    {
        $data = $this->db->from($this->table)
                         ->limit($l)
                         ->offset($p)
                         ->orderBy('id DESC')
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

    public function insert($data)
    {
        $data['Password'] = md5($data['Password']);

        $this->db->insertInto($this->table, $data)
                 ->execute();

        return $this->response->SetResponse(true);
    }
    public function enviarCorreo($data){
        //sendMail($to,$cc,$subject,$message)
        return $this->mail->sendMail($data['to'],'',$data['subject'] ,'prueba :o');
    }

}
