@extends('layouts.app')

@section('content')

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.products._filter')
                </div>
                <div class="col-md-9">
                    @include('frontend.products._products')
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let form = $('#filter-form');
            let url = form.attr('action');

            // Ajax submit
            function fetchResults() {
                $.ajax({
                    url: url,
                    data: form.serialize(),
                    type: "GET",
                    success: function(response) {
                        $('#products-wrapper').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            form.on('submit', function(e) {
                e.preventDefault();
                fetchResults();
                $('#filter-form button[type=submit]').blur();
            });

            // Checkboxes
            const allCategoriesCheckbox = document.querySelector('#all-categories');
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');

            allCategoriesCheckbox.addEventListener('change', () => {
                if (allCategoriesCheckbox.checked) {
                    categoryCheckboxes.forEach((checkbox) => {
                        checkbox.checked = false;
                    });
                }
            });

            categoryCheckboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', () => {
                    if (checkbox.checked) {
                        allCategoriesCheckbox.checked = false;
                    }
                });
            });

            // Sort buttons
            const priceButton = document.querySelector('#price_sort');
            const qtyButton = document.querySelector('#qty_sort');

            priceButton.addEventListener('change' , () => {
                if (qtyButton.value !== "") {
                    qtyButton.value = "";
                }
            });

            qtyButton.addEventListener('change' , () => {
                if (priceButton.value !== "") {
                    priceButton.value = "";
                }
            });

            // Clear button
            const clearFilterButton = document.querySelector('#clear-filter');

            function resetForm() {
                // Reset the price
                document.querySelector('#price_sort').value = '';
                document.querySelector('#qty_sort').value = '';

                // Reset All Cats
                allCategoriesCheckbox.checked = true;

                // Uncheck other checkboxes
                categoryCheckboxes.forEach((checkbox) => {
                    checkbox.checked = false;
                });
            }

            clearFilterButton.addEventListener('click', (e) => {
                e.preventDefault();
                clearFilterButton.blur();

                resetForm();

                fetchResults();
            });
        });
    </script>

@endsection
