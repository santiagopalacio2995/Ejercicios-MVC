<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Contraseñas</title>
    <style>
        body { font-family: sans-serif; text-align: center; margin-top: 50px; }
        .container { max-width: 500px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .result-box { background: #333; color: #0f0; font-family: monospace; font-size: 24px; padding: 15px; margin: 20px 0; border-radius: 5px; word-break: break-all; }
        label { display: block; margin: 10px 0; cursor: pointer; }
        button { padding: 10px 20px; background: #6f42c1; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background: #5a32a3; }
    </style>
</head>
<body>
    <h1>Ejercicio 3: Generador de Contraseñas</h1>
    <a href="index.php">⬅ Volver al Menú</a>
    <hr>

    <div class="container">
        <?php if (!empty($passwordGenerada)): ?>
            <p>Tu contraseña segura es:</p>
            <div class="result-box"><?php echo $passwordGenerada; ?></div>
        <?php else: ?>
            <p>Configura y genera tu clave abajo 👇</p>
        <?php endif; ?>

        <form action="index.php?c=password&a=index" method="POST">
            <label>
                Longitud de caracteres: 
                <input type="number" name="longitud" value="<?php echo $longitud; ?>" min="6" max="30">
            </label>

            <div style="text-align: left; margin-left: 30%;">
                <label>
                    <input type="checkbox" name="mayus" <?php echo $mayus ? 'checked' : ''; ?>> Incluir Mayúsculas (A-Z)
                </label>
                <label>
                    <input type="checkbox" name="nums" <?php echo $nums ? 'checked' : ''; ?>> Incluir Números (0-9)
                </label>
                <label>
                    <input type="checkbox" name="syms" <?php echo $syms ? 'checked' : ''; ?>> Incluir Símbolos (!@#$)
                </label>
            </div>

            <br>
            <button type="submit">⚡ Generar Contraseña</button>
        </form>
    </div>
</body>
</html>