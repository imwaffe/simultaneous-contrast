<?php
    session_start();
    $_SESSION['visited_index'] = false;
?>

<?php include "components/header.php"; ?>

<style>
	.footer-row{
		color:#aaaaaa;
		margin-top:100px;
		font-size:10pt;
	}
</style>

<body>
    <div class="jumbotron vertical-center">
    	<div class="container description">
    		<div class="row">
	    		<div class="col-md-2"></div>
	    		<div class="col-md-8">
		    		<h1>C'è un problema<br>:(</h1>
		    		<p>
		    			Non puoi eseguire questo test su un dispositivo mobile.<br>
		    			Utilizza un laptop o un computer desktop.
		    		</p>
		    	</div>
		    	<div class="col-md-2"></div>
		    </div>
		    <div class="row footer-row">
		    	<div class="col-md-12">
		    		<h3>License</h3>
		    		<p>
			            CC BY-NC Luca Armellin - github: <a href="https://github.com/imwaffe/" target="_blank">@imwaffe</a><br>
			            <a href="http://www.virtuosoft.eu/code/jquery-colorpickersliders/" target="_blank">jQuery Color Picker Sliders</a>, Apache License Version 2.0 by <a href="https://github.com/istvan-ujjmeszaros" target="_blank">István Ujj-Mészáros</a>
			        </p>
		    	</div>
		    </div>
    	</div>
    </div>
</body>
</html>