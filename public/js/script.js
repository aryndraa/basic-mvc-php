$(function() {

    $('.popEdit').on('click', function() {
        $('#formModalLabel').html('Ubah data Produk')
        $('.modalForm button[type=submit]').html('Ubah data Produk')
        $('.formBox form').attr('action', 'http://localhost/learnPHP/MVC/public/foods/edit')
        const id = $(this).data('id');
        $.ajax({
            url: 'http://localhost/learnPHP/MVC/public/foods/getubah',
            data: {id : id},
            method: 'POST',
            dataType: 'json', 
            success: function(data) {
                $('#nama_produk').val(data.nama_produk);
                $('#harga_produk').val(data.harga_produk);
                $('#jumlah_produk').val(data.jumlah_produk);
                $('#id').val(data.id);
            }
        })
    })

})