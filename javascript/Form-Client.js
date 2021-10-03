
$(document).ready(function() {
 
	//Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
	$("#uploadForm").validate({
		rules: {
			name: "required",
			email: "required",
			tel: {
				required: true,
				minlength: 10
			},
			maps_address: "required"
		},
		messages: {
			name: "Vui lòng nhập họ và tên",
			email: "Vui lòng nhập email",
			tel: {
				required: "Vui lòng nhập số điện thoại",
				minlength: "số điện thoại phải trên 10 ký tự"
			},
			maps_address: "Tìm kiếm và ghim vị trí muốn giao hàng"
		}
	});
});



function UploadFile() {
  var reader = new FileReader();
  var file = document.getElementById('attach').files[0];
  reader.onload = function(){
	document.getElementById('fileContent').value=reader.result;
	document.getElementById('filename').value=file.name;
	document.getElementById('uploadForm').submit();
	//window.location.href = "Form-Client-Complete.html"
  }
  reader.readAsDataURL(file);

}

	/*
function loadData() {

	if(('sessionStorage' in window) && 
		window['sessionStorage'] !== null){
		if(sessionStorage.getItem('loginAccount') != null)
			location.href="Form-Client-Complete.html";
	} else
		alert("Trình duyệt không hỗ trợ SessionStorage");
		
	if(('localStorage' in window) && 	
		window['localStorage'] != null) {
		if(localStorage.getItem('ghinho') == "true") {
			document.frmInputPanel.txtName.value 
							        = localStorage.getItem('tenkhachhang');
			document.frmInputPanel.txtEmail.value       
									  = localStorage.getItem('email');
			document.frmInputPanel.txtmobile.value 
                                      = localStorage.getItem('sodienthoai');
            document.frmInputPanel.chkRememberMe.checked 
									  = localStorage.getItem('ghinho');
		} else {
			document.frmInputPanel.txtName.value = "";
            document.frmInputPanel.txtEmail.value = "";
            document.frmInputPanel.txtmobile.value = "";
		}
	}
}
*/

/*
function testSubmit() {
	var tkh = document.frmInputPanel.txtName;
    var em = document.frmInputPanel.txtEmail;
    var sdt = document.frmInputPanel.txtmobile;
	var gn = document.frmInputPanel.chkRememberMe;
		
	if(('localStorage' in window) && 
		window['localStorage'] != null) {
		localStorage.setItem('tenkhachhang', tkh.value);
        localStorage.setItem('email', em.value);
        localStorage.setItem('sodienthoai', sdt.value);
		localStorage.setItem('ghinho', gn.checked);
	} else
		alert("Trình duyệt không hỗ trợ LocalStorage");
	
	if((tkh.value == "") && (em.value == "") && (sdt.value == "")) {

		alert("Thông tin của bạn chưa đầy đủ!");
		return false;

	} else {

		alert("Bạn đã đặt hàng thành công!");
		
		if(('sessionStorage' in window) &&  
			window['sessionStorage'] !== null)
			sessionStorage.setItem('loginAccount', tkh.value);
		 else
			alert("Trình duyệt không hỗ trợ SessionStorage");		
		return true;
		
	}
}
*/

function coppyCode() { 
	var a = document.getElementsByTagName('body')[0].innerHTML;
    document.getElementById("codeField").value = a;
} 