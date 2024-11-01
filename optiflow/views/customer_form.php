<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/customer_form.css">
</head>
<body>
    <form action="customer_process.php" method="POST">
        <label for="title">Title:</label>
        <select id="title" name="title" required>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
        </select>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>

        <label for="district">District:</label>
        <input type="text" id="district" name="district" required>

        <button type="submit" name="submit">Register Customer</button>
    </form>
</body>
</html>
