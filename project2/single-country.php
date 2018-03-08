
<?php

include "functions.php" ;
$pdo = getPDO();


?>

<!DOCTYPE html>

<html lang="en">
    
    <head>
        
        <meta charset="utf-8">
         <title>Single Country</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
       
      
        
         <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
         <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
         
         <link rel="stylesheet" href="css/bootstrap.min.css" />
         <link rel="stylesheet" href="css/bootstrap-theme.css" />
         <link rel="stylesheet" href="css/assignement-01.css" />

         
    </head>
    
    <body>
        
        <?php include 'includes/header.php' ?>
        
        <main class ="container">
            
             <div class="row">
                     <div >
                        <div class="jumbotron" id="postJumbo">
                            
                        <?php 
                                $result = displaySingleCountry($_GET["code"],$pdo);
                        
                               while($row = $result->fetch())
                                {
                                  echo '<h3>'.$row["CountryName"]."</h3>";
                                  echo 'Captial : <strong>'.$row["Capital"].'</strong><br>';
                                  echo 'Area : <strong>'.$row["Area"].' </strong> sq km<br>';
                                 echo 'Currency Name: <strong>'.$row["CurrencyName"].'</strong><br>';
                                 echo $row["CountryDescription"];
                                 }
                        
                        ?>
                        
                        
                        </div> 
                    </div>    
                </div> 
                
               
                <div class="row">
                <div >
                   
                            
                            <?php 
                            
                          $countryName = getCountryName($_GET["code"],$pdo); //method created to extract only the country name 
                          $result=  getImagesbyCountry($_GET["code"],$pdo);
                          
                          $country = $countryName->fetch();
                          
                          echo '<div class="panel panel-info">';
                          echo '<div class="panel-heading">Images from '.$country["CountryName"].'</div>';
                          echo '<div class="panel-body">';
                          
                          
                          displayCountryImages($result);   //shared function with single-user.php
                          
                          echo  '</div';
                          echo '</div>';
                              ?>
                            
                        </div>
                    </div>
                    
                  
            
        </main>
        
        <?php include 'includes/footer.php' ?>
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
            
        </body>
        
      </html>