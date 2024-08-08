<?php

class SessionController
{
    public static function index($error='')
    {
        require_once(__DIR__ . '/../Resources/views/login/index.php');
    }
    
    public static function create()
    {
        require_once(__DIR__ . '/../Resources/views/login/create.php');
    }
    public static function store()
    {
        require_once(__DIR__ . '/../Models/Users.php');
        $name = $_POST['name'];
        $password = $_POST['password'];

        $usuario = new User();
        $usuario->name = $name;
        $usuario->password = $password;
        $usuario->save();
        header("Location: " . baseurl('/'));
        exit();
    }
    public static function init()
    {
        require_once(__DIR__ . '/../Models/Users.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
             
            if (empty($name) || empty($password)) {
                header("Location: " . baseurl('/'));
                exit();
            }

            $status = json_decode(USER::createSession($name,$password),true);
            
            if ($status['status'] == 0) {
                self::index($status['message']);
            }else{
                header("Location: " . baseurl('/'));
                exit();
            }
        } else {
           header("Location: " . baseurl('/'));
            exit();
        }

    }
    public static function check()
    {
        header('Content-Type: application/json');
        session_start();
        if (isset($_SESSION['name'])) {
            
            echo json_encode(['status' => 1,'message' => 'SESION ACTIVA' , 'data' => $_SESSION]);
        } else {
            echo json_encode(['status' => 0,'message' => 'NO EXISTE SESION']);
        }

    }
    public static function destroy()
    {
        header('Content-Type: application/json');
        if (isset($_SESSION['name'])) {
            $_SESSION = array();
        
            session_destroy();
        
            setcookie(session_name(), '', time() - 3600, '/');
            //echo json_encode(['status' => 0,'message' => 'SESION CERRADA', 'data' => json_encode([])]);
        } else {
            //echo json_encode(['status' => 0,'message' => 'NO EXISTE SESION', 'data' => json_encode([])]);
        }
        header("Location: " . baseurl('/'));
        exit();
    }
}