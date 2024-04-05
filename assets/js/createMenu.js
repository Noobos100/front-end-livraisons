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
                `;
    document.getElementById('dishFields').appendChild(newDishField);

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
    input.addEventListener('input', calculateTotalPrice);
});