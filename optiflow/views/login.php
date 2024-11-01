<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css"> <!-- Link to your external CSS file -->
    <title>OptiFlow ERP System</title>
</head>
<body>
    <!-- Navbar Section -->
    <div class="WebAdminContent">
        <!-- Back Button -->
        <button class="btn-back" onclick="handleBackClick()">Back</button>

        <div class="login-container">
            <div class="login-info">
                <img src="../images/depositphotos_73266857-stock-illustration-vector-logo-for-letter-o-removebg-preview.png" alt=" Logo" class="login-logo" /> <!-- Replace with actual logo path -->
                <h1>Welcome to OptiFlow</h1>
                <p>
                An efficient and scalable ERP system designed for modern businesses, offering seamless integration, real-time data analytics, and enhanced operational efficiency.
                </p>
            </div>
            <div class="login-form">
                <h2>Login</h2>
                <div id="error-message" class="alert-box" style="display: none;"></div>
                <form id="login-form" onsubmit="handleSubmit(event)">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input
                            type="email"
                            id="username"
                            placeholder="Enter your email"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            placeholder="Enter your password"
                            required
                        />
                    </div>
                    <button type="submit" class="WebAdminlogin-button">Login</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 OptiFlow ERP. All Rights Reserved.</p>
    </footer>

   
</body>
</html>
