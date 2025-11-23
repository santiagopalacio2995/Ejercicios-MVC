<?php
class PasswordModel {
    public function generar($longitud, $usarMayusculas, $usarNumeros, $usarSimbolos) {
        // 1. Ingrediente base: minúsculas
        $caracteres = 'abcdefghijklmnopqrstuvwxyz';
        
        // 2. Agregamos ingredientes según lo que pidió el usuario
        if ($usarMayusculas) {
            $caracteres .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($usarNumeros) {
            $caracteres .= '0123456789';
        }
        if ($usarSimbolos) {
            $caracteres .= '!@#$%^&*()-_=+?';
        }

        // 3. Mezclamos y extraemos
        $password = '';
        $maxIndex = strlen($caracteres) - 1;

        for ($i = 0; $i < $longitud; $i++) {
            // Elegimos una letra al azar del conjunto disponible
            $indiceAleatorio = rand(0, $maxIndex);
            $password .= $caracteres[$indiceAleatorio];
        }

        return $password;
    }
}
?>