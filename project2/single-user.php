
<?php include "functions.php" ;
$pdo = getPDO();?>

<!DOCTYPE html>

<html lang="en">
    
    <head>
        
        <meta charset="utf-8">
         <title>Single User</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
       
      
        
         <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
         <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
         
         <link rel="stylesheet" href="css/bootstrap.min.css" />
         <link rel="stylesheet" href="css/bootstrap-theme.css" />
         <link rel="stylesheet" href="css/assignement-01.css" />

         
    </head>
    
    <body>
        
       <?php include 'includes/header.php' ?>
        
        <!-- end of header  -->
        
        <main class="container">
        
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    
                    <?php 
                    $statement = userInfo($_GET["user"],$pdo) ;
                    
                     while($row = $statement->fetch())
                         {
                             echo '<h3>'.$row["Firstname"].' '.$row["Lastname"].'</h3>';
                             echo '<div class="col-md-12">'.$row["Address"].' </div><br/>';
                             echo '<div class="col-md-12">'.$row["City"].' <br/></div><br/>';
                             echo '<div class="col-md-12">'.$row["Phone"].' <br/></div><br/>';
                             echo '<div class="col-md-12">'.$row["Email"].' <br/></div><br/>';
                         }
                    
                    
                             echo '</div>';
                 
                             $userName = getUserName( $_GET["user"],$pdo);
                             $statement = getCountriesbyUsers($pdo, $_GET["user"]); // I needed another get method because I could not include the anel header in the loop and the fetch() was dropiing the first record. 
                             
                             $record = $userName->fetch();
                             echo '<div class="panel panel-info">';
                             echo '<div class="panel-heading">Images by '.$record["FirstName"].' '.$record["LastName"].'</div>';
                             echo '<div class="panel-body">';
                             
                             
                             displayCountryImages($statement); //shared function with single-country.php
                    
                             echo  '</div';
                             echo '</div>';
                            ?>
                            
                          
                </div>
                
            </div>
            
        </div>
        
        
        </main>
         <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
       
        
        </body>
                <?php include 'includes/footer.php' ?>
        
        </html>