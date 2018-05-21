<?php
	//rediects our user back to the main page if Search = Search..."
	//Weird bug if user presses enter it will still go to query
	if($_GET['q'] == 'Search...'){
	header('Location: Index.php');
	}
	
	$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//	echo $_SERVER['REQUEST_URI_PATH'];
//The above code gets the path but not things like "?q=" but the below get the Current directory including "?q="
//	echo basename($_SERVER['REQUEST_URI']);
	if(basename($_SERVER['REQUEST_URI']) == "Index.php?q="){
		header('Location: Index.php');
	}

	//this makes sure our search query actually has something
	//The isset () function is used to check whether a variable is set or not.

		//$ denotes a variable 
		//mysqli_connect takes IP, User, and password, and DB
	//	$con = mysqli_connect('localhost', 'root', '', 'searchbartest');
	
		if(isset($_GET['q']) ? $_GET['q'] : null !== ''){
		
	$host = '127.0.0.1';
    $user = "codinggorilla00";                     //Your Cloud 9 username
    $pass = "";                                  //Remember, there is NO password by default!
    $db = "searchbartest";                                  //Your database name you want to connect to
    $port = 3306;                                //The port #. It is always 3306
    
    $con = mysqli_connect($host, $user, $pass, $db, $port);
	
	?>
<html>
<head>
<title>Fredonia Clubs Directory</title>
    <link rel="stylesheet" href="css/clubstyles.css">
    <script type = "text/javascript">
		function active(){
	
			var searchBar = document.getElementById('searchBar');
			
			if(searchBar.value == "Search...") {
				searchBar.value = ''
				searchBar.placeholder = 'Search...'
			}
		}
		
		function inactive(){
			var searchBar = document.getElementById('searchBar');
			
			if(searchBar.value == '') {
				searchBar.value = 'Search...'
				searchBar.placeholder = ''
			}
		}
		</script>

</head>
<body>
	<!-- WRAPPER -->

	<!-- BANNER -->
<div id="banner">
</div>

	<!-- MENU TOP -->
<div id="menuTop"> Fredonia Club Directory

<img src="https://pbs.twimg.com/profile_images/473390920943943680/s4WCZVW4.jpeg" width="135" height="135" alt="" >

<img src="https://pbs.twimg.com/profile_images/473390920943943680/s4WCZVW4.jpeg" width="135" height="135" alt="" >

</div>

<div id="columnleft"> <!-- SEARCH BAR & SIDE FEATURES -->
	<div id = "search"> <form action = "Index.php" method="GET" id ="searchForm">
		<!-- onmousedown is what happens when you press down on the mouse, in this case it will call the active() function -->
		<!-- onBlue is what happens after you deselect the object, will call our inactive function -->
		<!-- name="q" is our search query that will be used in php -->	
			<input type = "text" name="q" id ="searchBar" placeholder="" value="Search..." maxlength ="25" autocomplete="off" onmousedown="active();" onBlur="inactive()" /><input type = "submit" id="searchBtn" value="GO" />
			</form>
			 </div>
</div>

<div id="columnright"> <!-- CLUBS -->
	<?php
				//we request and then set the value
				$q = (isset($_GET['q']) ? $_GET['q'] : null);
				//get the data from our DB, $q is our search Query
				$query = mysqli_query($con,"SELECT * FROM clubs WHERE Club_Name LIKE '%$q%' OR  Club_Description LIKE '%$q%' ") or  die(mysqli_error($con));;
				
				//Get the number of rows speicifed in our $query variable
				$num_rows = mysqli_num_rows($query);
				?>
				<p1><strong><?php echo $num_rows; ?> </strong> results for '<?php echo $q; ?>'</p1>
				<?php 
			
				//Parse through our rows of data and while we stil have
				//data keep getting the info and put them on screen
				while($row = mysqli_fetch_array($query)){
					$Club_Name = $row['Club_Name'];
					$Club_Desc = $row['Club_Description'];
					$php = ".php";
					//Take club name get rid of the _, and assign to Club_Names
					$Club_Names = str_replace("_"," ",$Club_Name);
				//if we want to embed html just use '<Html tags>' '</Html tags>
				echo '<h3>'; 
				//TODO CHESS CLUB TAKES THE CURRENT URL DOESN'T MAKE CHANGE
				echo '<a href="'.$Club_Name.$php.'">' . $Club_Names . '</a></h3> <p>' .  $Club_Desc . '</p> <br />';
				}
				
				?>
				
</div>


	<!-- FOOTER -->
<div id="footer">
</div>

</div>

	  </body>
</html>
<?php
}

?>