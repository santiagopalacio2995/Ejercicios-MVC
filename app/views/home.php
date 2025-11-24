<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portafolio PHP MVC | 11 Ejercicios</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* --- Estilos Generales --- */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            padding: 20px;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #ff0000ff;
            font-weight: 700;
            font-size: 2.5em;
            margin-bottom: 5px;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        /* --- Estilos de la Lista/Grid --- */
        .project-grid {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            max-width: 1200px;
            width: 95%;
        }

        .project-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 15px 20px;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .project-card a {
            text-decoration: none;
            color: #333;
            font-size: 1.1em;
            font-weight: 600;
            flex-grow: 1; /* Permite que el enlace ocupe todo el espacio */
            text-align: left;
        }

        .project-card span {
            color: #ff1100ff;
            font-size: 1.2em;
            font-weight: 700;
            margin-right: 15px;
        }

        /* --- Estilos de Completado/Iconos --- */
        .status-icon {
            margin-left: 10px;
            font-size: 1.2em;
        }
        
        /* Opcional: Estilo visual para proyectos completados vs. pendientes */
        .completed {
            /* Puedes usar un estilo diferente si tienes un sistema para marcar como completo */
        }

    </style>
</head>
<body>
    <h1>✅Ejercicios PHP MVC</h1>
    <p>Modelo-Vista-Controlador.</p>
    
    <ul class="project-grid">
        <li class="project-card completed">
            <span>1.</span> <a href="index.php?c=tareas&a=index">Lista de Tareas</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>2.</span> <a href="index.php?c=propinas&a=index">Calculadora de Propinas</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>3.</span> <a href="index.php?c=password&a=index">Generador de Contraseñas Seguras</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>4.</span> <a href="index.php?c=gastos&a=index">Gestor de Gastos</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>5.</span> <a href="index.php?c=reservas&a=index">Sistema de Reservas </a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>6.</span> <a href="index.php?c=notas&a=index">Gestor de Notas</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>7.</span> <a href="index.php?c=calendario&a=index">Calendario de Eventos</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>8.</span> <a href="index.php?c=recetas&a=index">Plataforma de Recetas</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>9.</span> <a href="index.php?c=juego&a=index">Juego de Memoria</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>10.</span> <a href="index.php?c=encuestas&a=index">Plataforma de Encuestas</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
        <li class="project-card completed">
            <span>11.</span> <a href="index.php?c=cronometro&a=index">Cronómetro Online</a>
            <span class="status-icon" style="color: #28a745;">✓</span>
        </li>
    </ul>
</body>
</html>