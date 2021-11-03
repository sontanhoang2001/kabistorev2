<!DOCTYPE html>
<html>

<head>
    <title>TinyMCE - Setup</title>
</head>

<body>
    <textarea class="tinymce"></textarea>

    <!-- javascript -->
    <!-- Latest compiled and minified CSS & JS -->
    <script src="//code.jquery.com/jquery.js"></script>


    <!-- BEGIN: load jquery -->
    <!-- <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script> -->
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>


    <!-- END: load jquery -->
    <script src="js/setup.js" type="text/javascript"></script>

    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
    <!-- Load TinyMCE -->
</body>

</html>