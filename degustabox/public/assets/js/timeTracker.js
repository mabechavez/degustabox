document.addEventListener('DOMContentLoaded', function () {
    const timerDisplay = document.getElementById('timerDisplay');
    const nombreInput = document.getElementById('nombre');

    let startTime;
    let timerInterval;

    $('#stopButton').on('click', function () {
        clearInterval(timerInterval);
        $('#startButton').prop('disabled', false);
        $('#stopButton').prop('disabled', true);
        saveTime();
    });

    $('#startButton').on('click', function () {
        startTime = new Date().getTime();
        timerInterval = setInterval(updateTimer, 1000);
        $('#startButton').prop('disabled', true);
        $('#stopButton').prop('disabled', false);
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

    function saveTime() {
        const endTime = new Date().toISOString();
        console.log(`Nombre: ${nombreInput.value}`);
        console.log(`Inicio: ${new Date(startTime).toISOString()}`);
        console.log(`Fin: ${endTime}`);
    }

    $('#startButton, #stopButton').on('click', function () {
        const nombre = $('#name').val();

        $.ajax({
            url: '/check-task',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ name: nombre }),
            success: function (data) {
                console.log(data.message);
            },
            error: function (error) {
                console.error('Error:', error);
            },
        });
    });
});
