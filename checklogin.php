<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="js/jquery-lib/jquery-ui.css" />
    <style type="text/css">
        .ui-datepicker {
            font-size: 75%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $(":input").css("width", "170px");
            $("#ThemSP").css("width", "auto");

            $("#F_SP_THEM div").css({
                "color": "red",
                "display": "none"
            });

            $("#F_SP_THEM").submit(function() {
                duLieuDung = true;
                if (this.TenSP.value == "") {
                    duLieuDung = false;
                    $("#TB_TenSP").show().delay(3000).fadeOut(1000);
                }
                if (/^\d+$/.test(this.SL.value) == false) {
                    duLieuDung = false;
                    $("#TB_SP").show().delay(3000).fadeOut(1000);
                }
                if (this.SL.value == "") {
                    duLieuDung = false;
                    $("#TB_SL").show().delay(3000).fadeOut(1000);
                }

                return duLieuDung;
            });
        });
    </script>
</head>

<body>
    <form id="F_SP_THEM" name="F_SP_THEM" method="post" action="" enctype="multipart/form-data">
        <table width="783" border="0" align="center">
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" align="center">
                    <h2>Thêm sản phẩm</h2>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Tên sản phẩm</td>
                <td>
                    <input name="TenSP" />
                    <div id="TB_TenSP">Tên sản phẩm không được rỗng</div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>Số lượng</td>
                <td><label for="textfield2"></label>
                    <input name="SL" />
                    <div id="TB_SL">Số lượng phải là số nguyên dương</div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" value="Thêm" id="ThemSP" /></td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </form>
</body>

</html>