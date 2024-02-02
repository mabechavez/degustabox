document.addEventListener('DOMContentLoaded', function () {
    const timerDisplay = document.getElementById('timerDisplay');
    const nombreInput = document.getElementById('name');

    let startTime;
    let timerInterval;
    let totalTime = 0;

    $('#stopButton').on('click', function () {
        clearInterval(timerInterval);
        $('#startButton').prop('disabled', false);
        $('#stopButton').prop('disabled', true);

        const stopTime = new Date().getTime();
        const elapsedTime = stopTime - startTime;
        totalTime += elapsedTime;

        saveTime(totalTime);
    });

    $('#startButton').on('click', function () {
        totalTime = 0;
        startTime = new Date().getTime();
        timerInterval = setInterval(updateTimer, 1000);
        $('#startButton').prop('disabled', true);
        $('#stopButton').prop('disabled', false);
        saveTime(totalTime);
    });

    function updateTimer() {
        const currentTime = new Date().getTime();
        const elapsedTime = currentTime - startTime;
        const formattedTime = formatTime(elapsedTime);
        timerDisplay.textContent = formattedTime;
    }

    function formatTime(milliseconds) {
        const seconds = Math.floor(milliseconds / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);

        const formattedHours = padZero(hours % 60);
        const formattedMinutes = padZero(minutes % 60);
        const formattedSeconds = padZero(seconds % 60);

        return `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
    }

    function padZero(number) {
        return number < 10 ? '0' + number : number;
    }

    function saveTime(totalTime) {
        const endTime = new Date().toISOString();
        const data = {
            name: nombreInput.value,
            totalTime: totalTime,
        };

        fetch('/check-task', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                // Puedes hacer algo con la respuesta del backend, como mostrar un mensaje al usuario
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});
