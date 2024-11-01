<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/item_form.css">
</head>
<body>
    <form action="item_process.php" method="POST">
        <label for="item_code">Item Code:</label>
        <input type="text" id="item_code" name="item_code" required>

        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required>

        <label for="item_category">Item Category:</label>
        <input type="text" id="item_category" name="item_category" required>

        <label for="item_subcategory">Item Sub Category:</label>
        <input type="text" id="item_subcategory" name="item_subcategory" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <label for="unit_price">Unit Price:</label>
        <input type="number" id="unit_price" name="unit_price" required>

        <button type="submit" name="submit">Register Item</button>
    </form>
</body>
</html>
