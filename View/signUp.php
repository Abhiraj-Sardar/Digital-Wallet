<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Create Your Account</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .signup-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            transform: translateY(0);
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-header h1 {
            color: #333;
            font-size: 2.2em;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .signup-header p {
            color: #666;
            font-size: 1em;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #555;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95em;
        }

        .form-group input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #fafbfc;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-group input.error {
            border-color: #e74c3c;
            background: #fdf2f2;
        }

        .form-group input.success {
            border-color: #27ae60;
            background: #f2fcf5;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85em;
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .error-message.show {
            opacity: 1;
        }

        .success-message {
            color: #27ae60;
            font-size: 0.85em;
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .success-message.show {
            opacity: 1;
        }

        .password-strength {
            margin-top: 10px;
        }

        .strength-bar {
            height: 4px;
            background: #e1e5e9;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #e74c3c; width: 33%; }
        .strength-medium { background: #f39c12; width: 66%; }
        .strength-strong { background: #27ae60; width: 100%; }

        .strength-text {
            font-size: 0.8em;
            margin-top: 5px;
            font-weight: 500;
        }

        .signup-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
        }

        .signup-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .signup-btn:active {
            transform: translateY(0);
        }

        .signup-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .signup-btn .loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff30;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .signup-footer {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.9em;
        }

        .signup-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-footer a:hover {
            color: #764ba2;
        }

        .form-animation {
            animation: inputFocus 0.3s ease;
        }

        @keyframes inputFocus {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        @media (max-width: 500px) {
            .signup-container {
                padding: 30px 25px;
                margin: 10px;
            }
            
            .signup-header h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-header">
            <h1>Create Account</h1>
            <p>Join us today and get started!</p>
        </div>

        <form action='../Controller/signUp_handler.php' method='post' id="signupForm" novalidate>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                <div class="error-message" id="usernameError"></div>
                <div class="success-message" id="usernameSuccess"></div>
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
                <div class="error-message" id="nameError"></div>
                <div class="success-message" id="nameSuccess"></div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="emailError"></div>
                <div class="success-message" id="emailSuccess"></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message" id="passwordError"></div>
                <div class="success-message" id="passwordSuccess"></div>
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                </div>
            </div>

            <button type="submit" class="signup-btn" id="submitBtn">
                <span class="loader" id="loader"></span>
                <span id="btnText">Create Account</span>
            </button>
        </form>

        <div class="signup-footer">
            Already have an account? <a href="#" id="loginLink">Sign In</a>
        </div>
    </div>

    <script>
        const form = document.getElementById('signupForm');
        const inputs = form.querySelectorAll('input');
        const submitBtn = document.getElementById('submitBtn');
        const loader = document.getElementById('loader');
        const btnText = document.getElementById('btnText');

        // Form validation patterns
        const patterns = {
            username: /^[a-zA-Z0-9_]{3,20}$/,
            name: /^[a-zA-Z\s]{2,50}$/,
            email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            password: /^.{8,}$/
        };

        // Error messages
        const errorMessages = {
            username: {
                required: 'Username is required',
                invalid: 'Username must be 3-20 characters, letters, numbers, underscore only'
            },
            name: {
                required: 'Full name is required',
                invalid: 'Name must be 2-50 characters, letters and spaces only'
            },
            email: {
                required: 'Email address is required',
                invalid: 'Please enter a valid email address'
            },
            password: {
                required: 'Password is required',
                invalid: 'Password must be at least 8 characters long'
            }
        };

        // Add event listeners to inputs
        inputs.forEach(input => {
            input.addEventListener('focus', handleInputFocus);
            input.addEventListener('blur', handleInputBlur);
            input.addEventListener('input', handleInputChange);
        });

        // Special handling for password strength
        document.getElementById('password').addEventListener('input', updatePasswordStrength);

        function handleInputFocus(e) {
            e.target.parentElement.classList.add('form-animation');
            clearValidation(e.target);
        }

        function handleInputBlur(e) {
            e.target.parentElement.classList.remove('form-animation');
            validateField(e.target);
        }

        function handleInputChange(e) {
            if (e.target.classList.contains('error') || e.target.classList.contains('success')) {
                validateField(e.target);
            }
        }

        function validateField(input) {
            const value = input.value.trim();
            const fieldName = input.name;
            const errorElement = document.getElementById(fieldName + 'Error');
            const successElement = document.getElementById(fieldName + 'Success');

            // Clear previous states
            clearValidation(input);

            // Check if field is empty
            if (!value) {
                showError(input, errorElement, errorMessages[fieldName].required);
                return false;
            }

            // Check pattern
            if (!patterns[fieldName].test(value)) {
                showError(input, errorElement, errorMessages[fieldName].invalid);
                return false;
            }

            // Show success
            showSuccess(input, successElement, getSuccessMessage(fieldName));
            return true;
        }

        function showError(input, errorElement, message) {
            input.classList.add('error');
            input.classList.remove('success');
            errorElement.textContent = message;
            errorElement.classList.add('show');
        }

        function showSuccess(input, successElement, message) {
            input.classList.add('success');
            input.classList.remove('error');
            successElement.textContent = message;
            successElement.classList.add('show');
        }

        function clearValidation(input) {
            const fieldName = input.name;
            const errorElement = document.getElementById(fieldName + 'Error');
            const successElement = document.getElementById(fieldName + 'Success');
            
            input.classList.remove('error', 'success');
            errorElement.classList.remove('show');
            successElement.classList.remove('show');
        }

        function getSuccessMessage(fieldName) {
            const messages = {
                username: 'Username looks good!',
                name: 'Great name!',
                email: 'Valid email address!',
                password: 'Strong password!'
            };
            return messages[fieldName];
        }

        function updatePasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');

            if (password.length === 0) {
                strengthFill.className = 'strength-fill';
                strengthText.textContent = '';
                return;
            }

            let score = 0;
            
            // Length check
            if (password.length >= 8) score++;
            if (password.length >= 12) score++;
            
            // Complexity checks
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            let strength, text;
            if (score < 3) {
                strength = 'strength-weak';
                text = 'Weak';
            } else if (score < 5) {
                strength = 'strength-medium';
                text = 'Medium';
            } else {
                strength = 'strength-strong';
                text = 'Strong';
            }

            strengthFill.className = `strength-fill ${strength}`;
            strengthText.textContent = text;
            strengthText.style.color = strength === 'strength-weak' ? '#e74c3c' : 
                                     strength === 'strength-medium' ? '#f39c12' : '#27ae60';
        }

        function validateForm() {
            let isValid = true;
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            return isValid;
        }

        // Form submission
        // form.addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     if (validateForm()) {
        //         // Show loading state
        //         submitBtn.disabled = true;
        //         loader.style.display = 'inline-block';
        //         btnText.textContent = 'Creating Account...';
                
        //         // Simulate API call
        //         setTimeout(() => {
        //             // Reset button state
        //             submitBtn.disabled = false;
        //             loader.style.display = 'none';
        //             btnText.textContent = 'Create Account';
                    
        //             // Show success message
        //             alert('Account created successfully! Welcome aboard!');
                    
        //             // Reset form
        //             form.reset();
        //             inputs.forEach(input => clearValidation(input));
                    
        //             // Clear password strength
        //             document.getElementById('strengthFill').className = 'strength-fill';
        //             document.getElementById('strengthText').textContent = '';
        //         }, 2000);
        //     }
        // });

        // Login link handler
        document.getElementById('loginLink').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Login functionality would be implemented here!');
        });

        // Add subtle animations to form elements
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        // Observe form groups for animation
        document.querySelectorAll('.form-group').forEach(group => {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            group.style.transition = 'all 0.5s ease';
            observer.observe(group);
        });
    </script>
</body>
</html>