<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayFlow - Secure Login</title>
    <link rel="stylesheet" href="./Css/login.css"/>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="background-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <span class="logo-icon">💳</span>
                PayFlow
            </div>
            <p class="subtitle">Secure payment management made simple</p>

            <div id="errorMessage" class="error-message"></div>
            <div id="successMessage" class="success-message"></div>

            <form action='../Controller/login_handler.php' method='post' id="loginForm">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name='uemail' id="email" placeholder="Enter your email" required autocomplete="email">
                    <span class="input-icon">📧</span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name='upass' id="password" placeholder="Enter your password" required autocomplete="current-password">
                    <span class="input-icon">🔒</span>
                    <span class="password-toggle" onclick="togglePassword()">👁️</span>
                </div>

                <div class="remember-me">
                    <div class="g-recaptcha" data-sitekey="6LeqICQsAAAAAOrGc5wyYO2DgRleK-PIyDv6qYoO" data-callback="enableSubmitBtn"></div>
                </div>

                <button type="submit" id="loginBtn" class="login-btn" disabled>
                    Sign In 
                    <div class="spinner"></div>
                </button>
            </form>

            <div style="text-align: center; margin-bottom: 20px;">
                <a href="#" class="forgot-password" onclick="handleForgotPassword()">Forgot your password?</a>
            </div>

            <div class="divider">
                <span>or continue with</span>
            </div>

            <div class="social-login">
                <button class="social-btn google" onclick="handleSocialLogin('google')">
                    <span>🔍</span>
                    Google
                </button>
                <button class="social-btn facebook" onclick="handleSocialLogin('facebook')">
                    <span>📘</span>
                    Facebook
                </button>
            </div>

            <div class="signup-link">
                Don't have an account? 
                <a href="signUp.php">Create one now</a>
            </div>

            <div class="security-badges">
                <div class="security-badge">
                    <div class="security-icon">🔐</div>
                    <div>256-bit SSL</div>
                </div>
                <div class="security-badge">
                    <div class="security-icon">🛡️</div>
                    <div>Bank-level Security</div>
                </div>
                <div class="security-badge">
                    <div class="security-icon">✅</div>
                    <div>PCI Compliant</div>
                </div>
            </div>
        </div>
    </div>

    <script>

        let isSignupMode = false;
        let rememberMe = false;
        let acceptedTerms = false;

        function enableSubmitBtn(){
            document.getElementById("loginBtn").disabled=false;
        }

        // Password visibility toggle
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        function toggleSignupPassword() {
            const passwordInput = document.getElementById('signupPassword');
            const toggleIcons = document.querySelectorAll('#signupCard .password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcons[0].textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcons[0].textContent = '👁️';
            }
        }

        // Checkbox toggles
        function toggleCheckbox() {
            const checkbox = document.getElementById('rememberCheckbox');
            rememberMe = !rememberMe;
            
            if (rememberMe) {
                checkbox.classList.add('checked');
            } else {
                checkbox.classList.remove('checked');
            }
        }

        function toggleTermsCheckbox() {
            const checkbox = document.getElementById('termsCheckbox');
            acceptedTerms = !acceptedTerms;
            
            if (acceptedTerms) {
                checkbox.classList.add('checked');
            } else {
                checkbox.classList.remove('checked');
            }
        }

        // Password strength checker
        function checkPasswordStrength() {
            const password = document.getElementById('signupPassword').value;
            const strengthFill = document.getElementById('strengthFill');
            
            let strength = 0;
            let strengthClass = '';
            
            if (password.length >= 8) strength += 1;
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[a-z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            switch (strength) {
                case 0:
                case 1:
                case 2:
                    strengthFill.style.width = '33%';
                    strengthFill.className = 'strength-fill strength-weak';
                    break;
                case 3:
                case 4:
                    strengthFill.style.width = '66%';
                    strengthFill.className = 'strength-fill strength-medium';
                    break;
                case 5:
                    strengthFill.style.width = '100%';
                    strengthFill.className = 'strength-fill strength-strong';
                    break;
            }
        }

        // Form switching
        

        // Form handlers

        function handleSignup(event) {
            event.preventDefault();
            const signupBtn = document.getElementById('signupBtn');
            const errorDiv = document.getElementById('signupErrorMessage');
            const successDiv = document.getElementById('signupSuccessMessage');
            
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('signupEmail').value;
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('signupPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Clear previous messages
            errorDiv.style.display = 'none';
            successDiv.style.display = 'none';

            // Validation
            if (!acceptedTerms) {
                errorDiv.textContent = 'Please accept the Terms of Service and Privacy Policy';
                errorDiv.style.display = 'block';
                return;
            }

            if (password !== confirmPassword) {
                errorDiv.textContent = 'Passwords do not match';
                errorDiv.style.display = 'block';
                return;
            }

            if (password.length < 8) {
                errorDiv.textContent = 'Password must be at least 8 characters long';
                errorDiv.style.display = 'block';
                return;
            }

            // Show loading state
            signupBtn.classList.add('loading');

            // Simulate API call
            setTimeout(() => {
                signupBtn.classList.remove('loading');
                successDiv.textContent = 'Account created successfully! Please check your email to verify your account.';
                successDiv.style.display = 'block';
                
                setTimeout(() => {
                    switchToLogin();
                }, 2000);
            }, 2000);
        }

        function handleSocialLogin(provider) {
            showMessage(`🔄 Redirecting to ${provider} login...`, 'info');
            
            // Simulate social login
            setTimeout(() => {
                showMessage(`✅ ${provider} login successful!`, 'success');
            }, 1500);
        }

        function handleForgotPassword() {
            const email = document.getElementById('email').value;
            
            if (email) {
                showMessage(`📧 Password reset link sent to ${email}`, 'success');
            } else {
                showMessage('Please enter your email address first', 'error');
            }
        }

        // Utility functions
        function showMessage(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#4ecdc4' : type === 'error' ? '#ff6b6b' : '#667eea'};
                color: white;
                padding: 15px 25px;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                font-weight: 600;
                animation: slideInRight 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease forwards';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Input animations and validations
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus animations to inputs
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Format phone number
            const phoneInput = document.getElementById('phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length >= 6) {
                        value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                    } else if (value.length >= 3) {
                        value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
                    }
                    this.value = value;
                });
            }

            // Email validation animation
            const emailInputs = document.querySelectorAll('input[type="email"]');
            emailInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value && !this.validity.valid) {
                        this.style.borderColor = '#ff6b6b';
                        this.style.animation = 'shake 0.5s ease';
                    } else if (this.value && this.validity.valid) {
                        this.style.borderColor = '#4ecdc4';
                    }
                });
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.ctrlKey) {
                if (!isSignupMode) {
                    document.getElementById('loginForm').dispatchEvent(new Event('submit'));
                } else {
                    document.getElementById('signupForm').dispatchEvent(new Event('submit'));
                }
            }
        });

        // Add shake animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
            
            @keyframes slideInRight {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Demo account hint
        setTimeout(() => {
            showMessage('💡 Demo: Use demo@payflow.com / demo123', 'info');
        }, 2000);
    </script>
</body>
</html>