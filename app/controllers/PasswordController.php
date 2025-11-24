<?php
require_once 'app/models/PasswordModel.php';

class PasswordController {
    private $model;

    public function __construct() {
        $this->model = new PasswordModel();
    }

    public function index() {
        $passwordGenerada = '';
        
        
        $longitud = 12;
        $mayus = true;
        $nums = true;
        $syms = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $longitud = intval($_POST['longitud']);
            $mayus = isset($_POST['mayus']); // Si el check está marcado, devuelve true
            $nums = isset($_POST['nums']);
            $syms = isset($_POST['syms']);

            $passwordGenerada = $this->model->generar($longitud, $mayus, $nums, $syms);
        }

        require_once 'app/views/password.php';
    }
}
?>