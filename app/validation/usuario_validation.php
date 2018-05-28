<?php
namespace App\Validation;

use App\Lib\Response;

class UsuarioValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        /*$key = 'EsAdmin';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if($value != '1' && $value != '0') {
                $response->errors[$key][] = 'Valor ingresado no válido';
            }
        }*/   
        $key = 'email_usuario';
        if( !$update ){
            if(empty($data[$key])) {
                $response->errors[$key][] = 'Este campo es obligatorio';
            } else {
                $value = $data[$key];
                
                if( !filter_var($value, FILTER_VALIDATE_EMAIL) ) {
                    $response->errors[$key][] = 'El correo ingresado no es válido, Verifique que haya colocado el arroba ( @ ) y que finalice con .com, .com.co, .net, etc.';

                }
            }
        }
            
        
        $key = 'pass_usuario';
        if( !$update ){
            if(empty($data[$key])){
                $response->errors[$key][] = 'Este campo es obligatorio';
            } else {
                $value = $data[$key];

                if(strlen($value) < 8) {
                    $response->errors[$key][] = 'Su contraseña debe contener como mínimo 8 caracteres';
                }
            }            
        } else {
            if(!empty($data[$key])){
                $value = $data[$key];

                if(strlen($value) < 8) {
                    $response->errors[$key][] = 'Su contraseña debe contener como mínimo 8 caracteres';
                }
            }
        }

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}