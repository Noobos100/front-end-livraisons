<?php

namespace views;

/**
 * Class CreateOrderView
 * @package views
 * Cette classe permet de créer un formulaire pour passer une commande
 */
class CreateOrderView
{
    /**
     * @param $menus
     * @return false|string
     */
    public function toString($menus): false|string
    {
        ob_start();
        ?>
        <div class="container">
            <h2>Place Your Order</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="menu">Select Menu:</label>
                    <select class="form-control" id="menu" name="menu">
                        <?php foreach ($menus as $menu) : ?>
                            <option value="<?= $menu['id'] ?>">
                                Menu n°<?= $menu['id'] ?>:
                                <?php
                                $dishNames = array_map(function($dish) {
                                    return $dish['name'];
                                }, $menu['dishes']);
                                echo implode(', ', $dishNames);
                                ?>
                            </option>
                        <?php endforeach; ?>
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