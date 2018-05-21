<?php
//should let us grab variables from Index
//OB start and end just lets us grab the variables without the rest
//ob_start();
//include'Index.php'; ;
//ob_end_clean();

$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', substr($_SERVER['REQUEST_URI_PATH'], 1));
$Club = $segments[1];
$Club_Alter = str_replace(array("_", ".php")," ",$Club);
$Club_Grab = str_replace(".php","",$Club);
$Email = "mailto:";

	if(isset($_GET['q']) ? $_GET['q'] : null !== ''){
		
		//$ denotes a variable 
		//mysqli_connect takes IP, User, and password, and DB
	//	$con = mysqli_connect('localhost', 'root', '', 'searchbartest');
	
	   $host = "127.0.0.1";
    $user = "codinggorilla00";                     //Your Cloud 9 username
    $pass = "";                                  //Remember, there is NO password by default!
    $db = "searchbartest";                                  //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
    $con = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
    		$query = mysqli_query($con,"SELECT * FROM clubs WHERE Club_Name LIKE'$Club_Grab'");
				
				//Get the number of rows speicifed in our $query variable
				$num_rows = mysqli_num_rows($query);
				//Parse through our rows of data and while we stil have
				//data keep getting the info and put them on screen
				while($row = mysqli_fetch_array($query)){
					$Club_Name = $row['Club_Name'];
					$Club_Desc = $row['Club_Description'];
					$President_Name = $row['President_Name'];
					$President_Email = $row['President_Email'];
				}
	}
	
	?>
<html>
<head>
<title><?php echo $Club_Alter ?></title>
    <link rel="stylesheet" href="css/clubstyles.css">
    
			

</head>
<body>
	<!-- WRAPPER -->

	<!-- BANNER -->
<div id="banner">
</div>

	<!-- MENU TOP -->
<div id="menuTop"> <?php echo $Club_Alter ?>

<img src="https://pbs.twimg.com/profile_images/473390920943943680/s4WCZVW4.jpeg" width="135" height="135" alt="" >

<img src="https://pbs.twimg.com/profile_images/473390920943943680/s4WCZVW4.jpeg" width="135" height="135" alt="" >

</div>

<div id="columnleft"> <!-- SEARCH BAR & SIDE FEATURES -->
	<p5><?php echo "Primary Contact" ?> </p5><br>
	<p5> <?php echo $President_Name ?> </p5><br>
	<?php
	echo '<p5><a href="'.$Email.$President_Email.'">' . $President_Email . '</a><p5>';
	?>


	
</div>

<div id="columnright"> <!-- CLUBS -->
	<p3><?php echo   $Club_Desc; ?></p3>
				
</div>


	<!-- FOOTER -->
<div id="footer">
</div>

</div>

	  </body>
</html>
