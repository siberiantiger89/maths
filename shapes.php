<?php
	if(isset($_GET)){
		if((isset($_GET['a']))&&(isset($_GET['b']))&&(isset($_GET['c']))){

			//get user input
			$a=$_GET['a'];
			$b=$_GET['b'];
			$c=$_GET['c'];

			//filter user input
			$a=filter_var($a,FILTER_SANITIZE_NUMBER_INT);
			$b=filter_var($b,FILTER_SANITIZE_NUMBER_INT);
			$c=filter_var($c,FILTER_SANITIZE_NUMBER_INT);

			//substr user input
			$a=substr($a,0,1);
			$b=substr($b,0,1);
			$c=substr($c,0,1);

			//validate user input
			if((is_numeric($a))&&(is_numeric($b))&&(is_numeric($c))){

				//create arrays
				$shapes=array(
					array("0","circle",1,0,0),
					array("1","square",4,4,4),
					array("2","isoceles triangle",3,3,1),
					array("3","rectangle",4,4,2),
					array("4","heart",2,2,1),
					array("5","pentagon",5,5,5),
					array("6","ellipse",1,0,2),
					array("7","parallelogram",4,4,0),
					array("8","rhombus",4,4,4),
					array("9","hexagon",6,6,6)
				);
				$shapes_count=count($shapes);
				$results=array();

				//check the properties of each shape against user input
				for($i=0;$i<$shapes_count;++$i){
					if(($shapes[$i][2]==$a)&&($shapes[$i][3]==$b)&&($shapes[$i][4]==$c)){
						$results[]=$shapes[$i][1];
					}
				}
				$results_count=count($results);

				//display results
				if($results_count>0){
					if($results_count===1){
						$answer='The shape that matches your search query is a <strong>'.$results[0].'</strong>.';
					} else {
						$answer='The shapes that match your search query are ';
						for($j=0;$j<$results_count;++$j){
							if($j===0){
								$answer.='a <strong>'.$results[$j].'</strong> and ';
							} else {
								$answer.='a <strong>'.$results[$j].'</strong>.';
							}
						}
					}
				} else {
					$answer='No shapes found.';
				}
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
<title>Simple Shape Finding in PHP</title>
</head>
<body>
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Shape Finding in PHP</h2>
<form action="shapes.php" method="get">
	<strong>Sides: </strong><input type="text" name="a" value="<?php echo $a; ?>" /><br/><br/>
	<strong>Corners: </strong><input type="text" name="b" value="<?php echo $b; ?>" /><br/><br/>
	<strong>Lines of Symmetry: </strong><input type="text" name="c" value="<?php echo $c; ?>" /><br/><br/>
	<?php echo $answer; ?><br/><br/>
	<input type="submit" value="Find Shape" /><br/><br/>
</form>
<a href="index.html" />Index Page</a>
</body>
</html>