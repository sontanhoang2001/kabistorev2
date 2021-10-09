$(document).ready(function () {

	$('#price-range-submit').hide();

	$("#min_price,#max_price").on('change', function () {

		$('#price-range-submit').show();

		var min_price_range = parseInt($("#min_price").val());

		var max_price_range = parseInt($("#max_price").val());

		if (min_price_range > max_price_range) {
			$('#max_price').val(min_price_range);
		}

		$("#slider-range").slider({
			values: [min_price_range, max_price_range]
		});
		$(".range-price").html("Giá từ: " + new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(min_price_range) + " - " + new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(max_price_range));
		// var url = "products-0-1-0-" + min_price_range + "-" + max_price_range + ".html";
		// $(location).attr('href', url);
	});


	$("#min_price,#max_price").on("paste keyup", function () {

		$('#price-range-submit').show();

		var min_price_range = parseInt($("#min_price").val());

		var max_price_range = parseInt($("#max_price").val());

		if (min_price_range == max_price_range) {

			max_price_range = min_price_range + 100;

			$("#min_price").val(min_price_range);
			$("#max_price").val(max_price_range);
		}

		$("#slider-range").slider({
			values: [min_price_range, max_price_range]
		});

		$(".range-price").html("Giá từ: " + new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(min_price_range) + " - " + new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(max_price_range));
	});

	$("#slider-range,#price-range-submit").click(function () {
		var min_price = $('#min_price').val();
		var max_price = $('#max_price').val();
		$(".range-price").html("Giá từ: " + new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(min_price) + " - " + new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(max_price));
		var url = typeNamePath + "-f" + filter + "p1t" + typePath + "s" + min_price + "e" + max_price + ".html";
		$(location).attr('href', url);
	});

});