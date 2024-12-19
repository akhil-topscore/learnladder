jQuery(document).ready(function ($) {
    const filterButton = $('#mcpc-filter-button');
    const filterSection = $('#mcpc-filter-section');
    const productLoop = $('#mcpc-product-loop');
    const loader = $('.loader');
    const parentCategorySelect = $('#parent-category');
    const childCategorySelect = $('#child-category');
    const searchBar = $('#search-bar');
    const searchButton = $('#search-button');
    const noProductsMessage = $('#no-products-message');

    function setLoadingState(isLoading) {
        if (isLoading) {
            loader.show();
            parentCategorySelect.prop('disabled', true);
            searchBar.prop('disabled', true);
            searchButton.prop('disabled', true);
        } else {
            loader.hide();
            parentCategorySelect.prop('disabled', false);
            searchBar.prop('disabled', false);
            searchButton.prop('disabled', false);
        }
    }

    // Fetch products on initial load based on default parent category
    fetchInitialProducts();

    function fetchInitialProducts() {
        const defaultParentId = parentCategorySelect.val();
        setLoadingState(true);
        fetchProducts(defaultParentId, '', '');
    }

    filterButton.on('click', function () {
        filterSection.slideToggle();
        filterSection.toggleClass('open');
    });

    // Handle Parent Category Change
    parentCategorySelect.on('change', function () {
        const selectedParent = $(this).val();
        resetFilters(); // Reset child category and search bar
        setLoadingState(true);

        if (selectedParent) {
            fetchSubcategories(selectedParent); // Fetch subcategories for the new parent
            fetchProducts(selectedParent, '', '');
        } else {
            productLoop.empty(); // Clear product loop if no parent selected
            setLoadingState(false);
        }
    });

    // Handle Child Category Change
    childCategorySelect.on('change', function () {
        const selectedChild = $(this).val();
        setLoadingState(true);
        fetchProducts(parentCategorySelect.val(), selectedChild, searchBar.val());
    });

    // Handle Search
    searchButton.on('click', function () {
        setLoadingState(true);
        fetchProducts(parentCategorySelect.val(), childCategorySelect.val(), searchBar.val());
    });

    // Fetch Products
    function fetchProducts(parentId, childId, searchTerm) {
        $.ajax({
            url: mcpc_ajax_obj.ajax_url,
            method: 'GET',
            data: {
                action: 'mcpc_filter_products',
                parent_id: parentId,
                child_id: childId,
                search_term: searchTerm
            },
            success: function (data) {
                productLoop.html(data);
                setLoadingState(false);

                // Show or hide "No products found" message
                if ($.trim(data) !== '') {
                    noProductsMessage.hide();
                } else {
                    noProductsMessage.show();
                }
            },
            error: function () {
                setLoadingState(false);
                noProductsMessage.show();
            }
        });
    }

    // Fetch Subcategories
    function fetchSubcategories(parentId) {
        $.ajax({
            url: mcpc_ajax_obj.ajax_url,
            method: 'GET',
            data: {
                action: 'mcpc_get_child_categories',
                parent_id: parentId
            },
            success: function (response) {
                if (response.success && response.data.trim() !== '') {
                    childCategorySelect.html(response.data);
                    childCategorySelect.prop('disabled', false); // Ensure dropdown is enabled if subcategories exist
                } else {
                    childCategorySelect.html('<option value="">No subcategories available</option>');
                    childCategorySelect.prop('disabled', true); // Disable dropdown if no subcategories
                }
            },
            error: function () {
                childCategorySelect.html('<option value="">No subcategories available</option>');
                childCategorySelect.prop('disabled', true);
            }
        });
    }

    // Reset filters but keep the child category enabled if there are options
    function resetFilters() {
        childCategorySelect.html('<option value="">Select Subcategory</option>').prop('disabled', false);
        searchBar.val('');
        noProductsMessage.hide();
    }
});
