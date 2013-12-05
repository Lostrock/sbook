<?php

require_once('visualisations/entete.php');
print "<div id='tout'>";
print "<div id='nav'>";
require_once('visualisations/menu.php');
print "</div><div id='section'>" ;
require_once('visualisations/section.php'); 
print "</div>";
print "</div>";
print "<div></div>";
require_once('visualisations/pieddepage.php');

?>