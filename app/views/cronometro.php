<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cronómetro Online</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 20px auto; padding: 0 15px; text-align: center; }
        .display-container { background: #333; color: #00ff00; padding: 30px; border-radius: 10px; margin-bottom: 25px; box-shadow: 0 0 15px rgba(0,0,0,0.5); }
        .display { font-size: 4em; font-family: 'Courier New', monospace; }
        .buttons button { padding: 12px 25px; margin: 5px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer; transition: background-color 0.2s; color: white; }
        
        
        #startPauseBtn { background: #28a745; }
        #startPauseBtn.paused { background: #ffc107; } 
        #resetBtn { background: #dc3545; }
        #lapBtn { background: #007bff; }
        #lapBtn:disabled { background: #6c757d; cursor: not-allowed; } 
        
        /* Lista de Tiempos Parciales */
        .laps-container { margin-top: 30px; text-align: left; }
        .laps-container h2 { text-align: center; }
        .laps-list { list-style: none; padding: 0; }
        .lap-item { display: flex; justify-content: space-between; padding: 8px 10px; border-bottom: 1px solid #eee; }
        .lap-item:nth-child(even) { background-color: #f8f9fa; }
        .lap-number { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Ejercicio 11: Cronómetro Online</h1>
    <a href="index.php">⬅ Volver al Menú Principal</a>
    <hr>

    <div class="display-container">
        <div class="display" id="display">00:00:00.000</div>
    </div>

    <div class="buttons">
        <button id="startPauseBtn">Iniciar</button>
        <button id="resetBtn">Reiniciar</button>
        <button id="lapBtn" disabled>Vuelta</button>
    </div>

    <div class="laps-container">
        <h2>Tiempos Parciales (Vueltas)</h2>
        <ul id="lapsList" class="laps-list">
            </ul>
    </div>

    <script>
        
        let startTime = 0;       
        let elapsedTime = 0;     
        let timerInterval;       
        let isRunning = false;   
        let lapCounter = 0;      

        
        const display = document.getElementById('display');
        const startPauseBtn = document.getElementById('startPauseBtn');
        const resetBtn = document.getElementById('resetBtn');
        const lapBtn = document.getElementById('lapBtn');
        const lapsList = document.getElementById('lapsList');

        
        function formatTime(ms) {
            const date = new Date(ms);
            const hours = String(date.getUTCHours()).padStart(2, '0');
            const minutes = String(date.getUTCMinutes()).padStart(2, '0');
            const seconds = String(date.getUTCSeconds()).padStart(2, '0');
            const milliseconds = String(date.getUTCMilliseconds()).padStart(3, '0');
            
            return `${hours}:${minutes}:${seconds}.${milliseconds}`;
        }

        
        function printTime() {
            
            elapsedTime = Date.now() - startTime;
            display.textContent = formatTime(elapsedTime);
        }

        

        startPauseBtn.addEventListener('click', () => {
            if (isRunning) {
              
                clearInterval(timerInterval);
                startPauseBtn.textContent = 'Reanudar';
                startPauseBtn.classList.add('paused');
                lapBtn.disabled = true;
                isRunning = false;
            } else {
                
                startTime = Date.now() - elapsedTime;
                timerInterval = setInterval(printTime, 10); // Actualización cada 10ms
                startPauseBtn.textContent = 'Pausar';
                startPauseBtn.classList.remove('paused');
                lapBtn.disabled = false;
                isRunning = true;
            }
        });

        resetBtn.addEventListener('click', () => {
            
            clearInterval(timerInterval);
            startTime = 0;
            elapsedTime = 0;
            isRunning = false;
            lapCounter = 0;
            display.textContent = '00:00:00.000';
            startPauseBtn.textContent = 'Iniciar';
            startPauseBtn.classList.remove('paused');
            lapBtn.disabled = true;
            lapsList.innerHTML = ''; // Limpiar la lista de vueltas
        });

        lapBtn.addEventListener('click', () => {
            
            if (isRunning) {
                lapCounter++;
                const lapTime = formatTime(elapsedTime);
                
                const listItem = document.createElement('li');
                listItem.className = 'lap-item';
                listItem.innerHTML = `<span class="lap-number">Vuelta ${lapCounter}:</span> <span>${lapTime}</span>`;
                
                
                lapsList.prepend(listItem);
            }
        });

    </script>
</body>
</html>
