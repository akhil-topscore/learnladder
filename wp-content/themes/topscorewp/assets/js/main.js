(function ($) {
    "use strict";

    $(document).ready(function () {
        
        // -----------SHOP PAGE CATEGORY SLECTION ARROW START
        //         // Add an arrow element next to the categories heading if it doesn't exist
        // if (!$('.wp-block-woocommerce-product-categories .toggle-arrow').length) {
        //     $('.wp-block-woocommerce-product-categories').prepend('<span class="toggle-arrow">➔</span>');
        // }

        // // Toggle visibility of category list and rotate arrow when clicked
        // $('.wp-block-woocommerce-product-categories .toggle-arrow').on('click', function () {
        //     var categoryList = $(this).siblings('.wc-block-product-categories-list');
        //     categoryList.toggleClass('show');
        // });

// ------SHOP PAGE CATEGORY SLECTION ARROW END

 // -----------SHOP PAGE CATEGORY SLECTION 2 START
 document.addEventListener('DOMContentLoaded', () => {
    const categoryItems = document.querySelectorAll('.wp-block-woocommerce-product-categories li');

    categoryItems.forEach(item => {
        const toggleArrow = document.createElement('span');
        toggleArrow.classList.add('toggle-arrow');
        toggleArrow.textContent = '➔';

        if (item.querySelector('ul')) {
            item.classList.add('has-children');
            item.insertBefore(toggleArrow, item.firstChild);

            toggleArrow.addEventListener('click', (e) => {
                e.preventDefault();
                item.classList.toggle('open');
                const childList = item.querySelector('ul');
                if (childList) {
                    const isVisible = childList.style.display === 'block';
                    childList.style.display = isVisible ? 'none' : 'block';
                    toggleArrow.textContent = isVisible ? '➔' : '⬇';
                }
            });
        }
    });
});

  // -----------SHOP PAGE CATEGORY SLECTION 2 END
        // Clear billing email field
        $("#billing_email").val(""); 

        // Sticky elements on scroll
        $(window).on("scroll", function () {
            var scrollValue = $(window).scrollTop();
            $(".sticky-top").toggleClass("sticky", scrollValue > 320);
            $(".sticky-wrapper").toggleClass("sticky", scrollValue > 500);
        });

        /*---------- 05. Scroll To Top ----------*/
        if ($(".scroll-top").length) {
            var scrollTopbtn = $(".scroll-top");
            var progressPath = $(".scroll-top path");
            var pathLength = progressPath.get(0).getTotalLength();

            progressPath.css({ 
                transition: "none", 
                strokeDasharray: pathLength + " " + pathLength, 
                strokeDashoffset: pathLength 
            });

            // Update progress path
            function updateProgress() {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength) / height;
                progressPath.css("strokeDashoffset", progress);
            }

            updateProgress();
            $(window).scroll(updateProgress);

            // Show scroll-to-top button when scrolled past a certain point
            var offset = 50;
            $(window).on("scroll", function () {
                scrollTopbtn.toggleClass("show", $(this).scrollTop() > offset);
            });

            // Scroll to top on button click
            scrollTopbtn.on("click", function (event) {
                event.preventDefault();
                $("html, body").animate({ scrollTop: 0 }, 750);
            });
        }

        // Handle AJAX add to cart event
        $(document.body).on('added_to_cart', function (event, fragments, cart_hash, button) {
            $(button)
                .removeClass('added')
                .addClass('go-to-cart')
                .text('Go to Cart')
                .attr('href', 'https://topscoresoftwares.com/demo/learnladder/cart/'); // Update with full URL
        });

        // Handle click on "Go to Cart" button
        $(document.body).on('click', '.go-to-cart', function (e) {
            e.preventDefault();
            window.location.href = 'https://topscoresoftwares.com/demo/learnladder/cart/'; // Redirect to cart URL
        });

        // Handle category item click to filter products
        $(".wc-block-product-categories-list-item").on('click', function () {
            var categoryLink = $(this).find('a').attr('href') || '#';

            // If you're doing a page redirect to filter categories
            window.location.href = categoryLink;

            // If you are applying a dynamic filter, you can use AJAX here
            // Example: filterProducts(categoryLink); // Customize this part for your filtering setup
        });

    });

})(jQuery);
document.getElementById('downloadButton').addEventListener('click', function(event) {
    console.log("sample file")
    event.preventDefault(); // Prevent default link behavior (no new tab or same tab open)

    var button = event.currentTarget;

    // Add loading class to button (to show spinner and disable further clicks)
    button.classList.add('loading');

    // Create a temporary link element to trigger the download
    const tempLink = document.createElement('a');
    tempLink.href = button.href;
    tempLink.setAttribute('download', ''); // Ensure it only downloads the file
    document.body.appendChild(tempLink);
    tempLink.click(); // Simulate a click on the temp link
    document.body.removeChild(tempLink); // Remove the temporary link after download
    button.classList.remove('loading');
});
document.addEventListener("DOMContentLoaded", function () {
    const accordionHeaders = document.querySelectorAll(".woocommerce-order-downloads__header");
    
    accordionHeaders.forEach(header => {
        header.addEventListener("click", function () {
            const details = this.nextElementSibling;

            // Toggle Accordion
            if (details.style.display === "block") {
                details.style.display = "none";
            } else {
                details.style.display = "block";
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        // Initialize Swiper for the category slider
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 4,  // Number of slides visible at once
            spaceBetween: 10,  // Space between slides
            loop: true,        // Loop the slides
            autoplay: {
                delay: 3000,  // Autoplay delay (3 seconds)
                disableOnInteraction: false,  // Keep autoplay on interaction
            },
            speed: 1000,  // Scroll speed
            navigation: {
                nextEl: '.swiper-button-next',  // Next button selector
                prevEl: '.swiper-button-prev',  // Previous button selector
            },
            pagination: {
                el: '.swiper-pagination',  // Pagination selector
                clickable: true,  // Enable clickable pagination
            },
        });
    } else {
        console.log('Swiper not defined. Ensure the Swiper script is loaded.');
    }
});
