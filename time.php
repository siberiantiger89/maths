<?php
	if(isset($_GET)){
		if((isset($_GET['a']))&&(isset($_GET['b']))&&(isset($_GET['c']))){

			//get user input
			$a=$_GET['a'];
			$b=$_GET['b'];
			$c=$_GET['c'];
			$d=$_GET['d'];

			//filter user input
			$a=filter_var($a,FILTER_SANITIZE_STRING);
			$b=filter_var($b,FILTER_SANITIZE_STRING);
			$c=filter_var($c,FILTER_SANITIZE_NUMBER_INT);
			$d=filter_var($d,FILTER_SANITIZE_NUMBER_INT);

			//substr user input
			$a=substr($a,0,18);
			$b=substr($b,0,2);
			$c=substr($c,0,200);
			$d=substr($d,0,200);

			$numbers='(one|two|three|four|five|six|seven|eight|nine|ten|eleven|twelve)';
			$hours_array=array(
						array('one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve'),
						array('01','02','03','04','05','06','07','08','09','10','11','12')
			);

			//validate user input
			if((preg_match("/^(?:1[012]|0[0-9]):[0-5][0-9]$/",$a))&&(($b==='am')||($b==='pm'))&&(is_numeric($c))&&(is_numeric($d))){
				$time_array=explode(':',$a);
				$time_array[0]=$time_array[0]+$c;
				$time_array[1]=$time_array[1]+$d;
				if($time_array[1]>=60){
					$time_array[0]=$time_array[0]+floor($time_array[1]/60);
					$time_array[1]=$time_array[1]%60;
				}
				if((($time_array[0]/12)%2)===1){
					if($b==='am'){
						$period='pm';
					} else {
						$period='am';
					}
				} else {
					$period=$b;
				}
				$time_array[0]=(($time_array[0])%12);
				if($time_array[0]===0){
					$time_array[0]=12;
				}
				$answer=str_pad(($time_array[0]),2,0,STR_PAD_LEFT).':'.str_pad(($time_array[1]),2,0,STR_PAD_LEFT).' '.$period;
			} else if ((preg_match('/(((quarter (past|to))|(half past)) '.$numbers.'$)|('.$numbers.' o&#39;clock$)/i',$a))&&(($b==='am')||($b==='pm'))&&(is_numeric($c))&&(is_numeric($d))){
				if(preg_match("/".$numbers." o&#39;clock$/i",$a)){
					for($i=0;$i<12;++$i){
						$time=str_replace($hours_array[0][$i].' o&#39;clock',$hours_array[1][$i].':00',strtolower($a));
						if(preg_match("/^(?:1[012]|0[0-9]):[0-5][0-9]$/",$time)){
							$i=12;
						}
					}
				} else if (preg_match("/(((quarter (past|to))|(half past)) ".$numbers."$)/i",$a)){
					$word_array=explode(' ',strtolower($a));
					for($i=0;$i<12;++$i){
						$word_array[2]=str_replace($hours_array[0][$i],$hours_array[1][$i],strtolower($word_array[2]));
					}
					if($word_array[0]=='quarter'){
						if($word_array[1]=='past'){
							$time=$word_array[2].':15';
						} else if ($word_array[1]=='to'){
							$time=($word_array[2]-1).':45';
						}
					} else if ($word_array[0]=='half'){
						$time=$word_array[2].':30';
					}
				}
				$time_array=explode(':',$time);
				$time_array[0]=$time_array[0]+$c;
				$time_array[1]=$time_array[1]+$d;
				if($time_array[1]>=60){
					$time_array[0]=$time_array[0]+floor($time_array[1]/60);
					$time_array[1]=$time_array[1]%60;
				}
				if((($time_array[0]/12)%2)===1){
					if($b==='am'){
						$period='pm';
					} else {
						$period='am';
					}
				} else {
					$period=$b;
				}
				$time_array[0]=(($time_array[0])%12);
				if($time_array[0]===0){
					$time_array[0]=12;
				}
				$answer=str_pad(($time_array[0]),2,0,STR_PAD_LEFT).':'.str_pad(($time_array[1]),2,0,STR_PAD_LEFT).' '.$period;
			} else {
				$answer='Invalid input. Please try again.';
			}
		} else {
			$a='';
			$b='';
			$c='';
			$d='';
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
	<strong>Time: </strong><input type="text" name="a" value="<?php echo $a; ?>" /> <select name="b"><option value="am" <?php if($b==='am'){echo 'selected';}?>>am</option><option value="pm" <?php if($b==='pm'){echo 'selected';}?>>pm</option></select> + <input type="text" name="c" value="<?php echo $c; ?>" /> hours <input type="text" name="d" value="<?php echo $d; ?>" /> minutes = <?php echo $answer; ?><br/><br/>
	<input type="submit" value="Calculate Time" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>