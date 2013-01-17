/**
 * @author Josh
 */
function State(alert, timestamp) {
	this.alert = alert;
	this.timestamp = timestamp;
}

function MStatus() {
	this.refresh = function() {
		$.getJSON("api/status.php", function(data){
			if (undefined === data.succ) {
			    $.each(data, function(i, item){
			      $("#" + item.id).html(item.value);
			    });
			    
			    if (!isNaN($('#autoManualstateOfExtruder').html())) {
			    	if ($('#autoManualstateOfExtruder').html() == 1) {
			    		$('#autoManualstateOfExtruder').html('自动');
			    	} else {
			    		$('#autoManualstateOfExtruder').html('手动');
			    	}
			    }
			    
			    if (!isNaN($('#autoManualstateOfDragger').html())) {
			    	if ($('#autoManualstateOfDragger').html() == 1) {
			    		$('#autoManualstateOfDragger').html('自动');
			    	} else {
			    		$('#autoManualstateOfDragger').html('手动');
			    	}
			    }
			} else {
				//TODO err handle
			}
		});
	}
}

var mstatus = new MStatus();
$(document).ready(
	function(){
		mstatus.refresh();
		setInterval("mstatus.refresh()", 1000);
	}
)