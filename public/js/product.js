$(document).ready(function () {

    $('.edit-btn').click(function () {
    var productData = $(this).data('product');
        $('#editProductId').val($(this).data('id'));
        $('#editProductName').val(productData.productName);
        $('#editQuantity').val(productData.quantity);
        $('#editPrice').val(productData.price);
        $('#editProductModal').modal('show');
    });


    $('#editProductForm').submit(function (e) {
        e.preventDefault();
        var productId = $('#editProductId').val();
        var productName = $('#editProductName').val();
        var quantity = $('#editQuantity').val();
        var price = $('#editPrice').val();
        var formData = {
            'productName': productName,
            'quantity': quantity,
            'price': price
        };

        $.ajax({
            type: 'PUT',
            url: '/update-product/' + productId,
            data: formData,
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});