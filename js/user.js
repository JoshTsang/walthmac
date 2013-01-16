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
				$("#users").html();
			    $.each(data, function(i, item){
			    	users.users[i] = new User(item.id, item.name, item.permission);
			    	$("#users").append('<tr><td class="argName">' + item.name + 
			    	'</td><td><a class="btn btn-primary pull-right" OnClick="javascript:update(' + i +')">修改</a></td></tr>');
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
		
		if ($("#pwd").is(":visible")) {
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
		if ($("#pwd").is(":visible")) {
			user.pwd = passwd;
		}
		user.permission = $("#permission").val();
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
}

var users = new Users();

var update = function(index) {
	var user = users.users[index];
	window.location.href="user.php?uname=" + user.name + "&uid=" + user.id + "&permission=" + user.permission;
}