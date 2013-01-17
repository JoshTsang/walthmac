/**
 * @author Josh
 */
function User(id, name, permission) {
	this.id = id;
	this.name = name;
	this.permission = permission;
}

function Users() {
	this.users = new Array();
	
	this.load = function() {
		$.getJSON("api/users.php", function(data){
			if (undefined === data.succ) {
				$("#users").html("");
				var row = new String();
			    $.each(data, function(i, item){
			    	users.users[i] = new User(item.id, item.name, item.permission);
			    	row = '<tr><td class="argName">' + item.name;
			    	if ($("#cup").html() >= item.permission || $("#cun").html == item.name) {
			    		row += '</td><td><div class="pull-right"><a class="btn btn-primary " OnClick="javascript:update(' + i +')">修改</a> ';
			    		if ($("#cun").html != item.name) {
			    			row += '&nbsp; <a class="btn btn-primary" OnClick="javascript:remove(' + i +')">删除</a>';
			    		}
			    		
			    		row += '</div></td>';
			    	} else {
			    		row += '</td><td> </td>';
			    	}
			    	
			    	row += '</tr>';
			    	$("#users").append(row);
			    });
			} else {
				//TODO err handle
			}
		});
	}
	
	this.add = function(id) {
		var name = $("#uname").val();
		var passwd = $("#passwd").val();
		var pwdConfirm = $("#pwdConfirm").val();
		if (isNull(name)) {
			alert("用户名不能为空!");
			return;
		}
		
		if ($("#pwd").length > 0) {
			if (isNull(passwd) || isNull(pwdConfirm)) {
				alert("密码不能为空!");
				return;
			}
			if (passwd != pwdConfirm) {
				alert("2次输入密码不同!");
				return;
			}
		}
		
		var user = new Object();
		var url;
		if (!isNaN(id)) {
			user.id = id;
			url = "api/users.php?do=update";
		} else {
			url = "api/users.php?do=add";
		}
		
		$("#addUserBtn").button("loading");
		user.name = name;
		if ($("#pwd").length > 0) {
			user.pwd = passwd;
		}
		if ($("#permission").length > 0) {
			user.permission = $("#permission").val();
		}
		
		$.post(url, {user:$.toJSON(user)}, function(data){
			if (true == data.succ) {
				window.location.href="manage.php";	
			} else {
				alert("提交失败!");
			}
			$("#addUserBtn").button("reset");
		}, "json");
	}
	
	this.update = function(event) {
		users.add(event.data.id);
	}
	
	this.remove = function(id) {
		var user = new Object();
		user.id = id;
		$.post("api/users.php?do=delete", {user:$.toJSON(user)}, function(data){
			if (true == data.succ) {
				users.load();
			} else {
				alert("删除失败!");
			}
			$("#addUserBtn").button("reset");
		}, "json");
	}
}

var users = new Users();

var remove = function(index) {
	var user = users.users[index];
	var ret = confirm("确认删除用户：" + user.name + " ?");
	if (ret == true) {
		users.remove(user.id);
	}
}

var update = function(index) {
	var user = users.users[index];
	
	window.location.href="user.php?uname=" + user.name + "&uid=" + user.id + "&permission=" + user.permission;

}