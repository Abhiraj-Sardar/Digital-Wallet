<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer</title>
    <style>

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
        }

        footer {
            background-color: #1a1a2e;
            color: #e0e0e0;
            padding: 3rem 2rem 1.5rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: #fff;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: #e0e0e0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #667eea;
        }

        .footer-section p {
            line-height: 1.6;
            color: #b0b0b0;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background-color: #2a2a3e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .social-links a:hover {
            background-color: #667eea;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 1.5rem;
            border-top: 1px solid #2a2a3e;
            text-align: center;
            color: #b0b0b0;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            footer {
                padding: 2rem 1.5rem 1rem;
            }

            .footer-section {
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We are dedicated to providing excellent services and creating meaningful experiences for our customers.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook">f</a>
                    <a href="#" aria-label="Twitter">t</a>
                    <a href="#" aria-label="Instagram">i</a>
                    <a href="#" aria-label="LinkedIn">in</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Development</a></li>
                    <li><a href="#">SEO Marketing</a></li>
                    <li><a href="#">Consulting</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul>
                    <li>📧 info@company.com</li>
                    <li>📞 +1 (555) 123-4567</li>
                    <li>📍 123 Business St, City, Country</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 Your Company. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>