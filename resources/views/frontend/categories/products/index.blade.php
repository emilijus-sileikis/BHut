@extends('layouts.app')

@section('content')

    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Category: '{{ $category->name }}' Products</h4>
                </div>

                <div class="col-md-3">
                    @include('livewire.frontend.product._filter')
                </div>
                <div class="col-md-9">
                    @include('livewire.frontend.product.index')
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

            // Clear button
            const clearFilterButton = document.querySelector('#clear-filter');

            function resetForm() {
                // Reset the price
                document.querySelector('#price_sort').value = '';
                document.querySelector('#qty_sort').value = '';
            }

            clearFilterButton.addEventListener('click', (e) => {
                e.preventDefault();
                clearFilterButton.blur();

                resetForm();

                fetchResults();
            });
        });
    </script>

@stop
