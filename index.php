<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Weather</title>
<?php
$key = 'f7dc5c04a4737807';
$zip = $_POST['zipcode'];
$currenturl = file_get_contents("http://api.wunderground.com/api/$key/geolookup/conditions/q/$zip.json");
$futureurl = file_get_contents("http://api.wunderground.com/api/$key/forecast/q/$zip.json");
$parsed_json = (json_decode($currenturl));
$location = $parsed_json->{'current_observation'}->{'display_location'}->{'full'};
$temp = $parsed_json->{'current_observation'}->{'temp_f'};
if(isset($zip) != null){
echo "The current temperature in $location is: $temp";
echo "<br>";
echo "The three day forecast for $location is: \n";
echo "<br>";
}
$parsed_futurejson = (json_decode($futureurl));
$forecastday = $parsed_futurejson->{'forecast'}->{'txt_forecast'}->{'forecastday'};
$count = count($forecastday);
for($i = 0; $i < $count; $i++)
  {
    $period = $forecastday[$i];
	 if($period->{'period'} == 0 || $period->{'period'} == 2 || $period->{'period'} == 4)
     {
	 $forecast = $parsed_futurejson->{'forecast'}->{'txt_forecast'}->{'forecastday'}[$i]->{'fcttext'};
	 $dayofweek = $period->{'title'};
	 echo $dayofweek;
	 echo ": " ;
	 echo $forecast;
	 echo "<br>";

  }
		
	  
 }
  
?>

</script>

</head>

<body>
<form id= "weatherform" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"> Zip Code: <input type = "text" name = "zipcode" value="<?php echo $zip;?>" pattern="^\d{5}(-\d{4})?$"> <br /> <input type="submit" value="Submit" id="submit"> </form>﻿
<div id='weatherreport'></div>
</body>
</html>