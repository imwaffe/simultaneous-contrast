<?php
    session_start();
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
		    		<h1>Grazie!</h1>
		    		<p>
		    			Ti ringraziamo per aver completato correttamente il test!<br>
		    			Se vuoi, lasciaci il tuo <b>indirizzo email</b>, così potremo contattarti per altri test, altrimenti puoi pure chiudere questa finestra.
		    		</p>
		    		<form class="form-inline" id="email-form">
					  <div class="form-group mx-sm-3 mb-2">
					    <label for="inputEmail" class="sr-only">Indirizzo email</label>
					    <input type="email" class="form-control" id="inputEmail" placeholder="Indirizzo email" required>
					  </div>
					  <button type="submit" class="btn btn-primary mb-2">Salva</button>
					</form>
					<p id="email-success" style="display: none;">
						<b>Grazie per il tuo contributo!</b>
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

<script type="text/javascript">
	$(document).ready(function(){
		$("#email-form").submit(function(e){
			$.post("functions/saveResults.php?action=email",{
	        	email_address:$("#inputEmail").val()
	    	}).done(function(data){
	    		$("#email-form").hide(100);
	    		$("#email-success").show(100);
	    	});
			e.preventDefault();
		});
	});
</script>

</html>