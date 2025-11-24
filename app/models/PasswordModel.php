<?php
class PasswordModel {
    public function generar($longitud, $usarMayusculas, $usarNumeros, $usarSimbolos) {
        
        $caracteres = 'abcdefghijklmnopqrstuvwxyz';
        
        
        if ($usarMayusculas) {
            $caracteres .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($usarNumeros) {
            $caracteres .= '0123456789';
        }
        if ($usarSimbolos) {
            $caracteres .= '!@#$%^&*()-_=+?';
        }

        
        $password = '';
        $maxIndex = strlen($caracteres) - 1;

        for ($i = 0; $i < $longitud; $i++) {
            
            $indiceAleatorio = rand(0, $maxIndex);
            $password .= $caracteres[$indiceAleatorio];
        }

        return $password;
    }
}
?>