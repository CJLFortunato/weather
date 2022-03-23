<?php 
    
    error_reporting(0);

    $weather = "";
    $weatherDescription = "";
    $actualTemps = "";
    $feltTemps = "";
    $humidity = "";
    $windSpeed = ""; 
    $cityName = ""; 
    $display = "";
    $error = "";

    if($_GET["city"]) {

        include "./config.php";
       
        $address = "http://api.openweathermap.org/data/2.5/weather?q=" . $_GET["city"] . "&units=metric&appid=" . $apiKey;

        $res = file_get_contents($address);

        //echo $res;

        if($res) {

            echo "Res returned something";

            $dataArray = json_decode($res, true);

            $weather = $dataArray["weather"][0]["main"];
            //$weather = "Rain";
            $weatherDescription = $dataArray["weather"][0]["description"];
            $actualTemps = $dataArray["main"]["temp"];
            $feltTemps = $dataArray["main"]["feels_like"];
            $humidity = $dataArray["main"]["humidity"];
            $windSpeed = $dataArray["wind"]["speed"]; 
            $cityName = $dataArray["name"]; 

            $windSpeedConverted = $windSpeed * 3600;
            $windSpeedConverted /= 1000;
            $windSpeedConverted = intval($windSpeedConverted);

            function outputWeatherSymbol($weather) {

                switch($weather) {
                    case "Clear":
                        return '<i class="fas fa-sun" style="color: orange;"></i>';
                        break;
                    case "Clouds";
                        return '<i class="fas fa-cloud" style="color: lightgrey;"></i>';
                        break;
                    case "Snow";
                        return '<i class="far fa-snowflake" style="color: lightsteelblue;"></i>';
                        break;
                    case "Rain";
                        return '<i class="fas fa-cloud-showers-heavy" style="color: grey;"></i>';
                        break;
                    case "Drizzle";
                        return '<i class="fas fa-cloud-rain" style="color: darkgrey;"></i>';
                        break;
                    case "Thunderstorm";
                        return '<i class="fas fa-bolt" style="color: gold;"></i>';
                        break;
                    default:
                        return '<i class="fas fa-smog" style="color: #D1C6DF;"></i>';
                }       
            }   
            
            $display = '<div class="answer"><h2>' . $cityName . "</h2>" . 
                 outputWeatherSymbol($weather) .
                "<p><strong>Weather:</strong> " . $weatherDescription . "</p>".
                "<p><strong>Temperature:</strong> " . $actualTemps . " &deg;C</p>".
                "<p><strong>Temperature felt:</strong> " . $feltTemps . " °C</p>".
                "<p><strong>Humidity:</strong> " . $humidity . "%</p>".
                "<p><strong>Wind Speed:</strong> " . $windSpeedConverted . "km/h</p></div>";

        }

            

    } //else {

        echo "Res returned nothing";

            $error = '<div class="error">Sorry, we couldn\'t find the city you are looking for. Check the spelling or try again later.</div>';

    //}

    
 
?>


<!doctype html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/ca9ca94b48.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./normalize.css" type="text/css">
    <link rel="stylesheet" href="./weather.css" type="text/css">
    <title>Weather</title>

</head>

<body>

    <header>
        <h1>Weather</h1>
        <p>Find out what the weather is anywhere in the world</p>
    </header>
    <main>
        <form>
            <label for="city">Enter a city</label>
            <input type="text" name="city" id="city" placeholder="city name" value="" required>
            <input type="submit" value="Search">
        </form>
            <?php 

            // print_r($dataArray);

            if ($display) {
                 echo $display;
            } elseif(!$display AND $_GET["city"]) {
                echo $error;
            }
            
           

            ?>
    </main>
    <footer>
        <p>Created by CJL Fortunato using PHP and the OpenWeather API. <a href="http://www.cjlfortunato.work">Portfolio</a> <a href="https://github.com/CJLFortunato">GitHub</a></p>
    </footer>
</body>

</html>