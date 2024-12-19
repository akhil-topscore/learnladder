jQuery(document).ready(function($) {
    // Add to Cart button click handler
    $('.add-to-cart-icon').on('click', function(e) {
        e.preventDefault();
        
        const productId = $(this).data('product-id');
        const iconElement = $(this);

        $.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            data: {
                action: 'add_to_cart',
                product_id: productId
            },
            success: function(response) {
                if (response.success) {
                    // Trigger a custom event to update all instances
                    $(document).trigger('productStatusUpdated', [productId]);

                    // Change the icon to show the product is in the cart
                    iconElement.removeClass('fa-cart-plus').addClass('fa-shopping-cart').addClass('added-to-cart');
                    iconElement.attr('title', 'Go to Cart');
                }
            }
        });
    });

    // Listen for the custom product status update event
    $(document).on('productStatusUpdated', function(event, productId) {
        $('.add-to-cart-icon[data-product-id="' + productId + '"]')
            .removeClass('fa-cart-plus')
            .addClass('fa-shopping-cart added-to-cart')
            .attr('title', 'Go to Cart');
    });
});
