<?php

namespace views;

class Orders
{
    public function toString()
    {
        ob_start();
        ?>
        <div class="container">
            <h2>Place Your Order</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="menu">Select Menu:</label>
                    <select class="form-control" id="menu" name="menu">
                        <option value="1">Menu 1</option>
                        <option value="2">Menu 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                </div>
                <div class="form-group">
                    <label for="delivery_address">Delivery Address:</label>
                    <textarea class="form-control" id="delivery_address" name="delivery_address"></textarea>
                </div>
                <button type="submit" name="submit_order" class="btn btn-primary">Place Order</button>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}