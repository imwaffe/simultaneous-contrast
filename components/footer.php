	<script type="module" src="script/chartsLoader.js"></script>
	<script type="module">
		import {addRewriteChartCallback, canvasDrawer} from "./script/chartsLoader.js"
		$(document).ready(function(){
			addRewriteChartCallback(function(){
				$(".cp-slider.cp-hslhue").find("span").text("<?php t("global","hue") ?>");
				$(".cp-slider.cp-hslsaturation").find("span").text("<?php t("global","saturation") ?>");
				$(".cp-slider.cp-hsllightness").find("span").text("<?php t("global","brightness") ?>");
			});
			
		});
	</script>
</html>