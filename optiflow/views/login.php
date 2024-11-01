<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css"> <!-- Link to your external CSS file -->
    <title>OptiFlow ERP System</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Times New Roman', Arial, sans-serif; /* Changed to Times New Roman */
            background: #f4f4f4; /* Light background color */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Full height for the page */
        }

        /* Navbar Section */
        .navbar {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            padding: 1rem;
            text-align: left;
            color: white;
            position: relative;
        }

        .company-name {
            margin-left:10px;
                font-size: 1.5rem;
                font-weight: bold; /* This will make the text bold */
            }


        /* Form Container */
        .form-container {
            flex: 1; /* Take up available space */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem; /* Add padding around */
        }

        .form-wrapper {
            width: 100%;
            max-width: 400px; /* Limit the width */
            background: rgba(255, 255, 255, 0.9); /* Slightly more opaque background */
            border-radius: 10px; /* Softer corners */
            padding: 2rem;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); /* Enhanced shadow */
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem; /* Space below the title */
            color: #333; /* Darker text color */
        }

        .input-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #555; /* Softer label color */
        }

        .input-group input {
            width: 100%;
            padding: 0.8rem; /* Increased padding for inputs */
            border: 1px solid #ccc;
            border-radius: 5px; /* Slightly round edges */
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #007BFF; /* Highlight border on focus */
            outline: none; /* Remove default outline */
        }

        .login-button {
            width: 100%;
            background: linear-gradient(135deg, #007BFF, #0056b3);
            color: white;
            padding: 0.8rem; /* Slightly larger padding */
            border: none;
            border-radius: 5px; /* Slightly round edges */
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .login-button:hover {
            background: linear-gradient(135deg, #0056b3, #004494);
        }

        /* Footer styling */
        .footer {
            text-align: center;
            padding: 1rem;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white; /* White text for contrast */
            position: relative;
            width: 100%;
            margin-top: auto; /* Push footer to the bottom */
        }

        .footer p {
            margin: 0;
            color: #fff; /* White text color */
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    <div class="navbar">
        <div class="company-name">
            <i class="fas fa-chart-line"></i> OptiFlow ERP
        </div>
    </div>

    <!-- Login Section -->
    <div class="form-container">
        <div class="form-wrapper">
            <h2>Login</h2>
            <form id="login-form">
                <div class="input-group">
                    <label for="login-email">Email:</label>
                    <input type="email" id="login-email" required>
                </div>
                <div class="input-group">
                    <label for="login-password">Password:</label>
                    <input type="password" id="login-password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 OptiFlow ERP. All Rights Reserved.</p>
    </footer>

    <script>
        // JavaScript to handle form submission (if needed)
        const loginForm = document.getElementById('login-form');
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            // You can add your login logic here
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            console.log(`Email: ${email}, Password: ${password}`);
            // Add further login handling logic (e.g., AJAX call to backend)
        });
    </script>
</body>
</html>
