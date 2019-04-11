$(document).ready(function(){
    
    /* ===Аккордеон=== */
    var openItem = false;
	if(jQuery.cookie("openItem") && jQuery.cookie("openItem") != 'false'){
		openItem = parseInt(jQuery.cookie("openItem"));
	}	
	jQuery("#accordion").accordion({
		active: openItem,
		collapsible: true,
        autoHeight: false,
        header: 'h3'
	});
	jQuery("#accordion h3").click(function(){
		jQuery.cookie("openItem", jQuery("#accordion").accordion("option", "active"));
	});	
	jQuery("#accordion > li").click(function(){
		jQuery.cookie("openItem", null);
        var link = jQuery(this).find('a').attr('href');
        window.location = link;
	});

    /* ===Клавиша ENTER при пересчете=== */
    $(".kolvo").keypress(function(e){
        if(e.which == 13){
            return false;
        }
    });

    /* === пересчет товаров в корзине === */
	$('.kolvo').each(function() {
		var qty_start = $(this).val();

		$(this).change(function() {
            var qty_current = $(this).val();
            var res = confirm("Пересчитать корзину?");
            if(res) {
				var id = $(this).attr("id");
				if(!parseInt(id)) {
                    qty_current = qty_start;
				}
				window.location = "?view=cart&qty=" + qty_current + "&gid=" + id;
			} else {
                $(this).val(qty_start);
			}
		});
	});


	$('.confirm').click(function(){
		var result = confirm('Вы уверены?');
		if(result) {
			return true;
		} else {
			return false;
		}
	});

    /* === заказ товаров из корзины === */
    $(".zakazat-success").click(function(e){
        var res = confirm('Вы уверены, что хотите оформить заказ?');
        if(res) {
            e.preventDefault();
            var order = 1;
            $.ajax({
                url: './',
                type: 'POST',
                data: {order: order},
                success: function(res) {
                    // если заказ успешен
                    $(".result-msg").html(res);
                },
                error: function(res) {
                    // если произошла ошибка
                    $(".result-msg").html(res);
                },
            });
        } else {
            return false;
        }
    });

});