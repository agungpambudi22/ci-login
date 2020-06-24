$(function () {

    $('.addMenuButton').on('click', function () {
        $('#newMenuModalLabel').html('Add new menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('#menu').val("");
    });

    $('.editMenuButton').on('click', function () {
        $('#newMenuModalLabel').html('Edit data menu');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', 'http://localhost/ci-login/menu/edit')

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/ci-login/menu/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#menu').val(data.menu);
                $('#id').val(data.id);
            }
        });
    });

});