$(document).ready(function () {
    // fungsi untuk tombol tambah dan kurang
    $('.btn-number').click(function (e) {
        e.preventDefault();
        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }
                let qty = $('.qty').val();
                $('.addCart').attr('data-qty', qty);

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }
                let qty = $('.qty').val();
                $('.addCart').attr('data-qty', qty);
            }
        } else {
            input.val(0);
        }
    });
    // $('.input-number').focusin(function () {
    //     $(this).data('oldValue', $(this).val());
    // });
    // $('.input-number').change(function () {

    //     minValue = parseInt($(this).attr('min'));
    //     maxValue = parseInt($(this).attr('max'));
    //     valueCurrent = parseInt($(this).val());

    //     name = $(this).attr('name');
    //     if (valueCurrent >= minValue) {
    //         $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    //     } else {
    //         alert('Sorry, the minimum value was reached');
    //         $(this).val($(this).data('oldValue'));
    //     }
    //     if (valueCurrent <= maxValue) {
    //         $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    //     } else {
    //         alert('Sorry, the maximum value was reached');
    //         $(this).val($(this).data('oldValue'));
    //     }


    // });
    // $(".input-number").keydown(function (e) {
    //     // Allow: backspace, delete, tab, escape, enter and .
    //     if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
    //         // Allow: Ctrl+A
    //         (e.keyCode == 65 && e.ctrlKey === true) ||
    //         // Allow: home, end, left, right
    //         (e.keyCode >= 35 && e.keyCode <= 39)) {
    //         // let it happen, don't do anything
    //         return;
    //     }
    //     // Ensure that it is a number and stop the keypress
    //     if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
    //         e.preventDefault();
    //     }
    // });

    $('.nice-select').on('change', function () {
        const priceSaus = $(this).find(':selected').data('prices');
        $('[id=hargaSaus]').text(priceSaus);
        var priceMenu = $(this).find(':selected').data('pricem');
        var id = $(this).find(':selected').data('id');
        let total = priceSaus + priceMenu;
        $('.addCart').attr("data-price", total);
        $('.addCart').attr("data-kd-saus", id);
    });


    $('.addCart').on("click", function (e) {
        e.preventDefault();
        // var no_permintaan = $('#no_permintaan').val();
        let kodeMenu = $(this).data('kd-menu');
        let kodeSaus = $(this).data('kd-saus');
        let jenisCart = $(this).data('jenis');
        let qty = $(this).data('qty');
        let priceMenu = $(this).data('price');
        let totalPrice = priceMenu * qty;
        // console.log(kodeMenu)
        // console.log(kodeSaus)
        // console.log(jenisCart)
        // console.log(qty)
        // console.log(priceMenu)
        // console.log(totalPrice)

        $.ajax({
            data: {
                kd_menu: kodeMenu,
                kd_saus: kodeSaus,
                qty: qty,
                jenis_cart: jenisCart,
                harga: totalPrice,
            },
            type: "POST",
            url: "controller/keranjang_controller.php",
            success: function (data) {
                // window.location.reload();
                alert("Ditambahkan ke pesanan");
                // console.log("Berhasil")
                $("#modalMenu" + kodeMenu).modal('hide');
            },
            error: function (data, error) {
                // window.location.reload();
                alert("gagal Menambahkan ke pesanan");
                $("#modalMenu" + kodeMenu).modal('hide');
                // console.log(arguments);
                // console.log("Gagal");
            },
        });
    });
});