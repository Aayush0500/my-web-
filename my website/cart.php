<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Initialize the cart if not already set
}

// Recalculate total after adding the product
CalculateTotalCart();

// Check if the user has added a product to the cart
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Check if the product is already in the cart
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        // Product is already in the cart, do nothing or handle as needed
        echo '<script>alert("Product already added to cart")</script>';
    } else {
        $product_quantity = $_POST['product_quantity'];
        $product_price = $_POST['product_price'];
        $product_name = $_POST['product_name'];
        $product_image = $_POST['product_image'];

        $product_array = array(
            'product_id' => $product_id,
            'product_quantity' => $product_quantity,
            'product_price' => $product_price,
            'product_name' => $product_name,
            'product_image' => $product_image,
        );

        // Add the product to the cart
        $_SESSION['cart'][$product_id] = $product_array;

        // Update the cart total after adding the product
        updateCartTotal();
    }
}

if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];

    // Check if the product is in the cart before removing
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$product_id]);
        echo '<script>alert("Product removed from cart")</script>';

        // Update the cart total after removing the product
        updateCartTotal();
    }
}

CalculateTotalCart();

function CalculateTotalCart()
{
    $total = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $price = isset($value['product_price']) ? floatval($value['product_price']) : 0;
        $quantity = isset($value['product_quantity']) ? intval($value['product_quantity']) : 0;

        // Check if $price and $quantity are valid numbers
        if (is_numeric($price) && is_numeric($quantity)) {
            $subtotal = $price * $quantity;
            $total += $subtotal;
        } else {
            // Handle the case where $price or $quantity is not a valid number
            echo '<script>alert("Invalid product data. Please check the cart.")</script>';
            unset($_SESSION['cart'][$key]); // Remove the problematic item from the cart
        }
    }

    // Add shipping charges based on the cart subtotal
    if ($total < 1000) {
        $total += 50; // Adjust this value based on your shipping charges
    }

    $_SESSION['total'] = $total;
}

function updateCartTotal()
{
    CalculateTotalCart(); // Recalculate the total after any change in the cart

    // Check if $_SESSION['total'] is not set and set it to 0 if necessary
    $_SESSION['total'] = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
}

function getCartSubtotal()
{
    // Calculate and return the cart subtotal
    $subtotal = 0;

    foreach ($_SESSION['cart'] as $value) {
        $subtotal += (isset($value['product_price']) ? $value['product_price'] : 0) * (isset($value['product_quantity']) ? $value['product_quantity'] : 0);
    }

    return $subtotal;
}

function getCartTotal()
{
    // Return the cart total from the session
    return isset($_SESSION['total']) ? $_SESSION['total'] : 0;
}
?>

<?php include('layouts/header.php');?>




    <section class="page-header p-1">
        <h2>#cart</h2>
        <p>leave a message. we love to hear from you!</p>
    </section>
    <section id="cart" class="p-1">
        <table>
            <thead>
                <tr>
                    <td>Removes</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                    <tr class="product-row">
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <?php if (isset($_POST['remove_product']) && $_POST['product_id'] == $value['product_id']) : ?>
                                <?php unset($_SESSION['cart'][$value['product_id']]); ?>
                                <td><button type="submit" name="remove_product" class="remove_btn"><i class="far fa-times-circle"></i></button></td>
                                <td><img src="<?php echo $value['product_image']; ?>" alt=""></td>
                                <td><?php echo $value['product_name']; ?></td>
                                <td class="product-price"><?php echo $value['product_price']; ?></td>
                                <td><input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" class="quantity-input" oninput="updateCart()"></td>
                                <td class="subtotal"><?php echo $value['product_quantity'] * $value['product_price']           ?></td>
                            <?php else : ?>
                                <td><button type="submit" name="remove_product" class="remove_btn"><i class="far fa-times-circle"></i></button></td>
                                <td><img src="<?php echo $value['product_image']; ?>" alt=""></td>
                                <td><?php echo $value['product_name']; ?></td>
                                <td class="product-price"><?php echo $value['product_price']; ?></td>
                                <td><input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>" class="quantity-input" oninput="updateCart()"></td>
                                <td class="subtotal"><?php echo $value['product_quantity'] * $value['product_price']           ?></td>
                            <?php endif; ?>
                        </form>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </section>

    <div class="line"></div>
    <section id="cart-add" class="p-1">
        <div id="coupon">
            <h3>apply coupon</h3>
            <div>
                <input type="text" placeholder="enter your coupon">
                <button class="normal">apply</button>
            </div>
        </div>
        <div id="subtotal">
            <h3>cart total</h3>
            <table>
                <!-- Inside the #subtotal section -->
                <tr>
                    <td>cart subtotal</td>
                    <td id="cart-subtotal"><?php echo getCartSubtotal(); ?></td>
                </tr>
                <tr>
                    <td>shipping</td>
                    <td id="shipping-fee">$50</td>
                </tr>
                <tr>
                    <td><strong>total</strong></td>
                    <td id="cart-total"><strong>$<?php echo getCartTotal(); ?></strong></td>
                </tr>

            </table>
            <form action="checkout.php" method="post">
            <button type="submit" name="checkout" value="checkout" class="normal">proceed to checkout</button>
            </form>
        </div>
    </section>

    <script>
        // cart page javascripting
function updateCart() {
    // Your updateCart() logic here, if needed
}

function updateCart() {
var productRows = document.querySelectorAll('.product-row');
var cartSubtotal = 0;
var cartTotal = 0;

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

var cartSubtotalElement = document.getElementById('cart-subtotal');
cartSubtotalElement.innerText = '$' + cartSubtotal.toFixed(2);

var shippingFee = cartSubtotal < 1000 ? 50 : 0;
var shippingFeeElement = document.getElementById('shipping-fee');
shippingFeeElement.innerText = shippingFee === 0 ? 'free' : '$' + shippingFee.toFixed(2);

cartTotal = cartSubtotal + shippingFee;

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

    </script>

<?php include('layouts/footer.php');?>