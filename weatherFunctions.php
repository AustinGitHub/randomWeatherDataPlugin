<?php
include 'cityList.php';
function getWeatherInfo()
{
    $apiKey = "ec213c940f03a1c6345e21f4a0985758";
    $cityId = getRandomCity();
    $googleApiUrl = "https://api.openweathermap.org/data/2.5/forecast/daily?q=" . $cityId . "&units=imperial&appid=" . $apiKey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response, true);
    if (!$data['city']['name']) {
        getWeatherInfo();
    } else {
        return $data;
    }
}

function getState($cityName)
{
    $apiKey = "ec213c940f03a1c6345e21f4a0985758";
    $googleApiUrl = "https://api.openweathermap.org/geo/1.0/direct?q=" . $cityName . "&units=imperial&appid=" . $apiKey;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);

    curl_close($ch);
    $data = json_decode($response, true);
    return $data[0]['state'];
}

function createHeaders($randomData)
{
    echo "<tr>";
    $randomData_keys = array_keys($randomData);
    for ($z = 0; $z < count($randomData); $z += 1) {
        echo "<th>$randomData_keys[$z]</th>";
    }
    echo "</tr>";
}

function createValues($randomData)
{
    $randomData_keys = array_keys($randomData);
    $randomData_values = array_values($randomData);
    $headerTemps = array("Temperature", "Min Temperature", "Max Temperature");
    echo  "<tr>";
    for ($x = 0; $x < count($randomData); $x += 1) {
        if (in_array($randomData_keys[$x], $headerTemps)) {
            echo "<td> " . $randomData_values[$x] . " &#176;F</td>";
        } else if (is_numeric($randomData_values[$x])) {
            echo "<td> " . number_format($randomData_values[$x]) . "</td>";
        } else {
            echo "<td> " . $randomData_values[$x] . "</td>";
        }
    }
    echo  "</tr>";
}
