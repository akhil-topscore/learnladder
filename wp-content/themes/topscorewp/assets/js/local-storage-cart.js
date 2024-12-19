jQuery(document).ready(function ($) {
    const CART_STORAGE_KEY = 'guest_cart';
    const CART_EXPIRY_DAYS = 7;

    // Save cart to localStorage
    function saveCartToLocalStorage(cart) {
       
        const expiryDate = new Date();
        expiryDate.setDate(expiryDate.getDate() + CART_EXPIRY_DAYS);
        const cartData = { items: cart, expiry: expiryDate };
        localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cartData));
    }

    // Load cart from localStorage
    function loadCartFromLocalStorage() {
        const cartData = JSON.parse(localStorage.getItem(CART_STORAGE_KEY));
        if (cartData && new Date(cartData.expiry) > new Date()) {
            return cartData.items;
        }
        localStorage.removeItem(CART_STORAGE_KEY); // Clear expired cart
        return [];
    }

    // Add to cart button logic
    $('.add_to_cart_button').on('click', function (e) {
        e.preventDefault();
        const productID = $(this).data('product_id');
        let currentCart = loadCartFromLocalStorage();
        const existingItem = currentCart.find(item => item.id === productID);

        if (existingItem) {
            existingItem.quantity += 1; // Increment quantity
        } else {
            currentCart.push({ id: productID, quantity: 1 });
        }

        saveCartToLocalStorage(currentCart);
        alert('Product added to your temporary cart!');
    });

    // Sync cart after login
    $(document).on('user_logged_in', function () {
        const storedCart = loadCartFromLocalStorage();
        if (storedCart.length) {
            $.post(
                ajaxurl,
                { action: 'sync_cart', cart_items: JSON.stringify(storedCart) },
                function (response) {
                    if (response.success) {
                        localStorage.removeItem(CART_STORAGE_KEY); // Clear localStorage
                        console.log('Cart synced to WooCommerce.');
                    } else {
                        console.error('Failed to sync cart:', response);
                    }
                }
            );
        }
    });

    // Debugging: Load the stored cart on page load (optional)
    const storedCart = loadCartFromLocalStorage();
    if (storedCart.length) {
        console.log('Loaded guest cart:', storedCart);
    }
});
