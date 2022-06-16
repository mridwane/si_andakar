$(document).ready(function () {
    $('.setuju').click(function () {
        var no_permintaan = $('#no_permintaan').val();
        var status = $(this).data('status');
        $.ajax({
            type: 'post',
            data: {
                no_permintaan: no_permintaan,
                status: status
            },
            Type: 'POST',
            url: 'proses_persetujuan_barang.php',
            success: function (data) {
                window.location = "detail_list_permintaan.php";
                alert("Permintaan Disetujui");
            }
        });
    });
    $('.batal').click(function () {
        var no_permintaan = $('#no_permintaan').val();
        var status = $(this).data('status');
        $.ajax({
            type: 'post',
            data: {
                no_permintaan: no_permintaan,
                status: status
            },
            Type: 'POST',
            url: 'proses_persetujuan_barang.php',
            success: function (data) {
                window.location = "list_permintaan_barang.php";
                alert("Permintaan Dibatalkan");
            }
        });
    });
});