/**
 * @author Josh
 */
function Alert(alert, timestamp) {
	this.alert = alert;
	this.timestamp = timestamp;
}

function Alerts() {
	this.refresh = function() {
		$.getJSON("api/alerts.php", function(data){
			if (undefined === data.succ) {
				$("#alerts").html("");
			    $.each(data, function(i, alert){
			      $("#alerts").append('<tr><td><span class="alertInfo">' + alert.alert + 
			      '</span><br/><spsan class="alertTime pull-right">' + 
			      alert.timestamp + '</span></td></tr>');
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

var alerts = new Alerts();
$(document).ready(
	function(){
		alerts.refresh();
		setInterval("alerts.refresh()",5000);
	}
)