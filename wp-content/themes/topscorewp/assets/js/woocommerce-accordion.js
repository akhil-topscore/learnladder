document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.woocommerce-order-downloads__header');

    headers.forEach(header => {
        header.addEventListener('click', () => {
            const details = header.nextElementSibling;

            // Toggle visibility
            if (details.style.display === 'block') {
                details.style.display = 'none';
            } else {
                details.style.display = 'block';
            }
        });
    });
});
