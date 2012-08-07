<?
/*******************************************************************************
Name: SimplexPHP
Version: 0.1
Website: http://github.com/Jordan-Hall/Simplex
Author: Luno Solutions ltd <simplex@lunosolutions.com>
Acknowledge: S.C. Chen (http://sourceforge.net/projects/simplehtmldom/)
Contributions by:
    Bennett Treptow (Upload class)
Please leave this in tac. You may pass SimplexPHP on and add to simplex.
However you must not claim this as your own
*******************************************************************************/

// This script will call functions needed to get the theme inserted

// Leave this here. This controls SimplexPHP and is where the system is built.
include("include/config.php");

// siteheader calls all files needed for the theme (top half which will be on every page)
siteheader();

// start of your page content (This is the dyanmic part of the website that changed depending on the page. please change the  "home" to which ever page you need to pull the file from.)\\
include_once(customcontent("home"));
// end of your page content \\

// sitefooter calls all files needed for the theme (bottom which will be on every page)
sitefooter();

?>