<?php

// require_once 'DBCommand.php'; 

class UserManager
{
    private $dbCommand;

    public function __construct($dbCommand)
    {
        $this->dbCommand = $dbCommand;
    }

    public function register($username, $name, $lastname, $password, $email, $gender, $def_lang)
    {
        if (empty($username) || empty($name) || empty($lastname) || empty($password) || empty($email) || empty($gender) || empty($def_lang)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                $result = $this->dbCommand->execute('sp_user_register', array($username, $name, $lastname, $password, $email, $gender, $def_lang));
                $xml = simplexml_load_string($result);
                if ($xml->head->errors->error->num_error == "0") {
                    $register_code = $this->dbCommand->execute('sp_wdev_get_registercode', array($username, 0));

                    // URL del Web App desplegado en Google Apps Script
                    //url pau
                    // $url = 'https://script.google.com/macros/s/AKfycbzs-WaweIA_cKNVVgqqPmianx7dn4wPI7AflDvM78iUcP8pUoYNh5u5Dg7nBlkofdKu/exec';

                    //url Pol
                    $url = 'https://script.google.com/macros/s/AKfycbxAQsgiFCg31C-G1MzD27GjZTo0Owa22XBoGJQzu2AT-WV8lWj76kud2WOuxLaxpH6OYw/exec';

                    // Parámetros del correo electrónico
                    $destinatario = $email;
                    $asunto = 'Código de registro.';
                    $cuerpo = $name . ', su código de verificación es ' . $register_code . '.';
                    $adjunto = null;

                    // Llamada a la función para enviar el correo
                    enviarCorreo($url, $destinatario, $asunto, $cuerpo, $adjunto);
                }
                // Establecer el encabezado para XML
                header('Content-Type: text/xml');

                // Mostrar la respuesta XML
                echo $result;

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

   
    public function login($username, $password)
    {
        if (empty($username) || empty($password)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                $result = $this->dbCommand->execute('sp_user_login', array($username, $password));
                $xml = simplexml_load_string($result);
                header('Content-Type: text/xml');
                echo $xml->asXML();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    public function logout($username)
    {
        try {
            $result = $this->dbCommand->execute('sp_user_logout', array($username));
            $xml = simplexml_load_string($result);
            header('Content-Type: text/xml');
            echo $xml->asXML();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

   

    public function accountValidate($username, $code)
    {
        if (empty($username) || empty($code)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                $result = $this->dbCommand->execute('sp_user_accountvalidate', array($username, $code));

                // Establecer el encabezado para XML
                header('Content-Type: text/xml');

                // Mostrar la respuesta XML
                echo $result;

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }


   

    public function reservar($ssid)
    {
        if (empty($ssid)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                    $result = $this->dbCommand->execute('sp_reserevar', array ($ssid));
                    $xml = simplexml_load_string($result);
                    header('Content-Type: text/xml');
                    echo $xml->asXML();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    public function fecha($ssid)
    {
        if (empty($ssid)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                    $result = $this->dbCommand->execute('sp_fecha', array ($ssid));
                    $xml = simplexml_load_string($result);
                    header('Content-Type: text/xml');
                    echo $xml->asXML();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

public function alerta($ssid)
    {
        if (empty($ssid)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                    $result = $this->dbCommand->execute('sp_reserevar', array ($ssid));
                    $xml = simplexml_load_string($result);
                    header('Content-Type: text/xml');
                    echo $xml->asXML();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}

?>