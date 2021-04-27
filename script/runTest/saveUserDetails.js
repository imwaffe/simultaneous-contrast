import * as jQuery from "/libraries/jquery-1.9.0.min.js";
import * as Bootstrap from "/libraries/bootstrap/js/bootstrap.min.js";

var $onSavedDetailsCallback = $.Callbacks();

$.fn.reportValidity = function() {
    var el = this[0];
    return el && el.reportValidity();
};

export default class SaveUserDetails{
	onsave(callback){
		$onSavedDetailsCallback.add(callback);
	}

	constructor(){
		$onSavedDetailsCallback = $.Callbacks();

		$(document).ready(function(){
			var validForm = false;

			$("#userDetailsForm").on("submit",function(e){
			    e.preventDefault();
			});
			
			$("#userDetailsModal").modal("show");

			$("#userDetailsModal").on("hidden.bs.modal", function(){
				if(!validForm)
				    $(this).modal("show");
			});

			$("#saveUserDetails").click(function(){
				validForm = $("#userDetailsForm").reportValidity();
				if(validForm){
					var originalButtonText = $(this).text();
					$(this).attr("disabled","disabled");
					$(this).text("Salvataggio in corso...");
					$.post("functions/saveResults.php?action=userdetails",{
						browser_useragent: navigator.userAgent,
						browser_vendor: navigator.vendor,
						user_nickname: $("#userDetailsForm #user_nickname").val(),
						user_gender: $("#userDetailsForm #user_gender").val(),
						user_works_with_colors: $("#userDetailsForm #user_color").val(),
						user_is_colorblind: $("#userDetailsForm #user_colorblind").val()
					}).done(function(){
						$("#userDetailsModal").modal("hide");
						$onSavedDetailsCallback.fire();
					}).fail(function(){
						validForm = false;
						alert("Si è verificato un errore, ti preghiamo di riprovare");
						$("#saveUserDetails").text(originalButtonText);
						$("#saveUserDetails").removeAttr("disabled");
					});
				}
			});
		});
	}
}