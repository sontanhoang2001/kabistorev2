
$(document).ready(function () {
    $("#search-text").keyup(function () {
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: '~/../callbackPartial/live-search.php',
                method: 'POST',
                data: {
                    searchText: query
                },
                success: function (data) {
                    $('#suggestion').html(data);
                    $('#suggestion').css('display', 'inline-table');

                    $("#search-text").focusout(function () {
                        $('#suggestion').css('display', 'inline-table');
                    });
                    $("#search-text").focusin(function () {
                        $('#suggestion').css('display', 'inline-table');
                    });
                }
            });
        } else {
            $('#suggestion').css('display', 'none');
            $("#search-text").focusout(function () {
                $('#suggestion').css('display', 'none');
            });
            $("#search-text").focusin(function () {
                $('#suggestion').css('display', 'none');
            });
        }
    });
});

