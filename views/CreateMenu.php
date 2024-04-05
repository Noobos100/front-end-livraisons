<?php

namespace views;

use api\APIHandler;

class CreateMenu
{
    function submitMenu()
    {
        $api_url = 'http://localhost:3000/menus';
        $data = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'dishes' => $_POST['dishes']
        ];
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => json_encode($data)
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($api_url, false, $context);
        if ($result === FALSE) {
            echo 'Error creating menu';
        } else {
            echo 'Menu created successfully';
        }
    }

    public static function toString($plats)
    {
        ob_start();
        ?>
        <form method="post">
            <label for="name">Menu Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="price">Menu Price:</label><br>
            <input type="number" id="price" name="price" readonly><br>
            <div id="dishFields">
                <div class="dishField">
                    <label for="dish1">Dish 1:</label>
                    <select class="dishSelect" name="dishes[1][id]">
                        <?php foreach ($plats as $plat) : ?>
                            <option value="<?= $plat['id'] ?>"
                                    data-price="<?= $plat['price'] ?>"><?= $plat['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="quantity1">Quantity:</label>
                    <input type="number" class="quantity" name="dishes[1][quantity]" value="1">
                </div>
            </div>
            <button type="button" id="addDish">Add Dish</button>
            <button type="submit" name="submit">Create Menu</button>
        </form>

        <script>
            document.getElementById('addDish').addEventListener('click', function () {
                var dishCount = document.querySelectorAll('.dishField').length + 1;
                var newDishField = document.createElement('div');
                newDishField.className = 'dishField';
                newDishField.innerHTML = `
        <label for="dish${dishCount}">Dish ${dishCount}:</label>
        <select class="dishSelect" name="dishes[${dishCount}][id]">
            <?php foreach ($plats as $plat) : ?>
                <option value="<?= $plat['id'] ?>" data-price="<?= $plat['price'] ?>"><?= $plat['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <label for="quantity${dishCount}">Quantity:</label>
        <input type="number" class="quantity" name="dishes[${dishCount}][quantity]" value="1">
        <button type="button" class="removeDish">Remove</button>`;
                document.getElementById('dishFields').appendChild(newDishField);

                // Add event listener to the remove button
                newDishField.querySelector('.removeDish').addEventListener('click', function () {
                    newDishField.remove();
                    calculateTotalPrice(); // Recalculate total price when a dish is removed
                });

                // Recalculate total price when a dish is added
                calculateTotalPrice();
            });

            // Function to calculate total price based on selected dishes and quantities
            function calculateTotalPrice() {
                var totalPrice = 0;
                var dishSelects = document.querySelectorAll('.dishSelect');
                var quantityInputs = document.querySelectorAll('.quantity');
                for (var i = 0; i < dishSelects.length; i++) {
                    var selectedPrice = parseFloat(dishSelects[i].selectedOptions[0].getAttribute('data-price'));
                    var quantity = parseInt(quantityInputs[i].value);
                    totalPrice += selectedPrice * quantity;
                }
                document.getElementById('price').value = totalPrice.toFixed(2);
            }

            // Call calculateTotalPrice initially to set the initial total price
            calculateTotalPrice();

            // Add event listeners to recalculate total price whenever a dish or quantity changes
            var dishSelects = document.querySelectorAll('.dishSelect');
            var quantityInputs = document.querySelectorAll('.quantity');
            dishSelects.forEach(function (select) {
                select.addEventListener('change', calculateTotalPrice);
            });
            quantityInputs.forEach(function (input) {
                input.addEventListener('change', calculateTotalPrice);
            });
        </script>

        <?php
        return ob_get_clean();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    (new CreateMenu)->submitMenu();
}

?>