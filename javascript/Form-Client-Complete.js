function loadData() {
	if(('sessionStorage' in window) && window['sessionStorage'] !== null){
		if(sessionStorage.getItem('loginAccount') == null) {
			alert("Bạn chưa đăng nhập");
			location.href="Form-Client.html";
		} else {
			document.getElementById("divWelcome").innerHTML = 
				"Xin chào " + sessionStorage.getItem('loginAccount') + 
				".<br/>Chúc mừng bạn đã đặt hàng thành công!";
		}
	} else {
		alert("Trình duyệt không hỗ trợ SessionStorage");
	}
}
function logout() {
	if(('sessionStorage' in window) && window['sessionStorage'] !== null){
		sessionStorage.removeItem('loginAccount');
		location.href="Form-Client.html";
	} else {
		alert("Trình duyệt không hỗ trợ SessionStorage");
	}
}