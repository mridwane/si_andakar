$(document).ready(function () {``
    loadDelivery();

    function loadDelivery() {
        let tgl = "2022-12-22";
        // // console.log(jenis)
        $.ajax({
            url: 'controller/status_delivery.php',
            method: 'POST',
            data: {
                tgl: tgl,
            },
            success: function (data) {
                // $(".show-cart").html(data);
                console.log("berhasil");
            }
        });
        // let tgl = new Date()
        // let format_tgl = tgl.getFullYear() + "-" + tgl.getMonth() + "-" + tgl.getDate()
        // alert(format_tgl)
    }

});