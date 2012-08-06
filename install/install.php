<?php
class installer {
	public function __construct()  
	    {  
	    } 
	 
	    public function __destruct() 
	    {
	    }  
	    public function createconfigtable()
	    { 
		global $dbh;
		$sql = "CREATE TABLE config (settings VARCHAR(255), value VARCHAR(255))";
		$st = $dbh->prepare($sql);
		$sq = $st->execute();
		if ($sq) {
			return 'Config table created <br />';
			$this->themeconfig();
		} else {
			return 'Error. Please contact SimplexPHP for support. Email: <a href="mailto:simplex@lunosolutions.com">mailto:simplex@lunosolutions.com</a>';
		}
	    }
	    public function configtheme()
	    { 
	    try {
	    $st = $dbh->prepare("INSERT INTO config (settings, value) value (:settings, :value)");  
			        $st->execute(array(":settings" => "theme", ":value" => "default"));
			        } catch (PDOException $err) {
			        $error = "yes";
   				return 'Error. Please contact SimplexPHP for support. Email: <a href="mailto:simplex@lunosolutions.com?subject='.$err->getMessage().'">mailto:simplex@lunosolutions.com</a>';	
  				}
  				if ($error != "yes")
  				{
  				 return 'Theme inserted to config <br />';
  				}
	    }
	    public function dbconnection($host,$username,$password,$dbname)
	    {
	        $File = "../include/database.php"; 
 	    	$Handle = fopen($File, 'w');
 	    	$Data = '
<?php
			$MYSQL_HOST = '.$host.';
			$MYSQL_USERNAME = '.$username.';
			$MYSQL_PASSWORD = '.$password.';
			$MYSQL_DATABASE = '.$dbname.';
			try {
				$dbh = new PDO("mysql:host=".$MYSQL_HOST.";dbname=".$MYSQL_DATABASE,$MYSQL_USERNAME,$MYSQL_PASSWORD);
			} catch(PDOException $e){
				
				echo $e->getMessage();
			}
 	    	'; 
	    	fwrite($Handle, $Data); 
 	    	fclose($Handle);  
 	    	return "database information added";
 	    	
	    }
	    
	    
	     public function siteinfo($domain,$sitename)
	    {
	        $File = "../include/database.php"; 
 	    	$Handle = fopen($File, 'a');
 	    	$Data = "
 	    		\$domain = '".$domain."';
 	    		\$sitename = '".$sitename."';
?>
 	    	"; 
	    	fwrite($Handle, $Data); 
 	    	fclose($Handle); 
 	    	return "website information added<br /> Config.php completed";
 	    	
	    }
}



$filename = '../include/database.php';

if (file_exists($filename)) {
    include "../include/config.php";
    if (isset($_POST['Submit']) & ($_GET['step'] == "3"))
    {
    	echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	echo "<hr>Step 3 carry on";
	echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";
    }
    Else
    {
    	echo "installer locked";
    }
} 
else
{
if (!isset($_POST['Submit']) & (!isset($_GET['step'])))
{

	echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	echo "<hr><form action='install.php?step=2' method='post'>";
	echo "Thank you for using SimplexPHP click submit to still the install <br />";
	echo "<input type='hidden' name='step' value='2'>";
	echo "<input type='submit' value='Submit' /></center>";
	echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";
}
ElseIf ($_GET['step'] == "2")
{
	echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	echo "<hr><form action='install.php?step=3' method='post'>";
	echo "Database host:<input type='text' name='host' value='localhost'/><br />";
	echo "Database username:<input type='text' name='username' value='username'/><br />";
	echo "Database password:<input type='password' name='password' value='localhost'/><br />";
	echo "Database type:<input type='text' name='dbname' value='database Name'/><br />";
	echo "<input type='hidden' name='step' value='3'>";
	echo "<input type='submit' value='Submit' /></center></form>";
	echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";
} 
ElseIf ($_GET['step'] == "3") 
{
    if (!isset($_POST['Submit'])) 
     {
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr> Missing database Information Click back button to enter database";
	 echo "<form action='install.php?step=2' method='post'>";
	 echo "<input type='submit' value='back' /></center>";
	 echo "</form>";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";	
     }
     Else
     {
	 $host = $_POST['host'];
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 $dbname = $_POST['dbname'];
	 // Create a new object  
	 $spx = new installer();  
	 // Get the value of $prop1  
	 $Action = $spx->dbconnection($host,$username,$password,$dbname); 
	 unset($spx); 
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr>".$Action;
	 echo "<hr><form action='install.php?step=4' method='post'>";
	 echo "Website domain:<input type='text' name='domain' value='localhost'/><br />";
	 echo "Website name:<input type='text' name='sitename' value='username'/><br />";
	 echo "<input type='hidden' name='step' value='4'>";
	 echo "<input type='submit' value='Submit' /></center></form>";
	 echo "</form>";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";
     }
}
ElseIf ($_GET['step'] == "4") 
{
    if (!isset($_POST['Submit'])) 
     {
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr> Missing database Information Click back button to enter database";
	 echo "<form action='install.php?step=2' method='post'>";
	 echo "<input type='submit' value='back' /></center>";
	 echo "</form>";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";	
     }
     Else
     {
	 $domain = $_POST['domain'];
	 $sitename = $_POST['sitename'];

	 // Create a new object  
	 $spx = new installer;  
	 // Get the value of $prop1  
	 $Action = $spx->siteinfo($domain,$sitename);  
	 unset($spx);
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr>".$Action;
	 echo "<hr> Click next to setup database";
	 echo" <form action='install.php?step=5' method='post'>";
	 echo "<input type='hidden' name='step' value='5'>";
	 echo "<input type='submit' value='Submit' /></center></form>";
	 echo "</form>";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";
     }
}
ElseIf ($_GET['step'] == "5") 
{
$filename = '../include/database.php';
	if (file_exists($filename)) {
	 // Create a new object  
	 $spx = new installer();  
	 // Get the value of $prop1  
	 $Action = $spx->createconfigtable();  
	 unset($spx);
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr>".$Action;
	 echo "<hr> You have skiped a few steps. Please start again.";
	 echo "<form action='install.php?step=finish' method='post'>";
	 echo "<input type='hidden' name='step' value='finish'>";
	 echo "<input type='submit' value='submit' /></center>";
	 echo "</form>";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";
	}
	Else
	{
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr> Missing database Information Click back button to enter database";
	 echo "<form action='install.php?step=2' method='post'>";
	 echo "<input type='submit' value='back' /></center>";
	 echo "</form>";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";		
	}
}
ElseIf ($_GET['step'] == "finish") 
{
$filename = '../include/database.php';
	if (file_exists($filename)) {
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr> Setup completed. Now remove the install folder and your on your way.";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";
	}
	Else
	{
	 echo "<center><h2><strong><u> Simplex installation</u></strong></h2>";
	 echo "<hr> Missing database Information Click back button to enter database";
	 echo "<form action='install.php?step=2' method='post'>";
	 echo "<input type='submit' value='back' /></center>";
	 echo "</form>";
	 echo "<footer><hr><center>&copy; SimplexPHP!</center></footer>";		
	}
}
}
?>