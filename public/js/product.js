$(document).ready(function () {

    $('#productForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/save-product',
            data: $('#productForm').serialize(),
            success: function (data) {

                $('#successMessage').fadeIn().delay(3000).fadeOut(); 
                
                $('#productTable').html(data.table);

                $('#totalValue').html('Total: ' + data.totalValue);

               

            },
            error: function (data) {
                $('#errorMessage').fadeIn().delay(3000).fadeOut(); 
                console.log('Error:', data);
            }
        });
    });

    // Edit product modal
    $('.edit-btn').click(function () {
        var productData = $(this).data('product');
        $('#editProductId').val($(this).data('id'));
        $('#editProductName').val(productData.productName);
        $('#editQuantity').val(productData.quantity);
        $('#editPrice').val(productData.price);
        $('#editProductModal').modal('show');
    });

    // Submit edited product form
    $('#editProductForm').submit(function (e) {
        e.preventDefault();
        var productId = $('#editProductId').val();
        var productName = $('#editProductName').val();
        var quantity = $('#editQuantity').val();
        var price = $('#editPrice').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var formData = {
            '_token': csrfToken,
            'productName': productName,
            'quantity': quantity,
            'price': price
        };

        console.log(formData);

        $.ajax({
            type: 'PUT',
            url: '/update-product/' + productId,
            data: formData,
            success: function (data) {
                $('#successMessage').fadeIn().delay(3000).fadeOut(); 
                location.reload();
                

            },
            error: function (data) {
                console.log('Error:', data);
                $('#errorMessage').fadeIn().delay(3000).fadeOut(); 

            }
        });
    });
});