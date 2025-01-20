document.getElementById('addIngredient').addEventListener('click', function () {
    const ingredientFields = document.getElementById('ingredientFields');
    const newField = document.createElement('div');
    newField.classList.add('input-group', 'mb-2');
    newField.innerHTML = `
        <input type="text" name="ingredients[]" class="form-control" placeholder="Enter ingredient name">
        <input type="number" name="quantities[]" class="form-control" placeholder="Quantity">
        <button type="button" class="btn btn-danger remove-ingredient">Remove</button>
    `;
    ingredientFields.appendChild(newField);
});

document.getElementById('ingredientFields').addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-ingredient')) {
        event.target.parentElement.remove();
    }
});
