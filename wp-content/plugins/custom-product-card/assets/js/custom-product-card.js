jQuery(document).ready(function($) {
    function adjustCardHeights() {
        var maxHeight = 0;

        $('.custom-product-card-item, .custom-extra-image').css('height', 'auto');

        // Calculate the maximum height
        $('.custom-product-card-item, .custom-extra-image').each(function() {
            var thisHeight = $(this).outerHeight();
            if (thisHeight > maxHeight) {
                maxHeight = thisHeight;
            }
        });

        // Set all to the maximum height
        $('.custom-product-card-item, .custom-extra-image').css('height', maxHeight + 'px');
    }

    // Call on load and resize
    adjustCardHeights();
    $(window).resize(function() {
        adjustCardHeights();
    });
    
    function updateTooltip(button) {
        const isMobile = $(window).width() < 768;

        // Conditionally set title only if not mobile and button has finished spinning
        if (!isMobile && button.hasClass('added-to-cart')) {
            button.attr('title', 'Go to Cart');
        } else if (!isMobile) {
            button.attr('title', 'Add to Cart');
        } else {
            button.removeAttr('title'); // Always remove on mobile
        }
    }

    // Initial tooltip setup on load and resize
    $(window).resize(() => {
        $('.add-to-cart-icon').each(function() {
            updateTooltip($(this));
        });
    }).trigger('resize');

    // Add to Cart AJAX functionality
    $('.custom-product-add-to-cart').on('click', '.add-to-cart-icon', function(e) {
        e.preventDefault();
        const button = $(this);
        const productId = button.data('product-id');

        // Remove tooltip before showing spinner to prevent tooltip display
        button.removeAttr('title');

        if (button.hasClass('added-to-cart')) {
            window.location.href = wc_add_to_cart_params.cart_url; // Redirect to cart
        } else {
            button.removeClass('fa-cart-plus').addClass('fa-spinner fa-spin');
            
            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'mcpc_add_to_cart',
                    product_id: productId,
                },
                success: function(response) {
                    if (response.success) {
                        button.removeClass('fa-spinner fa-spin');
                        setTimeout(() => {
                            button.addClass('fa-shopping-cart added-to-cart');
                            updateTooltip(button); // Only update tooltip after spinner stops
                        }, 100);
                    } else {
                        button.removeClass('fa-spinner fa-spin').addClass('fa-cart-plus');
                        alert('Failed to add to cart.');
                    }
                },
                error: function() {
                    button.removeClass('fa-spinner fa-spin').addClass('fa-cart-plus');
                    alert('Error adding to cart.');
                }
            });
        }
    });
});
