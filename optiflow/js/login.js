function handleSubmit(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');

    errorMessage.innerText = '';
    errorMessage.style.display = 'none';

    if (username === '' || password === '') {
        errorMessage.innerText = 'Please fill in all fields.';
        errorMessage.style.display = 'block';
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(username)) {
        errorMessage.innerText = 'Please enter a valid email address.';
        errorMessage.style.display = 'block';
        return;
    }

    const passwordMinLength = 8;
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;
    if (password.length < passwordMinLength) {
        errorMessage.innerText = `Password must be at least ${passwordMinLength} characters long.`;
        errorMessage.style.display = 'block';
        return;
    }
    if (!passwordPattern.test(password)) {
        errorMessage.innerText = 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
        errorMessage.style.display = 'block';
        return;
    }

    fetch('../DBOperations/authenticate.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const user = data.user;
            console.log('User ID:', user.id);
            console.log('User Name:', user.name);
            console.log('User Email:', user.email);

            localStorage.setItem('userId', user.id);
            localStorage.setItem('userName', user.name);

            // Redirect based on role
            if (user.role === 'manager') {
                window.location.href = '../views/dashboard.php';
            } else if (user.role === 'cashier') {
                window.location.href = '../views/cashier_Interface.php';
            }
        } else {
            errorMessage.innerText = data.message;
            errorMessage.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorMessage.innerText = 'An error occurred. Please try again later.';
        errorMessage.style.display = 'block';
    });
}
