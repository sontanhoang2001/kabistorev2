<!DOCTYPE html>
<html>

<head>
    <title>Nice Toast Alert Notification Examples</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <!-- Include Plugin CSS file -->
    <link href="../css/nice-toast/nice-toast-js.min.css" rel="stylesheet" type="text/css" />
    <style>
        html,
        * {
            font-family: 'Inter';
            box-sizing: border-box;
        }

        body {
            background-color: #fafafa;
            line-height: 1.6;
        }

        .lead {
            font-size: 1.5rem;
            font-weight: 300;
        }

        .container {
            margin: 150px auto;
            max-width: 960px;
        }

        .btn {
            padding: 1.25rem;
            border: 0;
            border-radius: 3px;
            background-color: #4F46E5;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <section class="container">
        <h1>Nice Toast Alert Notification Examples</h1>
        <div id="carbon-block" style="margin:2rem auto"></div>
        <div style="margin:2rem auto">

            <script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
        </div>
        <p class="lead">A lightweight, customizable, animated toast plugin for jQuery that helps you create Android Material style alert notifications on the webpage.</p>
        <button type="button" class="btn">Open Toast</button>
    </section>


    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>

    <!-- Include Plugin JS file -->
    <script src="../js/nice-toast/nice-toast-js.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $.niceToast.setup({
                position: "top-right",
                timeout: 15000,
            });

            $('button').click(function(e) {

                let toast = $.niceToast.error('<strong>Error</strong>: The password you entered for the username');

                toast.change('redirecting ...', 2000)

            });
            // Call Plugin
        });
    </script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <script>
        try {
            fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
                method: 'HEAD',
                mode: 'no-cors'
            })).then(function(response) {
                return true;
            }).catch(function(e) {
                var carbonScript = document.createElement("script");
                carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
                carbonScript.id = "_carbonads_js";
                document.getElementById("carbon-block").appendChild(carbonScript);
            });
        } catch (error) {
            console.log(error);
        }
    </script>
</body>

</html>