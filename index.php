<?php 

$distance = '';
$time = '';
$distance_unit = 'm';
$time_unit = 's';
$result = '';

if(isset($_GET['distance'], $_GET['time'], $_GET['distance_unit'], $_GET['time_unit'])){
    $distance = $_GET['distance'];
    $time = $_GET['time'];
    $distance_unit = $_GET['distance_unit'];
    $time_unit = $_GET['time_unit'];

    function calculate_speed($distance, $time, $distance_unit, $time_unit) {
        // Converti distanza in metri
        $distance_in_meters = $distance_unit === 'km' ? (float)$distance * 1000 : (float)$distance;

        // Converti tempo in secondi
        $time_in_seconds = $time_unit === 'min' ? (float)$time * 60 : (float)$time;

        if ($time_in_seconds == 0) {
            return "Il tempo deve essere maggiore di zero.";
        }

        $speed = $distance_in_meters / $time_in_seconds;
        return number_format($speed, 2) . " m/s";
    }

    $result = calculate_speed($distance, $time, $distance_unit, $time_unit);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Speed Calculator</title>
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gradient-to-r from-blue-100 to-blue-300 min-h-screen flex items-center justify-center p-4">

        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-lg">
            <h1 class="text-3xl font-extrabold text-center text-blue-700 mb-6">Speed Calculator</h1>
            <form method="GET" action="" class="space-y-6">
                <div>
                    <label for="distance" class="block text-sm font-medium text-gray-700 mb-1">Distance</label>
                    <div class="flex space-x-2">
                        <input type="number" id="distance" name="distance" value="<?= htmlspecialchars($distance) ?>" 
                            class="flex-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 text-gray-700" required>
                        <select name="distance_unit" 
                                class="w-28 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 text-gray-700">
                            <option value="m" <?= $distance_unit === 'm' ? 'selected' : '' ?>>Meters</option>
                            <option value="km" <?= $distance_unit === 'km' ? 'selected' : '' ?>>Kilometers</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                    <div class="flex space-x-2">
                        <input type="number" id="time" name="time" value="<?= htmlspecialchars($time) ?>" 
                            class="flex-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 text-gray-700" required>
                        <select name="time_unit" 
                                class="w-28 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 text-gray-700">
                            <option value="s" <?= $time_unit === 's' ? 'selected' : '' ?>>Seconds</option>
                            <option value="min" <?= $time_unit === 'min' ? 'selected' : '' ?>>Minutes</option>
                        </select>
                    </div>
                </div>
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-500 text-white py-3 rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-600 focus:ring-4 focus:ring-blue-400 transition">Calculate</button>
            </form>

            <?php if ($result): ?>
                <div class="mt-6 p-4 bg-green-100 text-green-700 font-semibold rounded-lg shadow-inner text-center">
                    <?= htmlspecialchars($result); ?>
                </div>
            <?php endif; ?>
        </div>

    </body>
</html>
