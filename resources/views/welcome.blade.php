<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Costco work wave - Strategic Advertising Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            text-decoration: none;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav a:hover {
            color: #667eea;
        }

        .nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .nav a:hover::after {
            width: 100%;
        }

        .login-btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        /* Hero Section */
        .hero {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23ffffff" fill-opacity="0.05" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1.1rem;
        }

        .btn-primary {
            background: white;
            color: #667eea;
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* About Section */
        .about {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-text h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .about-text p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            color: #666;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #eee;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
            font-size: 1.5rem;
        }

        .service-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .service-card p {
            color: #666;
            font-size: 0.95rem;
        }

        /* FAQ Section */
        .faq {
            padding: 100px 0;
            background: white;
        }

        .faq h2 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 3rem;
            color: #2c3e50;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            margin-bottom: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #eee;
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: #e9ecef;
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-answer.active {
            max-height: 200px;
            padding: 1.5rem;
        }

        .faq-toggle {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(45deg);
        }

        /* Contact Section */
        .contact {
            padding: 100px 0;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
        }

        .contact h2 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .submit-btn {
            background: white;
            color: #2c3e50;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #667eea;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .about-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .contact-content {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
    <div class="container">
        <div class="header-inner">
            <a href="#home" class="logo">
                <img src="logo.png" alt="Costco Work Wave" style="height:50px;">
            </a>
            <nav>
                <ul class="nav">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <a href="/login" class="login-btn">Login</a>
        </div>
    </div>
</header>


    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content animate-fade-in">
                <h1>Strategic Advertising Solutions</h1>
                <p>Elevate your brand with Costco Work Wave' innovative advertising strategies. We create compelling campaigns that drive results and maximize your ROI.</p>
                <div class="cta-buttons">
                    <a href="#about" class="btn btn-primary">Learn More</a>
                    <a href="/register" class="btn btn-secondary">Get Started</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Costco Work wave</h2>
                    <p>At Costco Work wave, we're passionate about transforming brands through strategic advertising. With over a decade of experience, we've helped hundreds of businesses achieve their marketing goals.</p>
                    <p>Our team of creative professionals and data-driven strategists work together to deliver campaigns that not only look great but also perform exceptionally well in today's competitive market.</p>
                    <p>We believe in building long-term partnerships with our clients, understanding their unique challenges, and creating tailored solutions that drive measurable results.</p>
                </div>
                <div class="about-image">
                    <div class="services-grid">
                        <div class="service-card">
                            <div class="service-icon">📊</div>
                            <h3>Digital Marketing</h3>
                            <p>Comprehensive digital strategies including SEO, PPC, social media, and content marketing.</p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">🎨</div>
                            <h3>Creative Design</h3>
                            <p>Eye-catching visuals and compelling copy that resonate with your target audience.</p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">📈</div>
                            <h3>Analytics & Reporting</h3>
                            <p>Data-driven insights and detailed reports to track campaign performance and ROI.</p>
                        </div>
                        <div class="service-card">
                            <div class="service-icon">🎯</div>
                            <h3>Brand Strategy</h3>
                            <p>Strategic brand positioning and messaging that sets you apart from competitors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq">
        <div class="container">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>What services does Costco Work Wave offer?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>We offer comprehensive advertising solutions including digital marketing, creative design, brand strategy, social media management, SEO, PPC advertising, content marketing, and detailed analytics reporting.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>How long does it take to see results?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Results vary depending on the campaign type and industry. Digital advertising campaigns typically show initial results within 2-4 weeks, while SEO and brand building efforts may take 3-6 months to show significant impact.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you work with small businesses?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Absolutely! We work with businesses of all sizes, from startups to enterprise companies. We tailor our strategies and pricing to match your budget and goals.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>How do you measure campaign success?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>We use various KPIs including ROI, conversion rates, click-through rates, engagement metrics, and brand awareness metrics. We provide detailed monthly reports with actionable insights.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>What's your pricing structure?</span>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Our pricing varies based on services required, campaign complexity, and duration. We offer both project-based and retainer options. Contact us for a customized quote based on your specific needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2>Get In Touch</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div>
                            <h3>Email</h3>
                            <p>info@Costco Work Wave.store</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div>
                            <h3>Phone</h3>
                            <p>+1 (555) 123-4567</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div>
                            <h3>Address</h3>
                            <p>123 Innovation Drive<br>Business District, NY 10001</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🕒</div>
                        <div>
                            <h3>Business Hours</h3>
                            <p>Monday - Friday: 9AM - 6PM<br>Saturday: 10AM - 4PM</p>
                        </div>
                    </div>
                </div>
                <form class="contact-form" onsubmit="handleSubmit(event)">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company" placeholder="Your Company">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required placeholder="Tell us about your project..."></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <p>&copy; 2025 Costco Work Wave. All rights reserved.</p>
                </div>
                <div class="social-links">
                    <a href="#" title="Facebook">📘</a>
                    <a href="#" title="Twitter">🐦</a>
                    <a href="#" title="LinkedIn">💼</a>
                    <a href="#" title="Instagram">📷</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // FAQ Toggle
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.parentElement;
                const answer = faqItem.querySelector('.faq-answer');
                
                // Close all other FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== faqItem) {
                        item.classList.remove('active');
                        item.querySelector('.faq-answer').classList.remove('active');
                    }
                });
                
                // Toggle current FAQ item
                faqItem.classList.toggle('active');
                answer.classList.toggle('active');
            });
        });

        // Form submission
        function handleSubmit(event) {
            event.preventDefault();
            alert('Thank you for your message! We\'ll get back to you soon.');
            event.target.reset();
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.98)';
                header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
            } else {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.boxShadow = 'none';
            }
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe service cards
        document.querySelectorAll('.service-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>