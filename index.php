<?php

require_once "auth.php";
start_session();
$isSignedIn = !empty($_SESSION["student_record_id"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bluebridge Student Hub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header class="header">
        <div class="brand-wrap">
            <div class="brand-mark">B</div>
            <h1>Bluebridge Student Hub</h1>
        </div>
        <nav>
            <a href="index.php" class="active">Home</a>
            <a href="register.php">Register Student</a>
            <a href="list.php">View Students</a>
            <a href="options.php">Options</a>
            <?php if ($isSignedIn): ?>
                <a href="account.php">My Account</a>
                <a href="logout.php">Sign Out</a>
            <?php else: ?>
                <a href="login.php">Sign In</a>
            <?php endif; ?>
        </nav>
    </header>

    <main class="home-page">
        <section class="hero">
            <div class="hero-copy">
                <div class="eyebrow">CAMPUS OVERVIEW</div>
                <h2>Smart student management for every classroom.</h2>
                <p>
                    Organize student registrations, track class records, and keep your school data
                    accessible from a single, welcoming dashboard.
                </p>
                <div class="hero-actions">
                    <a class="button" href="register.php">Register a Student</a>
                    <a class="button secondary" href="list.php">View Student List</a>
                </div>
            </div>

            <div class="hero-art" aria-label="Student management overview">
                <div class="slideshow">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=80" alt="Students in a classroom" class="slide active">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80" alt="Students collaborating in a group" class="slide">
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=900&q=80" alt="Students running and playing sports" class="slide">
                    <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1200&q=80" alt="Students in a club activity" class="slide">
                </div>

                <div class="slide-overlay">
                    <button class="slider-btn prev" type="button" aria-label="Previous image">&#8249;</button>
                    <div class="slider-dots" aria-label="Slide indicators">
                        <button class="dot active" type="button" aria-label="Show slide 1"></button>
                        <button class="dot" type="button" aria-label="Show slide 2"></button>
                        <button class="dot" type="button" aria-label="Show slide 3"></button>
                        <button class="dot" type="button" aria-label="Show slide 4"></button>
                    </div>
                    <button class="slider-btn next" type="button" aria-label="Next image">&#8250;</button>
                </div>

                <div class="mini-card mini-card-top">
                    <span>Active students</span>
                    <strong>1,240</strong>
                </div>
                <div class="mini-card mini-card-bottom">
                    <span>Classes</span>
                    <strong>18</strong>
                </div>
                <div class="paper-stack">
                    <span>Ready for admission</span>
                </div>
            </div>
        </section>

        <section class="stats" aria-label="Key student statistics">
            <div class="stat-card">
                <strong>350</strong>
                <span>new applications</span>
            </div>
            <div class="stat-card">
                <strong>92%</strong>
                <span>attendance rate</span>
            </div>
            <div class="stat-card">
                <strong>24/7</strong>
                <span>records access</span>
            </div>
        </section>

        <section class="brand-strip" aria-label="School identity panel">
            <div class="brand-badge">
                <span class="badge-symbol">B</span>
                <div>
                    <strong>Bluebridge</strong>
                    <small>Academic excellence</small>
                </div>
            </div>
            <div class="brand-copy">
                Learning, growth, and campus life designed for every student journey.
            </div>
        </section>

        <section class="quick-actions" aria-label="Quick actions">
            <div class="action-card">
                <span>New student</span>
                <h3>Register today</h3>
                <a href="register.php">Open form</a>
            </div>
            <div class="action-card">
                <span>Student data</span>
                <h3>Review records</h3>
                <a href="list.php">View list</a>
            </div>
            <div class="action-card">
                <span>School system</span>
                <h3>Explore options</h3>
                <a href="options.php">See all</a>
            </div>
        </section>

        <section class="feature-grid" aria-label="Platform features">
            <article class="feature-item">
                <div class="feature-icon">01</div>
                <h3>Quick Registration</h3>
                <p>Capture student details in seconds and add them to the school directory.</p>
            </article>
            <article class="feature-item">
                <div class="feature-icon">02</div>
                <h3>Simple Search</h3>
                <p>Find students by name or class and manage records without unnecessary steps.</p>
            </article>
            <article class="feature-item">
                <div class="feature-icon">03</div>
                <h3>Reliable Records</h3>
                <p>Keep your student database organized with clear, timestamped entries.</p>
            </article>
        </section>

        <section class="gallery-section" aria-label="Campus activities gallery">
            <div class="section-heading">
                <div class="eyebrow">STUDENT LIFE</div>
                <h3>Classrooms and campus activities</h3>
            </div>

            <div class="gallery-grid">
                <figure class="gallery-card tall">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=80" alt="Students in a classroom learning together">
                    <figcaption>Focused learning in class</figcaption>
                </figure>

                <figure class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80" alt="Students collaborating during a group activity">
                    <figcaption>Teamwork and group projects</figcaption>
                </figure>

                <figure class="gallery-card">
                    <img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=900&q=80" alt="Students playing sports on a field">
                    <figcaption>Running and playing sports</figcaption>
                </figure>

                <figure class="gallery-card wide">
                    <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1200&q=80" alt="Students taking part in a club activity">
                    <figcaption>Club participation and campus engagement</figcaption>
                </figure>
            </div>
        </section>

        <footer class="site-footer">
            <p>Bluebridge Student Hub</p>
            <span>Learning, growth, and a connected campus.</span>
            <div class="footer-links">
                <a href="register.php">Register</a>
                <a href="list.php">Students</a>
                <a href="options.php">Options</a>
            </div>
        </footer>
    </main>
</div>
    <script>
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        const prevButton = document.querySelector('.slider-btn.prev');
        const nextButton = document.querySelector('.slider-btn.next');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });

            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        nextButton.addEventListener('click', nextSlide);
        prevButton.addEventListener('click', prevSlide);

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        setInterval(nextSlide, 3000);
    </script>
</body>
</html>