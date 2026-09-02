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
        <h1>Bluebridge Student Hub</h1>
        <nav>
            <a href="index.php" class="active">Home</a>
            <a href="register.php">Register Student</a>
            <a href="list.php">View Students</a>
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
    </main>
</div>
</body>
</html>