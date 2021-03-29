<?php
	session_start();

	$testRoot = "../data/test-results/".$_SESSION['session_id']."/";
	$testRootCharts=$testRoot."/charts/";
	$testResultsFilename = "test_results.csv";
	$testUsersDetails = "user_details.txt";

	if($_GET["action"]=="add"){
		if(!isset($_POST["chart_id"]) || !isset($_POST["bg_color"]) || !isset($_POST["actual_color"]) || !isset($_POST["picked_color"]) || !isset($_POST["time"])){
			http_response_code(400);
			exit();
		}

		if(!file_exists($testRoot)){
			mkdir($testRoot,0777);
		}

		if(!file_exists($testRoot.$testResultsFilename)){
			$heading = '"chart_id","background_color","actual_color","picked_color","euclid_distance","time"';
			file_put_contents($testRoot.$testResultsFilename, $heading.PHP_EOL);
		}

		$row = '"'.$_POST["chart_id"].'","'.$_POST["bg_color"].'","'.$_POST["actual_color"].'","'.$_POST["picked_color"].'","'.$_POST["euclid_dist"].'","'.$_POST["time"].'"';
		file_put_contents($testRoot.$testResultsFilename, $row.PHP_EOL, FILE_APPEND | LOCK_EX);
	}

	else if($_GET["action"]=="image"){
		if(!file_exists($testRootCharts)){
			mkdir($testRootCharts,0777);
		}
	    $img = $_POST['img_base64'];
	    $img = str_replace('data:image/png;base64,', '', $img);  
	    $img = str_replace(' ', '+', $img);  
	    $data = base64_decode($img);  
	    $file = $testRoot."/charts/chart_".$_POST["chart_id"].'.png';  
	    file_put_contents($file, $data);
	}

	else if($_GET["action"]=="email"){
		file_put_contents($testRoot.$testUsersDetails, $_POST["email_address"]);
	}

	else{
		http_response_code(400);
		exit();	
	}
?>