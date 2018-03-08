<?php include 'functions.php';
$pdo = getPDO();
header("Location.error.php")
?>
<!DOCTYPE html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <title>Browse-images</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" /> 
    
     <!-- <link rel="stylesheet" href="css/bootstrap.css" /> !-->
</head>
  
  <body>
    <?php include 'includes/header.php' ?>
    
      <main class="container">
        
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="browse-images.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                 <option value="0">Select Continent</option>
                
                
               <?php
                   
                   /*Displays dropdown menu of continents */
                   
                      $query = 'SELECT c.ContinentName, c.ContinentCode from Continents c inner join ImageDetails i on i.ContinentCode = c.ContinentCode group by c.ContinentName';
                      $result = $pdo -> query($query);
                     
                      while ($row = $result -> fetch()) 
                      {
                           echo '<option value ='.$row["ContinentCode"].'>';
                           echo  $row["ContinentName"] ;
                           echo '</option>';
                      }
               
                ?>
                
              </select>     
                
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                  /*  Dislay dropdown menu of continents */
                $sql = 'SELECT coun.CountryName, coun.ISO FROM Countries coun JOIN ImageDetails image ON coun.ISO = image.CountryCodeISO GROUP BY coun.ISO ORDER BY coun.CountryName';
                      $result = $pdo -> query($sql);
                     
                      while ($row = $result -> fetch()) 
                      {
                           echo '<option value ='.$row["ISO"].'>';
                           echo  $row["CountryName"] ;
                           echo '</option>';
                      }
                      
                      
               
                
                /* display list of countries */ 
                ?>
              </select>   
              <select name="city" class="form-control">
                    <option value="0">Select City</option>
                       <?php 
                            
                              
                       $result = $pdo -> query(getCityList());
                     
                         while ($row = $result -> fetch()) 
                              {
                               echo '<option value ='.$row["CityCode"].'>';
                               echo  $row["AsciiName"] ;
                               echo '</option>';
                               }
                        ?>
               </select>
               
               <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              
              <button type="submit" class="btn btn-info">Default</button>
              </div>
            </form>

          </div>
        </div>  
               
               <ul class="caption-style-2">
                 <?php 
                      
                     $sql = setDbSearch($_GET["continent"],$_GET["country"],$_GET["city"],$_GET["title"],$pdo);
                   
                   while ($row = $sql -> fetch()) 
                      {
                          echo '<li>';
                          echo '<a href="single-image.php?id='.$row['ImageID'].'"'.'class="img-responsive">';
                          echo '<img src="images/square-medium/'.$row['Path'].'" alt="'.$row["Title"].'">';
                          echo '<div class="caption">';
                          echo  '<div class="blur"></div>';
                          echo ' <div class="caption-text">';
                          echo  '<p>'.$row["Title"].'</p>';
                          echo '</div>';
                          echo '</div>
                                 </a>';
                         echo '</li>';
                      }
                   
                 ?>
                 
               </ul>

              
         </main>       
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
  <?php include 'includes/footer.php' ?>
</html>