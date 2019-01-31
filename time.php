<?php
	if(isset($_GET)){
		if((isset($_GET['a']))&&(isset($_GET['b']))){

			//get user input
			$a=$_GET['a'];
			$b=$_GET['b'];

			//filter user input
			$a=filter_var($a,FILTER_SANITIZE_STRING);
			$b=filter_var($b,FILTER_SANITIZE_NUMBER_INT);

			//substr user input
			$a=substr($a,0,5);
			$b=substr($b,0,200);

			//validate user input
			if((preg_match("/^(?:1[012]|0[0-9]):[0-5][0-9]$/",$a))&&(is_numeric($b))){
				$time_array=explode(':',$a);
				$answer=((str_pad((($time_array[0]+$b)%12),2,0,STR_PAD_LEFT)).':'.$time_array[1]);
			} else {
				$answer='Invalid input. Please try again.';
			}
		} else {
			$a='';
			$b='';
			$answer='';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Time Calculating in PHP</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Time Calculating in PHP</h2>
<form action="time.php" method="get">
	<strong>Time: </strong><input type="text" name="a" value="<?php echo $a; ?>" /> + <input type="text" name="b" value="<?php echo $b; ?>" /> hours = <?php echo $answer; ?><br/><br/>
	<input type="submit" value="Calculate Time" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>