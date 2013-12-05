
<html>
<head>
<title>Book</title>
 <LINK rel='stylesheet' type='text/css' href='ressources/styleCss.css'>
     <LINK rel='stylesheet' type='text/css' href='../ressources/styleCss.css'>
    </head>
    
    <div id="header">
    <p class="titre">
        <?php 
        $url = explode("/",$_SERVER['PHP_SELF']);
        if(end($url)=="index.php"){
        ?>
        <img class="logo" src='./ressources/images/logoBook.png' /></p>
        <?php 
        }
        else
        {
        ?>
        <img class="logo" src='../ressources/images/logoBook.png' /></p>
        <?php
        }
        ?>
    </div>
