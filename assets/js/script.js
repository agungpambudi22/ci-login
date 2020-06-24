$(function () {

    $('.addMenuButton').on('click', function () {
        $('#newMenuModalLabel').html('Add new menu');
        $('.modal-footer button[type=submit]').html('Add');
    });

    $('.editMenuButton').on('click', function () {
        $('#newMenuModalLabel').html('Edit data menu');
        $('.modal-footer button[type=submit]').html('Edit');
    });

});