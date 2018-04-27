<?php
namespace App\Validation;

use App\Lib\Response;

class SolicitudValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        /*$key = 'VUELO_SOLICITUD';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(is_numeric($value)) {
                $response->errors[$key][] = 'Este campo no puede ser numerico debe ser una letra.';
            }
            else if(strlen($value) != 1)
            {
            	$response->errors[$key][] = 'Solamente puede agregar una letra.';
            }
        }
        $key = 'VIDAREGRESO_SOLICITUD';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(is_numeric($value)) {
                $response->errors[$key][] = 'Este campo no puede ser numerico debe ser una letra.';
            }
            else if(strlen($value) != 1)
            {
            	$response->errors[$key][] = 'Solamente puede agregar una letra.';
            }
        }
        $key = 'HOTEL_SOLICITUD';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(is_numeric($value)) {
                $response->errors[$key][] = 'Este campo no puede ser numerico debe ser una letra.';
            }
            else if(strlen($value) != 1)
            {
            	$response->errors[$key][] = 'Solamente puede agregar una letra.';
            }
        }
        $key = 'COD_EMPLEADO';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(!is_numeric($value)) {
                $response->errors[$key][] = 'Este campo debe ser numerico.';
            }
            
        }
         */      

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}