<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_clean();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'com/utils/dbo/daoConnection.php';
require_once 'com/utils/dbo/daoCommand.php';
require_once 'com/utils/mailtools/mail_sender.php';
require_once 'com/security/clsUserManager.php';
require_once 'com/utils/dbo/daoManager.php';
require_once 'com/blockchain/clsTransaction.php';
require_once 'com/bizum/clsBizum.php';

function newDBCommand($server, $db, $user, $password)
{
    
    $serverConfig = $server . ";Encrypt=yes;TrustServerCertificate=yes";

    $connection = new DBConnection($serverConfig, $db, $user, $password);
    $pdoObject = $connection->getPDOObject();
    
    
    if (!$pdoObject) {
        die("Error: No se pudo conectar a la base de datos. Verifica el host: " . $server);
    }

    return new DBCommand($pdoObject);
}

function connUser()
{
    $dbCommand = newDBCommand('host.docker.internal,1433', 'reservaesport', 'SA', 'Asix1234');
    return new UserManager($dbCommand);
}

function connDBManager()
{
    $dbCommand = newDBCommand('host.docker.internal,1433', 'reservaesport', 'SA', 'Asix1234');
    return new DBManager($dbCommand);
}

function connBizum()
{
    $dbCommand = newDBCommand('host.docker.internal,1433', 'reservaesport', 'SA', 'Asix1234');
    return new Bizum($dbCommand);
}


$action = isset($_GET['action']) ? $_GET['action'] : '';

if (empty($action)) {
    echo "Accion no especificada.";
} else {
    switch ($action) {
      
        case "register":
            $username = $_GET['username'];
            $name = $_GET['name'];
            $lastname = $_GET['lastname'];
            $password = $_GET['password'];
            $email = $_GET['email'];
            $gender = strtoupper($_GET['gender']);
            $def_lang = strtoupper($_GET['def_lang']);
            $userManager = connUser();
            $userManager->register($username, $name, $lastname, $password, $email, $gender, $def_lang);
            break;
        case "login":
            $userManager = connUser();
            $userManager->login($_GET['username'], hash('MD5', $_GET['password']));
            break;
        case "logout":
            $userManager = connUser();
            $userManager->logout($_GET['ssid']);
            break;
        case "accvalidate":
            $userManager = connUser();
            $userManager->accountValidate($_GET['username'], $_GET['code']);
            break;
        case "reservar":
            $userManager = connUser();  
            $userManager->reservar($_GET['username'], $_GET['code']);
            break;
        case "aleta":
            $userManager = connUser();  
            $userManager->aleta($_GET['username'], $_GET['code']);
            break;
        case "fecha":
            $userManager = connUser();  
            $userManager->fecha($_GET['username'], $_GET['code']);
            break;
    }
}


?>