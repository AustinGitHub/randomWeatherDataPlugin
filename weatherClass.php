<?php
class Weather
{
    public $cityName;
    public $population;
    public $date = array();
    public $weatherDescription = array();
    public $Sunrise = array();
    public $Sunset = array();
    public $Temperature = array();
    public $MinTemp = array();
    public $MaxTemp = array();
    public $Humidity = array();


    function setData($data)
    {
        $this->cityName = $data['city']['name'];
        $this->population = $data['city']['population'];

        for ($x = 0; $x < count($data['list']); $x += 1) {
            $this->date[] = date("F j, Y, g:i a", $data['list'][$x]['dt']);
            $this->weatherDescription[] = $data['list'][$x]['weather'][0]['description'];
            $this->Sunrise[] = date("F j, Y, g:i a", $data['list'][$x]['sunrise']);
            $this->Sunset[] = date("F j, Y, g:i a", $data['list'][$x]['sunset']);

            $this->Temperature[] = $data['list'][$x]['temp']['day'];
            $this->MaxTemp[] = $data['list'][$x]['temp']['max'];
            $this->MinTemp[] = $data['list'][$x]['temp']['min'];
            $this->Humidity[] = $data['list'][$x]['humidity'];
        }
    }
    function getCityName()
    {
        return $this->cityName;
    }

    function getPopulation()
    {
        return $this->population;
    }
    function getWeatherDescription($arrayValue)
    {
        return $this->weatherDescription[$arrayValue];
    }
    function getDate($arrayValue)
    {
        return $this->date[$arrayValue];
    }
    function getSunrise($arrayValue)
    {
        return $this->Sunrise[$arrayValue];
    }
    function getSunset($arrayValue)
    {
        return $this->Sunset[$arrayValue];
    }
    function getHumidity($arrayValue)
    {
        return $this->Humidity[$arrayValue];
    }
    function getTemperature($arrayValue)
    {
        return $this->Temperature[$arrayValue];
    }
    function getMinTemp($arrayValue)
    {
        return $this->MinTemp[$arrayValue];
    }
    function getMaxTemp($arrayValue)
    {
        return $this->MaxTemp[$arrayValue];
    }
}
