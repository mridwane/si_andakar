$(document).ready(function () {
    // panggil fungsi dari loadData()
    // loadData();
    loadDataCart();
    loadJumlah();
    // menampilkan pesanan dari database
    // function loadData() {
    //     let jenis = $('.sub_page').data('page');
    //     // console.log(jenis)
    //     $.ajax({
    //         url: 'controller/showmenu_controller.php',
    //         method: 'POST',
    //         success: function (data) {
    //             $(".filters-content").html(data);
    //         }
    //     });
    // }

    function loadDataCart() {
        let jenis = $('.sub_page').data('page');
        // console.log(jenis)
        $.ajax({
            url: 'controller/showcart_controller.php',
            method: 'POST',
            data: {
                jenis: jenis,
            },
            success: function (data) {
                $(".show-cart").html(data);
            }
        });
    }

    function loadJumlah() {
        let jenis = $('.sub_page').data('page');
        // console.log(jenis)
        $.ajax({
            url: 'controller/tampilangka_controller.php',
            method: 'POST',
            data: {
                jenis: jenis,
            },
            success: function (data) {
                if (data > 0) {
                    $(".nextOrder").removeAttr('disabled');
                    $('.total-count').text(data);
                } else {
                    $(".nextOrder").attr('disabled', 'disabled');
                }
            }
        })
    }

    // $(window).click(function (e) {
    //     console.log('diklik')
    // });

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
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('.pilih-saus').on('click', function () {
        const priceSaus = $(this).find(':selected').data('prices');
        $('[id=hargaSaus]').text(priceSaus);
        var priceMenu = $(this).find(':selected').data('pricem');
        var id = $(this).find(':selected').data('id');
        let total = priceSaus + priceMenu;
        $('.addCart').attr("data-price", total);
        $('.addCart').attr("data-kd-saus", id);
        $('.addCart').removeAttr('disabled');
    });

    $('.kematangan').on('click', function () {
        const kematangan = $(this).find(':selected').data('tingkat');;
        $('.addCart').attr("data-kematangan", kematangan);
        $('.addCart').removeAttr('disabled');
    });

    $('.showOption').click(function (e) {
        e.preventDefault();
        $(".qty").val(1);
        $(".hargaSaus").text("0");
        $('.addCart').attr('data-qty', '1');
        $(".nice-select").val('').change();
        // if (kodeSaus === 'S100') {
        //     $('.addCart').removeAttr('disabled');
        // } else {
        //     $('.addCart').attr('disabled', 'disabled');
        // }
    });

    // menambahkan pesanan ke database
    $('.addCart').on("click", function (e) {
        e.preventDefault();
        // var no_permintaan = $('#no_permintaan').val();
        let kodeMenu = $(this).data('kd-menu');
        let kodeSaus = $(this).data('kd-saus');
        let jenisCart = $(this).data('jenis');
        let fungsi = $(this).data('fungsi');
        let kematangan = $(this).data('kematangan');
        // var qty = $(this).data('qty');
        var qty = $(this).data('qty');
        let priceMenu = $(this).data('price');
        let totalPrice = priceMenu * qty;

        $.ajax({
            data: {
                kd_menu: kodeMenu,
                kd_saus: kodeSaus,
                qty: qty,
                jenis_cart: jenisCart,
                kematangan: kematangan,
                harga: totalPrice,
                fungsi: fungsi,
            },
            type: "POST",
            url: "controller/keranjang_controller.php",
            success: function (data) {
                alert("Ditambahkan ke pesanan");
                $("#modalMenu" + kodeMenu).modal('hide');
                loadDataCart();
                loadJumlah();
                location.reload();
            },
            error: function (data, error) {
                window.location.reload();
                alert("gagal Menambahkan ke pesanan");
            },
        });
    });

    // fungsi untuk menghapus menu di cart
    $('.show-cart').on("click", ".delete-item", function (e) {
        e.preventDefault();
        let id = $(this).data('id-cart');
        let fungsi = "Delete";

        $.ajax({
            data: {
                id: id,
                fungsi: fungsi,
            },
            type: "POST",
            url: "controller/keranjang_controller.php",
            success: function (data) {
                // window.location.reload();
                alert("Menu Dihapus");
                loadDataCart();
                loadJumlah();
                $("#cartlMenu").modal('hide');
            },
            error: function (data, error) {
                // window.location.reload();
                alert("gagal Menambahkan ke pesanan");
            },
        });
    })

    $('.clear-cart').on("click", function (e) {
        e.preventDefault();
        let jenis_cart = $(this).data('jenis');
        let fungsi = "DeleteAll";

        $.ajax({
            data: {
                fungsi: fungsi,
                jenis_cart: jenis_cart,
            },
            type: "POST",
            url: "controller/keranjang_controller.php",
            success: function (data) {
                // window.location.reload();
                alert("Keranjang pesanan dikosongkan");
                loadDataCart();
                loadJumlah();
                $("#cartMenu").modal('hide');
            },
            error: function (data, error) {
                // window.location.reload();
                alert("gagal Menambahkan ke pesanan");
            },
        });
    })

});