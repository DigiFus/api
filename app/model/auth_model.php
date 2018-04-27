<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Auth;

class AuthModel
{
    private $db;
    private $table = 'usuarios';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }

    public function autenticar($correo, $password) {
        $empleado = $this->db->from($this->table)
                             ->where('email_usuario', $correo)
                             ->where('pass_usuario', md5($password))
                             ->fetch();

        if(is_object($empleado)){

            //$nombre = explode(' ', $empleado->NOMBRE_EMPLEADO)[0];
            //$nombre = $empleado->NOMBRE_EMPLEADO;
            $token = Auth::SignIn([
                
                'EsAdmin' => (bool)true
            ]);

            $this->response->result = $token;

            return $this->response->SetResponse(true);
        }else{
            return $this->response->SetResponse(false, "Credenciales no válidas, intente nuevamente o reporte su problema con el area de sistemas");
        }
    }
    public function validar($token){
        //return $token['token'];
        //return $token['token'];
        $newtoken = Auth::Check($token['token']);

        //return $newtoken;
        $this->response->result = $newtoken;

        return $this->response->SetResponse(true);
    }
}
