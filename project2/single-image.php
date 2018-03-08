<?php 

include 'functions.php';
$pdo = getPDO();

?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <title>Single Image</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
     <link rel="stylesheet" href="css/assignement-01.css" />
     <!-- <link rel="stylesheet" href="css/bootstrap.css" /> !-->
</head>

<body>
    
 <?php include "includes/header.php" ?>
        
        <main class="container">
            
            <div class="row">
                <aside class="col-md-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Continents</div>
                    <ul class="list-group">
                        <?php displayContinentsLeft($pdo); ?>
                        
                    </ul>
                </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">Popular</div>
                            <ul class="list-group">
                                <?php displayCountriesLeft($pdo) ?>
                                
                            </ul>
                        
                        
                     </div>
                    </aside>
                
                
                <div class="col-md-10">
                    <div class="row col-md-12">
                        <div class="col-md-8">
                            <?php 
                                  
                                showImage($pdo, $_GET["id"]);
                                  
                                 
                                
                            ?>
                            
                        
                        <div class="col-md-4">
                            <?php showRightColumn($pdo,$_GET["id"]) ?>
                            
                            
                           <div class="btn-group btn-group-justified" role="group" aria-label="...">
                     
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>
                            </div>
                        </div> 
                        <!-- markup extracted from lab 2 !-->
                        
                        
                                   
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
            
                   
            
        </main>
        
       
         <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        </body>
        <?php include 'includes/footer.php'?>
        </hmtl>