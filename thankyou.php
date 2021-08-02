<?php
    session_start();
    if(!isset($_SESSION['visited_test']) || $_SESSION['visited_test']==false)
        header("location: index.php");

    $_SESSION['visited_test'] = false;
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
		    		<h1><?php t("global", "thanks") ?>!</h1>
		    		<p>
		    			<?php t("test_end", "thanks") ?><br>
		    			<?php t("test_end", "give_us_your_email") ?>
		    		</p>
		    		<form class="form-inline" id="email-form">
					  <div class="form-group mx-sm-3 mb-2">
					    <label for="inputEmail" class="sr-only"><?php t("global", "email_address") ?></label>
					    <input type="email" class="form-control" id="inputEmail" placeholder="<?php t("global", "email_address") ?>" required>
					  </div>
					  <button type="submit" class="btn btn-primary mb-2"><?php t("global", "save") ?></button>
					</form>
					<p id="email-success" style="display: none;">
						<b><?php t("test_end", "thanks_for_email") ?></b>
					</p>
					<p id="email-wait" style="display: none;">
						<b><?php t("global", "please_wait") ?></b>
					</p>
					<p id="email-fail" style="display: none;">
						<b><?php t("global", "problem_experienced_title") ?></b><br>
						<?php t("global", "please_try_again") ?>
					</p>
		    	</div>
		    	<div class="col-md-2"></div>
		    </div>
		    <div class="row footer-row">
		    	<div class="col-md-12">
		    		<h3>License</h3>
                    <p>
                        CC BY-NC <a href="http://www.armellinluca.com" target="_blank">Luca Armellin</a> - github: <a href="https://github.com/imwaffe/simultaneous-contrast" target="_blank">@imwaffe</a><br>
                        <a href="http://www.virtuosoft.eu/code/jquery-colorpickersliders/" target="_blank">jQuery Color Picker Sliders</a>, Apache License Version 2.0 by <a href="https://github.com/istvan-ujjmeszaros" target="_blank">István Ujj-Mészáros</a><br>            
                        <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, released under <a href="http://www.opensource.org/licenses/mit-license.php" target="_blank">MIT License</a>
                    </p>
		    	</div>
		    </div>
    	</div>
    </div>
</body>

<script type="text/javascript">
	$(document).ready(function(){
		$("#email-form").submit(function(e){
	    	$("#email-form").hide(100);
	    	$("#email-fail").hide(100);
	    	$("#email-wait").show(100);
			$.post("functions/saveResults.php?action=userdetails",{
	        	user_email_address:$("#inputEmail").val()
	    	}).done(function(data){
	    		$("#email-wait").hide(100);
	    		$("#email-success").show(100);
	    	}).fail(function(){
	    		$("#email-wait").hide(100);
	    		$("#email-fail").show(100);
	    		$("#email-form").show(100);
	    	});
			e.preventDefault();
		});
	});
</script>

</html>