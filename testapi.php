<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
</head>

<body>

</body>
<script>
    $(document).ready(function() {
        let endpoint = 'https://api.linkpreview.net'
        let apiKey = '5b578yg9yvi8sogirbvegoiufg9v9g579gviuiub8'
        // url: endpoint + "?key=" + apiKey + " &q=" + $(this).text(),

        $(".content a").each(function(index, element) {

            $.ajax({
                url: endpoint + "?key=" + apiKey + " &q=" + $(this).text(),
                contentType: "application/json",
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                }
            })
        });
    });
</script>

</html>