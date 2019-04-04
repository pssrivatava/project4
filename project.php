<?php
  function curl_get_contents($url)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
  $weather = "";
    if(isset($_GET['city']))
    {
       $city=$_GET['city'];
       if (strpos($city, ' ') !== false)
     {
        $city= str_replace(' ','',$_GET['city']);


         $forecastPage = curl_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
         $pageArray = explode('Weather Today </h2>(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

         $secondPageArray = explode('</span></p>',$pageArray[0]);
 

          $weather = $secondPageArray[0];
     }
     else{
        $forecastPage = curl_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
            $pageArray = explode('Weather Today </h2>(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
   
            $secondPageArray = explode('</span></p>',$pageArray[1]);
    
   
             $weather = $secondPageArray[1];
     }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather Scraper</title>
    <style>
        html { 
                    background: url(back.jpg) no-repeat center center fixed; 
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
            }
        body
        {
            background: none;
        }  
        .container
        {
            text-align:center;
            margin-top : 100px;  
            width: 700px; 
        }  
        h1
        {
            margin-bottom:50px;
        }
        input
        {
            margin: 20px 0;
        }
        #weather
        {
            margin-top: 40px;
        }
    </style>
  </head>
  <body>
    
                <div class="container">
                    <h1><strong>What's the weather?</strong></h1>
                    <form method="get">
                        <div class="form-group">
                            <label for="city"><h3><strong>Enter the name of a city</strong></h3></label>
                            <input type="text" class="form-control" name="city" id="city"  placeholder="Eg. london,Tokyo">
                            
                        </div>
                       
                        
                        <button type="submit" class="btn btn-primary">Submit</button>

                        
                </form>
                 <div id="weather">
                 <?php
                        if($weather)
                        {
                            echo '<div class="alert alert-primary" role="alert">
                            '. $weather .'
                          </div>';
                          
                        }     
                ?> 
                </div> 
              
                </div>
   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>