<?php
if (!empty($_GET['location'])){
  /**
   * Here we build the url we'll be using to access the google maps api
   */
  $maps_url = 'https://'.
  'maps.googleapis.com/'.
  'maps/api/geocode/json'.
  '?address=' . urlencode($_GET['location']);
  $maps_json = file_get_contents($maps_url);
  $maps_array = json_decode($maps_json, true);

  $lat = $maps_array['results'][0]['geometry']['location']['lat'];
  $lng = $maps_array['results'][0]['geometry']['location']['lng'];

  /**
   * Time to make our Instagram api request. We'll build the url using the
   * coordinate values returned by the google maps api
   */
  $instagram_url = 'https://'.
    'api.instagram.com/v1/media/search' .
    '?lat=' . $lat .
    '&lng=' . $lng .
    '&client_id=c174fde75e904e65abcf08269ecc040b'; //replace "CLIENT-ID"

  $instagram_json = file_get_contents($instagram_url);
  $instagram_array = json_decode($instagram_json, true);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <title>geogram</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="script.js"></script>
  </head>
  <body>
  <form action="" method="get">
    <input type="text" name="location"/>
    <button type="submit">Submit</button>
  </form>
  <br/>
  <div id="images" data-url="<?php if(!empty($instagram_url)) echo $instagram_url ?>" id="pictures">
   <?php
        if(!empty($instagram_array)){
          foreach($instagram_array['data'] as $key=>$image){
            echo '<img id="'. $image['id'] .'" src="'.$image['images']['low_resolution']['url'].'" alt=""/><br/>';
          }
        }
   ?>
  </div>
  </body>
</html>