document.addEventListener('DOMContentLoaded', function() {
    // Retrieve cart count from localStorage and display it
    document.getElementById('cart-count').innerText = localStorage.getItem('cartCount') || 0;

    updateCartCount();

    function updateCartCount() {
        fetch(cartCountUrl)
            .then(response => response.json())
            .then(data => {
                // Update cart count in localStorage and display it
                localStorage.setItem('cartCount', data.count);
                document.getElementById('cart-count').innerText = data.count;
            })
            .catch(error => console.error('Error fetching cart count:', error));
    }
});
