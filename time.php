<?php
	if(isset($_GET)){
		if((isset($_GET['a']))&&(isset($_GET['b']))&&(isset($_GET['c']))){

			//get user input
			$a=$_GET['a'];
			$b=$_GET['b'];
			$c=$_GET['c'];

			//filter user input
			$a=filter_var($a,FILTER_SANITIZE_STRING);
			$b=filter_var($b,FILTER_SANITIZE_NUMBER_INT);
			$c=filter_var($c,FILTER_SANITIZE_NUMBER_INT);

			//substr user input
			$a=substr($a,0,5);
			$b=substr($b,0,200);
			$c=substr($c,0,200);

			//validate user input
			if((preg_match("/^(?:1[012]|0[0-9]):[0-5][0-9]$/",$a))&&(is_numeric($b))&&(is_numeric($c))){
				$time_array=explode(':',$a);
				if(($time_array[1]+($c%60))>=60){
					$time_array[0]++;
				}
				$answer=((str_pad((($time_array[0]+$b+(floor($c/60)))%12),2,0,STR_PAD_LEFT)).':'.(str_pad(((($time_array[1]+($c%60)))%60),2,0,STR_PAD_LEFT)));
			} else {
				$answer='Invalid input. Please try again.';
			}
		} else {
			$a='';
			$b='';
			$c='';
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
	<strong>Time: </strong><input type="text" name="a" value="<?php echo $a; ?>" /> + <input type="text" name="b" value="<?php echo $b; ?>" /> hours <input type="text" name="c" value="<?php echo $c; ?>" /> minutes = <?php echo $answer; ?><br/><br/>
	<input type="submit" value="Calculate Time" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>