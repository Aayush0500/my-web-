//index page java script
function redirectToProductPage(productId) {
  window.location.href = 'product.php?id=' + productId;
}

//navbar menu media query
function toggleNavbar() {
  const navbar = document.querySelector('#navbar');
  navbar.classList.toggle('active');
}

function closeNavbar() {
  const navbar = document.querySelector('#navbar');
  navbar.classList.remove('active');
}













//shop page javascripting
function redirectToProduct(productId) {
     window.location.href = 'product.php?id=' + productId;
 }

















 // product page javascript
 document.addEventListener("DOMContentLoaded", function() {
  var MainImg = document.getElementById("MainImg");
  var smallimg = document.getElementsByClassName("small-img");

  smallimg[0].onclick = function() {
    MainImg.src = smallimg[0].src;
  }

  smallimg[1].onclick = function() {
    MainImg.src = smallimg[1].src;
  }

  smallimg[2].onclick = function() {
    MainImg.src = smallimg[2].src;
  }

  smallimg[3].onclick = function() {
    MainImg.src = smallimg[3].src;
  }

});














// cart page javascripting
function updateCart() {
  var productRows = document.querySelectorAll('.product-row');
  var cartSubtotal = 0;
  var cartTotal = 0;

  // Check if the cart is empty
  if (productRows.length === 0) {
      var shippingFeeElement = document.getElementById('shipping-fee');
      shippingFeeElement.innerText = 'free'; // No shipping fee for an empty cart
  } else {
      productRows.forEach(function(row) {
          var priceCell = row.querySelector('.product-price');
          var quantityInput = row.querySelector('.quantity-input');
          var subtotalCell = row.querySelector('.subtotal');

          var price = parseFloat(priceCell.innerText.replace('$', ''));
          var quantity = parseInt(quantityInput.value);

          var subtotal = price * quantity;
          subtotalCell.innerText = '$' + subtotal.toFixed(2);

          cartSubtotal += subtotal;
      });

      var shippingFee = cartSubtotal < 1000 ? 50 : 0;
      var shippingFeeElement = document.getElementById('shipping-fee');
      shippingFeeElement.innerText = shippingFee === 0 ? 'free' : '$' + shippingFee.toFixed(2);

      cartTotal = cartSubtotal + shippingFee;
  }

  var cartSubtotalElement = document.getElementById('cart-subtotal');
  cartSubtotalElement.innerText = '$' + cartSubtotal.toFixed(2);

  var cartTotalElement = document.getElementById('cart-total');
  cartTotalElement.innerHTML = '<strong>$' + cartTotal.toFixed(2) + '</strong>';
}

document.querySelectorAll('.quantity-input').forEach(function(input) {
  input.addEventListener('input', updateCart);
});

window.addEventListener('load', updateCart); // Call updateCart() on page load

function addToCart(product_id, product_quantity, product_price, product_name, product_image) {
// Use fetch API to send an asynchronous POST request to the server
fetch('cart.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
        product_id: product_id,
        product_quantity: product_quantity,
        product_price: product_price,
        product_name: product_name,
        product_image: product_image,
    }),
})
.then(response => response.json())
.then(data => {
    // Handle the response data, if needed
    updateCart(); // Update the cart display based on the updated information
})
.catch(error => console.error('Error:', error));
}

function removeFromCart(product_id) {
fetch('cart.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
        remove_product: true,
        product_id: product_id,
    }),
})
.then(response => response.json())
.then(data => {
    // Handle the response data, if needed
    updateCart(); // Update the cart display based on the updated information
})
.catch(error => console.error('Error:', error));
}
