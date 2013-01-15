/**
 * @author Josh
 */
var updateArg = function(id) {
	var name = $("tr#" + id + " .argName").html();
	name = name.substring(0, name.length - 1);
	var newValue = prompt("请输入 " + name + " 的值", $("#" + id + " .argValue").val());
	if (newValue != null && newValue != "") {
		if (isNumber(newValue)) {
			setArg(id, newValue);
		} else {
			alert("无效的值!");
		}
	}
}

var setArg = function(id, value) {
	alert("set " + id + " to " + value);
}

function Args() {
	this.refresh = function() {
		$.getJSON("api/args.php", function(data){
			if (undefined === data.succ) {
			    $.each(data, function(i, item){
			      $("#" + item.id + " .argValue").html(item.value);
			    });
			} else {
				//TODO err handle
			}
		});
	}
}

var args = new Args();
$(document).ready(
	function(){
		args.refresh();
		//setInterval("args.refresh()",5000);
	}
)