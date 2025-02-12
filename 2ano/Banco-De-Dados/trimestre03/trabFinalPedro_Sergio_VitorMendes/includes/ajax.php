<?php

session_start();

// Handle AJAX request to add product to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = 1;
    } else {
        $_SESSION['cart'][$productId]++;
    }

    echo json_encode($_SESSION['cart']);

    exit();
}
?>

<script>
// JavaScript to handle Add to Cart click
document.addEventListener('DOMContentLoaded', function() {
    const addToCartLinks = document.querySelectorAll('.add-to-cart');

    addToCartLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const productId = link.getAttribute('data-product-id');

            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'productId=' + encodeURIComponent(productId),
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
            });
        });
    });
});
</script>