<?php

/**
 * Plugin Name: Random Weather Data
 * Description: This is an example WP plugin that displays random weather data to the user
 * Version: 1.0.3
 * Author: Austin Viens-DeRuisseau
 * License: GPL
 */
include 'weatherClass.php';
include 'weatherFunctions.php';


function myPlugin()
{


    $data = new weather();
    $data->setData(getWeatherInfo());

    $state = getState($data->getCityName());

    for ($y = 0; $y < 7; $y += 1) {
        $randomData = array(
            'Date' => $data->getDate($y),
            'City' => $data->getCityName(),
            'Population' => $data->getPopulation(),
            'Sunrise' => $data->getSunrise($y),
            'Sunset' => $data->getSunset($y),
            'Weather Description' => $data->getWeatherDescription($y),
            'Humidity' => $data->getHumidity($y),
            'Temperature' => $data->getTemperature($y),
            'Min Temperature' => $data->getMinTemp($y),
            'Max Temperature' => $data->getMaxTemp($y),
        );
        if ($y === 0) {
            echo "<center><h3> Weather for " . $randomData['City'] . ", " . $state . "</h3><table>";
            echo createHeaders($randomData);
        }

        echo createValues($randomData);
        if ($y === 6) {
            echo "</table></center>";
        }
    }
}

add_filter('the_content', 'myPlugin');
