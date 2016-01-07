<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Weather</title>
<?php
$key = 'f7dc5c04a4737807';
$zip = $_POST['zipcode'];
$zipurl = file_get_contents("http://api.wunderground.com/api/$key/geolookup/q/$zip.json");
$currenturl = file_get_contents("http://api.wunderground.com/api/$key/geolookup/conditions/q/$zip.json");
$futureurl = 'http://api.wunderground.com/api/$key/forecast/q/$zip.json';
$parsed_json = (json_decode($currenturl));
$location = $parsed_json->{'current_observation'}->{'display_location'}->{'full'};
$temp = $parsed_json->{'current_observation'}->{'temp_f'};
echo "The current temperature in $location is $temp";
?>
</head>

<body>
</body>
</html>