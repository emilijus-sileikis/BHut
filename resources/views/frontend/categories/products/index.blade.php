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
            // Clear button
            const clearFilterButton = document.querySelector('#clear-filter');

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

            function resetForm() {
                // Reset the price
                document.querySelector('#price_sort').value = '';
                document.querySelector('#qty_sort').value = '';

                // Reset the URL
                const url = window.location.href;
                const urlObj = new URL(url);

                urlObj.search = '';
                urlObj.hash = '';

                window.location.href = urlObj.toString();

            }

            clearFilterButton.addEventListener('click', () => {
                clearFilterButton.blur();
                resetForm();
            });
        });
    </script>

@stop
