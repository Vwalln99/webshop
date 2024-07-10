<?php include '../../includes/header.php'; ?>
<?php include '../../config/database.php'; ?>
<main>
    <h2>Checkout</h2>

    <form action="/webshop/public/views/layouts/checkout.main.php" method="post">
        <fieldset>
            <legend>Address</legend>
            <label for="address_line1">Address line 1:</label>
            <input type="text" id="address_line1" name="address_line1" required><br><br>

            <label for="address_line2">Address line 2:</label>
            <input type="text" id="address_line2" name="address_line2"><br><br>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required><br><br>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required><br><br>

            <label for="zip_code">Zip code:</label>
            <input type="text" id="zip_code" name="zip_code" required><br><br>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required><br><br>
        </fieldset>

        <fieldset>
            <legend>Paymentoptions</legend>
            <label for="payment_type">Type:</label>
            <select id="payment_type" name="payment_type" required>
                <option value="Credit Card">Credit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Apple Pay">Apple Pay</option>
                <option value="Google Pay">Google Pay</option>
            </select><br><br>

            <label for="account_number">Account number:</label>
            <input type="text" id="account_number" name="account_number" required><br><br>

            <label for="expiry_date">Expiry date:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YYYY" required><br><br>
        </fieldset>

        <button type="submit" name="order">Order</button>
    </form>
</main>

<?php include '../../includes/footer.php'; ?>