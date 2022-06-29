$(document).ready(function () {
    // panggil fungsi dari loadData()
    loadData();
    loadJumlah();
    // menampilkan pesanan dari database
    function loadData() {
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
                $('.total-count').text(data);
                if (data > 0) {
                    $(".nextOrder").removeAttr('disabled');
                } else {
                    $(".nextOrder").attr('disabled', 'disabled');
                }
            }
        })
    }


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

    $('.nice-select').on('change', function () {
        const priceSaus = $(this).find(':selected').data('prices');
        $('[id=hargaSaus]').text(priceSaus);
        var priceMenu = $(this).find(':selected').data('pricem');
        var id = $(this).find(':selected').data('id');
        let total = priceSaus + priceMenu;
        $('.addCart').attr("data-price", total);
        $('.addCart').attr("data-kd-saus", id);
        $('.addCart').removeAttr('disabled');
    });

    // menambahkan pesanan ke database
    $('.addCart').on("click", function (e) {
        e.preventDefault();
        // var no_permintaan = $('#no_permintaan').val();
        let kodeMenu = $(this).data('kd-menu');
        let kodeSaus = $(this).data('kd-saus');
        let jenisCart = $(this).data('jenis');
        let fungsi = $(this).data('fungsi');
        let qty = $(this).data('qty');
        let priceMenu = $(this).data('price');
        let totalPrice = priceMenu * qty;
        console.log(jenisCart)
        console.log(fungsi)
        $.ajax({
            data: {
                kd_menu: kodeMenu,
                kd_saus: kodeSaus,
                qty: qty,
                jenis_cart: jenisCart,
                harga: totalPrice,
                fungsi: fungsi,
            },
            type: "POST",
            url: "controller/keranjang_controller.php",
            success: function (data) {
                alert("Ditambahkan ke pesanan");
                $("#modalMenu" + kodeMenu).modal('hide');
                loadData();
                loadJumlah();
                $(".qty").val(1);
                $(".hargaSaus").text("0");
                $('.addCart').attr('disabled', 'disabled');
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
                loadData();
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
                loadData();
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