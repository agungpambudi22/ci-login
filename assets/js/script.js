$(function () {

    $('.addMenuButton').on('click', function () {
        $('#newMenuModalLabel').html('Add new menu');
        $('.modal-footer button[type=submit]').html('Add');
        $('#menu').val("");
    });

    $('.editMenuButton').on('click', function () {
        $('#newMenuModalLabel').html('Edit menu data');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', 'http://localhost/ci-login/menu/edit')

        const id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/ci-login/menu/get_edit',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#menu').val(data.menu);
                $('#id').val(data.id);
            }
        });
    });

    $('.addSubMenuButton').on('click', function () {
        $('#newSubMenuModalLabel').html('Add new submenu');
        $('.modal-footer button[type=submit]').html('Add');
        $('#title').val("");
        $('#menu_id').val("");
        $('#url').val("");
        $('#icon').val("");
        $('#is_active').val("1");
    });

    $('.editSubMenuButton').on('click', function () {
        $('#newSubMenuModalLabel').html('Edit submenu data');
        $('.modal-footer button[type=submit]').html('Edit');
        $('.modal-body form').attr('action', 'http://localhost/ci-login/menu/editSubMenu')

        const id = $(this).data('id');

    });

});