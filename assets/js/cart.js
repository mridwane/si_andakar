// ************************************************
// Shopping Cart API
// ************************************************

var shoppingCart = (function () {
    // =============================
    // Private methods and propeties
    // =============================
    cart = [];

    // Constructor
    function Item(kode, name, price, count) {
        this.kode = kode;
        this.name = name;
        this.price = price;
        this.count = count;
    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
        // sessionStorage.removeItem('shoppingCart');
        toastr.success('Keranjang Berhasil di update');
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }
    if (sessionStorage.getItem("shoppingCart") != null) {
        loadCart();
    }


    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};

    // Add to cart
    obj.plusCart = function (kode, name, price, count) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart[item].count++;
                saveCart();
                return;
            }
        }
        var item = new Item(kode, name, price, count);
        cart.push(item);
        saveCart();
    }

    obj.addItemToCart = function (kode, name, price, count) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart[item].count++;
                saveCart();
                return;
            }
        }
        var item = new Item(kode, name, price, count);
        cart.push(item);
        saveCart();
        // sessionStorage.removeItem(item);
    }
    // Set count from item
    obj.setCountForItem = function (kode, count) {
        for (var i in cart) {
            if (cart[i].kode === kode) {
                cart[i].count = count;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function (kode) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart[item].count--;
                if (cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function (kode) {
        for (var item in cart) {
            if (cart[item].kode === kode) {
                cart.splice(item, 1);
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function () {
        cart = [];
        saveCart();
    }

    // Count cart 
    obj.totalCount = function () {
        var totalCount = 0;
        for (var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function () {
        var totalCart = 0;
        for (var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));

        // return totalcart;
    }

    // List cart
    obj.listCart = function () {
        var cartCopy = [];
        for (i in cart) {
            item = cart[i];
            itemCopy = {};
            for (p in item) {
                itemCopy[p] = item[p];

            }
            itemCopy.total = Number(item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy)
        }
        return cartCopy;
    }

    // cart : Array
    // Item : Object/Class
    // addItemToCart : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCart : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
})();


// *****************************************
// Triggers / Events
// ***************************************** 
// Add item
$('.add-to-cart').click(function (event) {
    event.preventDefault();
    var kode = $(this).data('kode');
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    // let price = priceMenu + priceSaus;
    // console.log(price);
    shoppingCart.addItemToCart(kode, name, price, 1);
    displayCart();
    // $(this).attr("data-pricesaus", "0");
    // loadCart();
});

// function selectSaus() {
//     var tes = document.getElementById("saus").value;
//     console.log(tes)
// }
// const iconBtn = document.querySelector('.nice-select');
// for (var i = 0; i < iconBtn.length; i++) {
//     iconBtn[i].addEventListener("change", function (e) {
//         e.preventDefault();
//         // let password = this.childNodes[1];
//         // const iconSvg = this.childNodes[1];
//         // if (password.type === "password") {
//         //     password.type = "text";
//         // } else {
//         //     password.type = "password";
//         // }
//         // iconSvg.classList.toggle('icon-show');
//         const price = $('.nice-select option:selected').data('prices');
//         // var tes = document.getElementById("saus").value;
//         // const data = document.querySelector('#saus').dataset.prices.
//         console.log(price);
//     });
// }


// $('#saus').on('change', function () {
//     // ambil data dari elemen option yang dipilih
//     let price = $('#saus option:selected').data('prices');
//     // const name = $('select option:selected').data('names');

//     // kalkulasi total harga
//     // const totalDiscount = (price * discount / 100)
//     // const total = price - totalDiscount;

//     // tampilkan data ke element
//     // $('[name=price]').val(price);
//     // $('[name=discount]').val(totalDiscount);

//     // $('#total').text(`Rp ${total}`);
//     // console.log(price);
//     console.log(price);
// });

// $("input[type = 'button']").click(function () {
//     var radioValue = $('input:checked').val();
//     if (radioValue) {
//         console.log("result: Anda Memilih" + radioValue);
//     }
// });

// Clear items
$('.clear-cart').click(function () {
    shoppingCart.clearCart();
    displayCart();
});



function displayCart() {

    var cartArray = shoppingCart.listCart();
    var output = "";
    for (var i in cartArray) {
        // konversi ke rupiah
        // price
        // var total = cartArray[i].price
        // var number_string = total.toString(),
        //     sisa = number_string.length % 3,
        //     price = number_string.substr(0, sisa),
        //     ribuan = number_string.substr(sisa).match(/\d{3}/g);

        // if (ribuan) {
        //     separator = sisa ? '.' : '';
        //     price += separator + ribuan.join('.');
        // }
        // Total jumlah
        var total = cartArray[i].total
        var number_string = total.toString(),
            sisa = number_string.length % 3,
            total = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            total += separator + ribuan.join('.');
        }
        output += "<tr>" +
            "<td>" + cartArray[i].name + "</td>" +
            "<td><input type='text' name='product_code[]' id='product_code' style='display:none' value='" + cartArray[i].kode + "'></td>" +
            "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-kode=" + cartArray[i].kode + ">-</button>" +
            "<input type='number' name='qty[]' id='qty' class='item-count form-control' data-kode='" + cartArray[i].kode + "' value='" + cartArray[i].count + "'>" +
            "<button class='plus-item btn btn-primary input-group-addon' data-kode=" + cartArray[i].kode + ">+</button></div></td>" +
            "<td><button class='delete-item btn btn-danger' data-kode=" + cartArray[i].kode + ">X</button></td>" +
            "<td>Rp. " + total + "</td>" +
            "</tr>";

        // output2 += "<tr>" +
        //     "<td>" + no++ + "</td>" +
        //     "<td>" + cartArray[i].name + "</td>" +
        //     "<td></td>" +
        //     "<td>Rp. " + price + "</td>" +
        //     "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-kode=" + cartArray[i].kode + ">-</button>" +
        //     "<input type='number' class='item-count form-control' data-kode='" + cartArray[i].kode + "' value='" + cartArray[i].count + "'>" +
        //     "<button class='plus-item btn btn-primary input-group-addon' data-kode=" + cartArray[i].kode + ">+</button></div></td>" +
        //     "<td><button class='delete-item btn btn-danger' data-kode=" + cartArray[i].kode + ">X</button></td>" +
        //     "</tr>";
    }

    // konversi ke rupiah
    var total_pesanan = shoppingCart.totalCart();
    var number_string = Number(total_pesanan.toFixed(2)).toString(),
        sisa = number_string.length % 3,
        total_pesanan = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        separator = sisa ? '.' : '';
        total_pesanan += separator + ribuan.join('.');
    }

    $('.show-cart').html(output);
    // $('.show-list').html(output2);
    $('.total-cart').html(total_pesanan);
    $('.jml_total').val(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
}


// pilih saus
$('.nice-select').on('change', function () {
    const priceSaus = $(this).find(':selected').data('prices');
    // const namaSaus = $(this).find(':selected').data('namasaus');
    $('[id=hargaSaus]').text(priceSaus);
    // let hSaus = Number($('[id=hargaSaus]').text(priceSaus));
    // let hMenu = Number($('[id=hargaMenu]').val());
    var priceMenu = $(this).find(':selected').data('pricem');
    // var priceSaus = Number($(this).data('pricesaus'));
    let total = priceSaus + priceMenu;
    // $('[id=hargaTotal]').text(hSaus);
    $('.add-to-cart').attr("data-pricesaus", priceSaus);
    $('.add-to-cart').attr("data-price", total);
    // $('.add-to-cart').attr("data-saus", namaSaus);
    // console.log(total)
});

// Delete item button

$('.show-cart').on("click", ".delete-item", function (event) {
    var kode = $(this).data('kode')
    shoppingCart.removeItemFromCartAll(kode);
    displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function (event) {
    var kode = $(this).data('kode')
    shoppingCart.removeItemFromCart(kode);
    displayCart();
})
// +1
$('.show-cart').on("click", ".plus-item", function (event) {
    var kode = $(this).data('kode')
    shoppingCart.plusCart(kode);
    displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function (event) {
    var kode = $(this).data('kode');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(kode, count);
    displayCart();
});

displayCart();


// const allmenu = document.querySelectorAll('.allMenu');
// for (let i = 0; i < allmenu.length; i++) {
//     allmenu[i].addEventListener("click", function () {
//         var tes = $("#prod_name").val();
//         // console.log(tes);
//         // e.preventDefault();
//         // var tes = this.value;
//         // let password = this.childNodes[2];
//         // const iconSvg = this.childNodes[1];
//         // if (password.type === "password") {
//         //     password.type = "text";
//         // } else {
//         //     password.type = "password";
//         // }
//         // iconSvg.classList.toggle('icon-show');
//         // const price = $('select option:selected').data('prices');
//         // var tes = document.querySelector("#prod_name").value;
//         // const data = document.querySelector('#saus').dataset.prices.
//         console.log(tes);
//     });
// }

// $(this).click(function () {
//     // shoppingCart.clearCart();
//     // displayCart();

//     var tes = $("#prod_name").val();
//     console.log(tes);
// });