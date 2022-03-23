# Weather

A weather app made with vanilla PHP and the OpenWeather API. This is a WIP.

## What does it do?

Type a city name, press the button and it'll give you the current weather in that city (or an error message if the name you entered was incorrect).


**Note:** If you want to actually use the app right now, you'll have to create a config.php file in the repository and paste:

```
<?php 

$apiKey = [Your OpenWeather API key in string format];

?>
```

into it. You'll have to supply your own OpenWeather API key. You can get one for free [here](https://home.openweathermap.org/api_keys).


## Changelog


**23/03/2022**

- Removed exposed API key
- Error message now appears when it should

**22/03/2022**

- Initial commit





## To Do

* Finish adding different icons for different weathers
* ~~debug error message~~
* Add possibility to switch between imperial or metric units