document.addEventListener('DOMContentLoaded', function() {
    // Retrieve wishlist count from localStorage and display it
    document.getElementById('wishlist-count').innerText = localStorage.getItem('wishlistCount') || 0;

    updateWishlistCount();

    function updateWishlistCount() {
        fetch(wishlistCountUrl)
            .then(response => response.json())
            .then(data => {
                // Update wishlist count in localStorage and display it
                localStorage.setItem('wishlistCount', data.count);
                document.getElementById('wishlist-count').innerText = data.count;
            })
            .catch(error => console.error('Error fetching wishlist count:', error));
    }
});
