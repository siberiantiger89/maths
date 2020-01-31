<?php
	//initialise variables
	$unorganised_data='';
	$organised_data='';
	$asc_checked='checked';
	$desc_checked='';
	$errMsg='';

	//if submit button has been pressed
	if(isset($_POST['submit'])){

		//get user input
		$unorganised_data=$_POST['unorganised_data'];
		$order=$_POST['order'];

		//filter user input
		$unorganised_data=filter_var($unorganised_data,FILTER_SANITIZE_STRING);

		//substr user input
		$unorganised_data=substr($unorganised_data,0,2048);

		//validate user input
		if(!preg_match('/[^0-9a-z \n\r]/i',$unorganised_data)){
			$data_array=preg_split("/[\n\r]+/",$unorganised_data);
			$data_array_count=count($data_array);
			$error_count=0;
			for($i=0;$i<$data_array_count;++$i){
				if(preg_match('(^[a-zA-Z]+\s{1}[0-9]+$)',$data_array[$i])){
					$data_array[$i]=preg_split("/[ ]+/",$data_array[$i]);
				} else {
					$error_count++;
				}
			}
			if($error_count===0){
				function asc_organise($element1,$element2) {
					if ($element1[1]===$element2[1]){
						return 0;
					} else if ($element1[1]<$element2[1]){
						return -1;
					} else {
						return 1;
					}
				}
				function desc_organise($element1,$element2) {
					if ($element1[1]===$element2[1]){
						return 0;
					} else if ($element1[1]>$element2[1]){
						return -1;
					} else {
						return 1;
					}
				}
				if($order==='asc'){
					usort($data_array,'asc_organise');
					$asc_checked='checked';
					$desc_checked='';
				} else {
					usort($data_array,'desc_organise');
					$asc_checked='';
					$desc_checked='checked';
				}
				for($j=0;$j<$data_array_count;++$j){
					$organised_data.=$data_array[$j][0].' '.$data_array[$j][1]."\n";
				}
			} else {
				$errMsg='<div class="row">Invalid input. Please try again.</div>';
			}
		} else {
			$errMsg='<div class="row">Invalid input. Please try again.</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Simple Data Organising in PHP</title>
<style type="text/css">
#container {
	width:437px;
}
.row {
	margin-bottom:20px;
	float:left;
	width:437px;
}
.header {
	float:left;
	font-weight:bold;
	width:200px;
}
.column {
	float:left;
	width:200px;
}
</style>
<script type="text/javascript">
	function organisedListReadOnly(){
		document.getElementById("organised_data").readOnly=true;
	}
</script>
</head>
<body onload="organisedListReadOnly()">
<h1>Mathematical Functions in PHP</h1>
<h2>Simple Data Organising in PHP</h2>
<div id="container">
	<form action="organising.php" method="post">
	<div class="row">
		<div class="header">Input:</div>
		<div class="header">Output:</div>
	</div>
	<div class="row">
		<div class="column">
			<textarea name="unorganised_data" id="unorganised_data" cols="20" rows="10" maxlength="200"><?php echo $unorganised_data; ?></textarea>
		</div>
		<div class="column">
			<textarea name="organised_data" id="organised_data" cols="20" rows="10" maxlength="200"><?php echo $organised_data; ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="column">
			<strong>Ascending: </strong><input type="radio" name="order" value="asc" <?php echo $asc_checked; ?> />
		</div>
		<div class="column">
			<strong>Descending: </strong><input type="radio" name="order" value="desc" <?php echo $desc_checked; ?> />
		</div>
	</div>
	<?php
		echo $errMsg;
	?>
	<div class="row">
		<strong>Note:</strong> Input a set of name-value pairs separated by new lines.
	</div>
	<div class="row">
		<div class="header">
			<input type="submit" name="submit" id="submit" value="Organise Data" />
		</div>
	</div>
	</form>
	<div class="row">
		<a href="index.html" />Index Page</a>
	</div>
</div>
</body>
</html>