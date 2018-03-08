<?php



function displayLinks($pdo){


$sql = "select c.CountryName,c.ISO from Countries c inner join ImageDetails i on i.CountryCodeISO = c.ISO group by c.CountryName";
$result = $pdo -> query($sql);

    
    while($row = $result->fetch())
    {
        echo '<div class="col-md-3">';
        echo  '<div><a href="single-country.php?code='.$row['ISO'].'">'. $row["CountryName"].'</a></div>';
        echo '</div>';
    }
    
}

/* -------------------------------BROWSE COUNTRIES FUNCTION(S) -----------------------------------------------*/

function displaySingleCountry($nation,$pdo)
{
    
                    
       $sql = 'select CountryName,Capital,Area,Population,CurrencyName,CountryDescription from Countries where ISO ="'.$nation.'"';  
       $statement = $pdo->prepare($sql);
       $statement->bindvalue(":code",$country);
       $statement->execute();
       
       if(!empty($nation)||$statement->rowCount()>0)
             {
                  return $statement;
             }
       
       else
             {
                  redirect();    
             }

        
}


function displayCountryImages($result)
{
    
  
   while($row = $result->fetch())
       {
           
           echo '<div class="col-md-1">';
           echo '<a href="single-image.php?id='.$row["ImageID"].'" class="img-responsive">';
           echo '<img class="img-responsive" src="images/square-medium/'.$row["Path"].'" alt="'.$row["title"].'">';
           echo '</a>';
           
           echo   '</div>';
           
           
       }
  
    
}

function getImagesbyCountry($country,$pdo)
{
     $sql = 'select i.Path, i.title, i.ImageID, c.CountryName from ImageDetails i inner join Countries c on c.ISO = i.CountryCodeISO where c.ISO = "'.$country.'"';
     $statement = $pdo->prepare($sql);
     $statement->bindvalue(":code",$country);
     $statement->execute();
     return $statement;
    
     
}

function getCountryName($code,$pdo) //this method was necessary to get only the ountry name without affecting the list of images
{
     $sql = 'select c.CountryName from ImageDetails i inner join Countries c on c.ISO = i.CountryCodeISO where c.ISO = "'.$country.'"';
    $statement = $pdo->prepare($sql);
    $statement->bindvalue(":code",$code);
    $statement->execute(); 
    return $statement;
}


/* ------------------------------------------SINGLE COUNTRY FUNCTION(S)---------------------------------------------------------- */


function displayUsers($pdo)
{
    
    $sql = "select Firstname, Lastname, UserID from Users order by Lastname";
    $result = $pdo-> query($sql);
    while($row = $result->fetch())
    {
         echo '<div class="col-md-3">';
         $name = utf8_encode($row["Firstname"]);
         $LastName = utf8_encode($row["Lastname"]);
        echo '<div><a href=single-user.php?user='.$row["UserID"].'>'.$row["Firstname"].' '.$row["Lastname"].'</div>';
        echo '</div>';
    }
}

/* ------------------------------------------BROWSE USERS FUNCTION(S)---------------------------------------------------------- */






function getUserName($user,$pdo)
{
    $sql = 'select u.FirstName, u.LastName from ImageDetails i inner join Users u on i.UserID = u.UserID and u.UserID ="'.$user.'"';
    $statement = $pdo ->prepare($sql);
    $statement->bindvalue(":user",$user);
    $statement->execute(); 
    
    if(!empty($user) || $statement->rowCount()>0)
    {
        return $statement;
        
    }
    else 
    {
        redirect();
    }
    
}



function getCountriesbyUsers($pdo,$user)
{
    if(!empty($user))   
    
    {
    
    $sql = 'select i.Path, u.UserID, i.ImageID,u.FirstName, u.LastName from ImageDetails i inner join Users u on i.UserID = u.UserID and u.UserID ="'.$user.'"';
    $statement = $pdo -> prepare($sql);
    $statement->bindvalue(":user",$user);
    $statement->execute(); 
   
    if($statement->rowCount()>0)
    {
       return $statement;
    }
  
    else
        {
          redirect();
        }
    
        
    }
}




function userInfo($user,$pdo)
{
    
        $sql= 'select Firstname, Lastname, Address, City, Postal, Country, Phone, Email from Users where UserID ="'.$user.'"';
        $statement = $pdo->prepare($sql);
        $statement->bindvalue(":user",$user);
        $statement->execute(); 
        
   
    if($statement->rowCount()>0 || !empty($user))
         {
              return $statement;
         }
    
}

/* ------------------------------------------SINGLE USER FUNCTION(S)---------------------------------------------------------- */





function displayContinentsLeft($pdo)
{
    $sql = "select c.ContinentName, c.ContinentCode from Continents c inner join ImageDetails i on i.ContinentCode = c.ContinentCode group by i.ContinentCode";
    $result = $pdo->query($sql);
    
    while($row = $result->fetch())
         {
        echo '<li class="list-group-item">';
        echo '<a href = "browse-images.php?continent='.$row["ContinentCode"].'">'.$row["ContinentName"];
         echo '</a></li>';
         }  
}

function displayCountriesLeft($pdo)
{
    $sql = "select c.CountryName, c.ISO from Countries c inner join ImageDetails i on i.CountryCodeISO = c.ISO group by c.CountryName";
    $result = $pdo->query($sql);
     while($row = $result->fetch())
         {
        echo '<li class="list-group-item">';
        echo '<a href = "single-country.php?code='.$row["ISO"].'">'.$row["CountryName"];
         echo '</a></li>';
         }
}


function showImage($pdo,$image)
{
        
        if(!empty($image))
        {
        $sql= 'select * from ImageDetails where ImageID = "'.$image.'"';
        $statement = $pdo->prepare($sql);
        $statement->bindvalue(":id",$user);
         $statement->execute(); 
        
        $picture = $statement->fetch();
         echo '<img class="img-responsive"' . 'src="images/medium/'. $picture["Path"].'"'. 'alt='.$picture['Title'].'>';
         echo '<p class="description">'. $picture['Description'].'</p>';
         echo '</div>';
        }
        
}

function showRightColumn($pdo,$id)    // right column on the single-image.php
{
    if(!empty($id))
    {
   
    $sql= 'SELECT c.AsciiName, i.ImageID,u.FirstName, u.LastName, coun.CountryName,coun.ISO, i.Title, u.UserID from Cities c, ImageDetails i, Users u, Countries coun where i.CityCode = c.CityCode and u.UserID = i.UserID and coun.ISO = i.CountryCodeISO and i.ImageID = '.$id;
    $result = $pdo->query($sql);
   
    while($row = $result->fetch())
    {
    echo '<h2>'.$row["Title"].'</h2>';
    echo' <div class="panel panel-default">
           <div class="panel-body">
            <ul class="details-list">';
            
     echo '<li>By: <a href="single-user.php?user='.$row["UserID"].'">'.$row["FirstName"].' '.$row["LastName"].'</a></li>';
     echo '<li>Country: <a href="single-country.php?code='.$row["ISO"].'">'.$row["CountryName"].'</a></li>';
     echo '<li>City: '.$row["AsciiName"].'</li>';
                                        
     echo  '</ul>
        </div>
        </div>';
      }
    }
        
}
/* -----------------------------------SINGLE IMAGE FUNCTIONS--------------------------------------------- */

function ContinentsList()
{
    $sql = "select ContinentName from Continents";
    return $sql;
}

function getCountryList()
{
$sql = 'SELECT coun.CountryName, coun.ISO FROM Countries coun JOIN ImageDetails image ON coun.ISO = image.CountryCodeISO GROUP BY coun.ISO ORDER BY coun.CountryName';
return $sql; 
}

function getCityList()
{
    $sql = 'select cit.AsciiName, cit.CityCode from Cities cit inner join ImageDetails i on cit.CityCode = i.CityCode group by cit.AsciiName';
    return $sql;
}

function getImageList($sql)
{
  
return $sql;

}

/* -----------------------------------------MENU FUNCTIONS-------------------------- */


function setDbSearch($continent,$country,$city,$title,$pdo)
{
  
   if(empty($continent)&&(empty($country))&&(empty($city))&&(empty($title)))
   {
       $sql= "select * from ImageDetails";
       $statement = $pdo->prepare($sql);
       $statement->bindvalue("",$continent);
       $statement->execute();
       return $statement;
       
   }
   else if(!empty($continent))
   {
       $sql = 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE ContinentCode = "'.$continent.'"';
       $statement = $pdo->prepare($sql);
       $statement->bindvalue(":continent",$continent);
       $statement->execute();
       return $statement;
       
   }
   
   else if(!empty($country))
   {
       $sql = 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE CountryCodeISO = "'.$country.'"';
       $statement = $pdo->prepare($sql);
       $statement->bindvalue(":country",$country);
       $statement->execute();
       return $statement;
       
   }
   
   else if(!empty($city))
   {
       
       $sql = 'SELECT Path, CountryCodeISO, ImageID, Title FROM ImageDetails WHERE CityCode = "'.$city.'"';
        $statement = $pdo->prepare($sql);
       $statement->bindvalue(":city",$city);
       $statement->execute();
       return $statement;
   }
   
   else if(!empty($title))
   {
       
        $sql = 'SELECT Path, ImageID, Title, Description, CityCode, CountryCodeISO, ContinentCode FROM ImageDetails WHERE Title LIKE"%'.$title.'%";"';
        $statement = $pdo->prepare($sql);
       $statement->bindvalue(":title","%$title%");
       $statement->execute();
       return $statement;
       
       
   }
    
}

/* -----------------------------------FILTER FUNCTION------------------------------------ */



function redirect()
{
header("Location:error.php");
}


function getPDO()
{
    
define('DBCONNECTION', "mysql:host=$ip;port=$port;dbname=travel;charset=utf8mb4;");
define('DBUSER', getenv('C9_USER'));
define('DBPASS', '');
$pdo = new PDO(DBCONNECTION,DBUSER,DBPASS);
try {
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
 catch (PDOException $e) {
         die( $e->getMessage());
         
// code obtained from lab 4 from my project                             

}

    return $pdo; 
}


?>