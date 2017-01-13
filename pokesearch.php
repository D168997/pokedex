<?php
$name = strtolower($name); // variable name out of Index.php. This variable contains the posted value.
$image = "";
$filename = "pokemon".$name.".txt";
if (file_exists($filename)) {
    $data = file_get_contents($filename);
    $image = $name . ".jpg";
    echo ("From Cache<br />");
} else {
    $data = file_get_contents("http://pokeapi.co/api/v2/pokemon/".$name); //Search in PokeAPI for a name that is equal to the  value of $name
    if($data != ""){
      file_put_contents ( $filename , $data); 
      $tempData = json_decode($data, true); 
      $input = $tempData['sprites']['front_default'];
      $output = $name.'.jpg';
      file_put_contents($output, file_get_contents($input));
    }
}
    

    if($data != ""){
      $rData = json_decode($data, true);
      //Gettig name and ID; Works
      if($image != ""){
        echo("<img src='". $image ."'></img><br />");
      }
      else{
        echo ("<img src='" . $rData['sprites']['front_default']."'></img><br />"); 
      }
      
      // get pokemon name
      echo ("Name: " . $rData['name'] . "<br />"); 
      
      //get pokemon ID
      echo ("PokeDex entry number : " . $rData['id'] . "<br />");
      
      // Get base experience
      echo ("Base Experience : " .$rData['base_experience']);
      echo ("<br/>");
      //get weight
      echo ("Weight : " . $rData['weight'] . "<br />");
            
      echo ("<br />");
      //Method one to get types; Works
      echo ("Types : <br /><table>");
      $count = 0;
      while($count != count($rData['types'])){
        echo ("<tr><th>Type : </th><td> " . $rData['types'][$count]['type']['name'] . "</td></tr>");
        $count++;
      }

 
      echo ("</table><br />");
      //Getting base stats
      echo("Base Stats : <br /><table>");
      echo ("<tr><th>Speed : </th><td> ".$rData['stats'][0]['base_stat']. "</td></tr>");
      echo ("<tr><th>Special-Defence : </th><td> ".$rData['stats'][1]['base_stat']. "</td></tr>");
      echo ("<tr><th>Special-Attack : </th><td> ".$rData['stats'][2]['base_stat']. "</td></tr>");
      echo ("<tr><th>Defence : </th><td> ".$rData['stats'][3]['base_stat']. "</td></tr>");
      echo ("<tr><th>Attack : </th><td> ".$rData['stats'][4]['base_stat']. "</td></tr>");
      echo ("<tr><th>HP : </th><td> ".$rData['stats'][5]['base_stat']. "</td></tr></table>");
      echo ("<br /><br />");
      
            
    //   Show the areas this pokemon can be found in
       $base = file_get_contents("/api/v2/pokemon/.$naam./encounters");     
       $countLoc = 0;
       $locationData = json_decode($base, true);  
       while($countLoc != count($locationData['location_area'])){
       echo ("This pokemon can be located in : " .$locationData['location_area'][$countLoc]['name']);
       $countLoc++;            
       }
       echo ("<br/><br/>");     
      // Get Pokemon abilities       
      echo ("<b>Abilities</b> : <br /></table>");
      $intCount = 0;
      while($intCount != count($rData['abilities'])){
        echo ("<tr><th> Abilities : </th><td> " .$rData['abilities'][$intCount]['ability']['name'] . "</td></tr>");
        $intCount++;
      echo ("<br />");
      }
       echo ("<br />");
           
     // Get all moves from pokemon
    echo ("<br/> <br/>");
     echo ("<b>Attacks</b> : <br /></table>");
     $intAttack = 0;
      while($intAttack != count($rData['moves'])){
      echo("<tr><th><th><td>".$rData['moves'][$intAttack]['move']['name']."</td></tr>");
      $intAttack++;
      echo ("<br />");  
      }
          
    }
  else
    {
      echo ("No pokemon found with that name.");
    }
?>


<!-- [12:46, 12/15/2016] Jeremy Vorrink: $moveLevel = $rData['moves'][$moveCount]['version_group_details'][0]['level_learned_at'];                        
[12:47, 12/15/2016] Jeremy Vorrink: dan kijk ik of het 0 is. want zo ja dan                        
[12:47, 12/15/2016] Jeremy Vorrink: $moveLevel = $rData['moves'][$moveCount]['version_group_details'][0]['move_learn_method']['name']; -->









