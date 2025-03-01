<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Local Software Service Platform</title>
  <link rel="stylesheet" href="">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


<body>
  <header>

  <!-- new nav section -->
<nav class="navbar">
  <div class="navbar__container">
    <a href="#home" id="navbar__logo">LP4-DEV</a>
    <ul class="navebar__menu">
      <li class="navbar__item">
        <li class="navbar__item">
          <a href="index.php" class="navbar__links" id="home-page">Home</a>
          </li>
          <li class="navbar__item">
            <a href="faq.php" class="navbar__links" id="faq-page">FAQ</a>
          </li>
          <li class="navbar__item">
            <a href="home.php" class="navbar__links" id="postjob-page">Login</a>
          </li>
          <li class="navbar__item">
            <a href="admin.php" class="navbar__links" id="postjob-page">Admin</a>
          </li>
          <li class="navbar__btn">
            <a href="home.php" class="button" id="home-page">Register</a>
      </li>
    </ul>
  </div>
</nav>


    
    <style>
        
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

/* Navbar Styles */
.navbar {
    background-color: #8174A0; /* Primary color */
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar__container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

#navbar__logo {
    color: #FFD2A0; /* Accent color */
    font-size: 1.5rem;
    text-decoration: none;
    font-weight: bold;
}

.navebar__menu {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
}

.navbar__links {
    color: #EFB6C8; /* Secondary color */
    text-decoration: none;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.navbar__links:hover {
    color: #FFD2A0; /* Accent color */
}

.button {
    background-color: #A888B5; /* Tertiary color */
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #8174A0; /* Primary color */
}

/* Hero Section */
.hero {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 20px;
    background: linear-gradient(135deg, #8174A0, #A888B5); /* Gradient using primary and tertiary colors */
    color: #fff;
    text-align: center;
}

.hero h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 40px;
}

/* Cards Container */
.cards-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

/* Card Styles */
.card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #A888B5; /* Tertiary color */
}

.card p {
    font-size: 1rem;
    color: #666;
}

.card a {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background: #A888B5; /* Tertiary color */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.card a:hover {
    background: #8174A0; /* Primary color */
}

/* Categories Section */
.categories {
    padding: 50px 20px;
    background-color: #EFB6C8; /* Secondary color */
    text-align: center;
}

.categories h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #8174A0; /* Primary color */
}

.category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
}

.category-item {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.category-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.category-item i {
    font-size: 2rem;
    color: #A888B5; /* Tertiary color */
    margin-bottom: 10px;
}

/* Featured Developers Section */
.featured-developers {
    padding: 50px 20px;
    background-color: #FFD2A0; /* Accent color */
    text-align: center;
}

.featured-developers h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #8174A0; /* Primary color */
}

.developer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
}

.developer-card {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.developer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.developer-card img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  margin-bottom: 1rem;
  object-fit: cover;
  
}



.developer-card h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #A888B5; /* Tertiary color */
}

.developer-card p {
    font-size: 1rem;
    color: #666;
}

/* Footer Styles */
footer {
    background-color: #8174A0; /* Primary color */
    color: #fff;
    text-align: center;
    padding: 20px;
}

.social-icons {
    margin-top: 10px;
}

.social-icons a {
    color: #FFD2A0; /* Accent color */
    margin: 0 10px;
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #EFB6C8; /* Secondary color */
}
    </style>

  

    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h1>local platform for kenyan software developers</h1>
            <p>Join our platform designed specifically for the Kenyan market, connecting local clients/businesses with skilled software developers. Enjoy lower registration fees, and easy way of local payment(mpesa/creditand debit).</p>
            <!-- Cards Container -->
            <div class="cards-container">
                <!-- Card 1 -->
                <div class="card">
                    <h2>client</h2>
                    <p>Need work done?</p>
                    <a href="home.php">Explore</a>
                </div>
                <!-- Card 2 -->
                <div class="card">
                    <h2>developer</h2>
                    <p>looking for work?</p>
                    <a href="home.php">Explore</a>
                </div>
            </div>
        </div>
    </section>







<section class="categories">
  <h2>Popular Services</h2>
  <div class="category-grid">
<div class="category-item"><i class="fas fa-laptop-code"></i>Web Development</div>
<div class="category-item"><i class="fas fa-mobile-alt"></i> Mobile App Development</div>
<div class="category-item"><i class="fas fa-paint-brush"></i> Graphic Design</div>
<div class="category-item"><i class="fas fa-bullhorn"></i> Digital Marketing</div>
<div class="category-item"><i class="fas fa-gamepad"></i> Game Development</div>
<div class="category-item"><i class="fas fa-cloud"></i> Cloud & DevOps</div>
<div class="category-item"><i class="fas fa-shield-alt"></i> Cyber security & Ethical Hacking</div>
<div class="category-item"><i class="fas fa-palette"></i> UI/UX & Graphic Design</div>
<div class="category-item"><i class="fas fa-database"></i> Database & Data Engineering</div>
<div class="category-item"><i class="fas fa-chain"></i> Blockchain & Web3 Development</div>
<div class="category-item"><i class="fas fa-robot"></i> AI & Machine Learning</div>
<div class="category-item"><i class="fas fa-cogs"></i> Software Development</div>

  </div>
</section>

<section class="featured-developers">
  <h2>Why Choose Our Platform?</h2>
  <p>Our platform is designed to help you find the best local software developers in Kenya. Here are some reasons why you should choose us:</p>
  <div class="developer-grid">
    <div class="developer-card">
      <img src="imgs/man3.jpg" alt="man2">
      <h3>MANFRED OKUMU</h3>
      <p>CEO</p>
      <p>LP4-DEV</p>
    </div>
    <div class="developer-card">
      <p><i class="fas fa-check-circle"></i>Verified Local Profiles</p>
      <p>All developers are verified using Kenyan ID and credentials</p>
      <p><i class="fas fa-comments"></i>Direct Communication</p>
      <p>Connect directly with developers in your area</p>
      <p><i class="fas fa-map-marker-alt"></i>Local Focus</p>
      <p>Platform designed specifically for the Kenyan market</p>
      <p><i class="fas fa-search"></i>Easy Developer Search</p>
      <p>Find developers by location, skills, and ratings</p>
      <p><i class="fas fa-percent"></i>Lower Commission Fees</p>
      <p>5%
        Lower Commission Fees;
        100%
        Local Payment Support;
        24/7
        Local Support.</p>
    </div>
  </div>
  
</section>

<footer>
  <p>&copy; 2025 LP4-DEV.All rights reserved</p>
  <div class="social-icons">
    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
  </div>
</footer>


</body>
</html>