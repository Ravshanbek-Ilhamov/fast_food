<div>
    <style>
        /* General Body Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #121212; /* Dark background */
        color: #e0e0e0; /* Light text */
    }

    /* Cart Container */
    .cart-container {
        display: flex;
        margin: 20px;
    }

    /* Left Cart Section */
    .cart-left {
        flex: 2;
        margin-right: 20px;
    }

    /* Right Cart Section */
    .cart-right {
        flex: 1;
        background-color: #1e1e1e; /* Dark card background */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        color: #b0b0b0;
    }

    .product {
        display: flex;
        align-items: center;
        background-color: #1e1e1e; /* Dark product background */
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    /* Product Details */
    .product-details {
        display: flex;
        align-items: center;
        flex: 2;
        margin-left: 10px;
    }

    .product-details img {
        width: 80px;
        height: auto;
        margin-right: 15px;
        border-radius: 5px; /* Slight rounding for images */
        border: 1px solid #333;
    }

    .product-price {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        text-align: right;
        flex: 1;
        color: #b0b0b0;
    }

    /* Quantity Controls */
    .quantity-controls {
        display: flex;
        align-items: center;
    }

    .quantity-controls button {
        background-color: #333;
        border: none;
        padding: 5px 10px;
        color: #e0e0e0;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .quantity-controls button:hover {
        background-color: #444;
    }

    .quantity-controls span {
        margin: 0 5px;
        font-weight: bold;
        color: #e0e0e0;
    }

    /* Price and Remove Button */
    .old-price {
        text-decoration: line-through;
        color: #888;
        font-size: 0.9em;
    }

    .remove-btn {
        background-color: transparent;
        color: #888;
        border: none;
        cursor: pointer;
        font-size: 0.9em;
        margin-top: 10px;
        transition: color 0.2s;
    }

    .remove-btn:hover {
        color: #ff5252;
    }

    /* Summary Section */
    .summary {
        margin-bottom: 20px;
    }

    .summary p {
        display: flex;
        justify-content: space-between;
        color: #e0e0e0;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        background-color: #6200ea;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .checkout-btn:hover {
        background-color: #4500b5;
    }

    .delivery-note {
        font-size: 0.9em;
        color: #b0b0b0;
        margin-top: 10px;
}

    </style>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="cart-container">
            <div class="cart-left">
                <div class="header">
                    <h2>Checkout Page</h2>
                    <a class="book-a-table-btn" href="/user-page" wire:navigate >Back To Order</a>
                </div>
                @if (!session('foods'))
                    <p>No items in the cart.</p>
                @else
                    @foreach (session('foods') as $food)
                        <div class="product">
                            <div class="product-details">
                                <img src="{{ asset('storage/' . $food['image']) }}" alt="image">
                                <div>
                                    <p class="mt-3"><strong>{{$food['name']}}</strong></p>
                                </div>
                            </div>
    
                            <div class="quantity-controls">

                                <button wire:click="decrementQuantity({{ $food['id'] }})">-</button>
                                    <span>{{ $food['quantity'] }}</span>
                                <button wire:click="incrementQuantity({{ $food['id'] }})">+</button>
            
                                <p class="product-price me-3 mx-3 mt-3 text-end fw-bold fs-5 "><strong>{{ $food['price'] }}$</strong></p>
                                <p  class="old-price me-3 mt-3 text-end">{{ $food['price'] + 20 }}$</p>
                            </div>
                            <div class="product-price">
                                <button class="remove-btn" wire:click="removeFromCart({{ $food['id'] }})">Remove</button>
                            </div>
                        </div>
                    @endforeach
                @endif
    
            </div>
    
            <div class="cart-right mt-5">
                <div class="summary">
                    <h3>Your Order</h3>
                    @foreach (session('foods') as $food)
                        <p>{{$food['name']}} <strong>Quantity: {{$food['quantity']?$food['quantity']:0}}</strong><strong>${{number_format($food['total_price'], 2)}}</strong></p>
                    @endforeach
                    <p>Total Price: <strong>${{number_format($superTotal, 2)}}</strong></p>
                    <p>Discount: <span style="color: green;">${{ number_format($superTotal * 0.2)}}</span></p>
                    <p>You Pay: <strong>${{ number_format($superTotal - ($superTotal * 0.2),2)}}</strong></p>
                    <button wire:click="saveOrder" class="checkout-btn">Proceed to Checkout</button>
                </div>
                <div class="delivery-note">
                    <p>We offer free delivery to the pick-up point for orders above $25.</p>
                    <p>Delivery by courier is free if your total exceeds <strong>$1</strong>.</p>
                </div>
            </div>
        </div>
    </body>
    </html>
    
    
</div>
