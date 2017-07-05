/**
 * Created by MJMC on 05/07/2017.
 */
<!-- ajax -->
$(function () {
    $('#vehicleBrand').on('change', function () {
        var id = $('#vehicleBrand').val();

        $.ajax({
            type: 'POST',
            url: 'model/user/ajax/brand.php',
            data: 'id=' + id,
            success: function (data) {
                $('#vehicleModel option').remove();
                $('#vehicleModel').append(data);
            }

        });

        $.ajax({
            type: 'POST',
            url: 'model/user/ajax/product-brand.php',
            data: 'id=' + id,
            success: function (data) {
                $('#product div').remove();
                $('#product').append(data);
            }

        });

        return false;
    });


    $('#vehicleModel').on('change', function () {
        var id = $('#vehicleModel').val();

        $.ajax({
            type: 'POST',
            url: 'model/user/ajax/vehicle.php',
            data: 'id=' + id,
            success: function (data) {
                $('#productCategory option').remove();
                $('#productCategory').append(data);
            }

        });

        $.ajax({
            type: 'POST',
            url: 'model/user/ajax/product-vehicle.php',
            data: 'id=' + id,
            success: function (data) {
                $('#product div').remove();
                $('#product').append(data);
            }

        });
        return false;
    });

    $('#productCategory').on('change', function () {
        var category = $('#productCategory').val();
        var vehicle = $('#vehicleModel').val();
        var array = [category , vehicle];
        $.ajax({
            type: 'POST',
            url: 'model/user/ajax/product-category.php',
            data: 'array=' + array,
            success: function (data) {
                $('#product div').remove();
                $('#product').append(data);
            }

        });
        return false;
    });
});