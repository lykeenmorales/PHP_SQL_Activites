<?php
    session_start();
    include '../mainFunctions/connection.php';

    if (isset($_SESSION['Login_UserID'])){
        if (isset($_SESSION['Login_UserType'])){
            if ($_SESSION['Login_UserType'] == "Admin"){
                //header("Location: ../homepage.php");
            }
        }
    }else{
        header("Location: ../LoginPage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- MDBootstrap and Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
        /* Custom Styles for Modern Look */
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .nav-link {
            color: #333 !important;
            font-weight: bold;
        }
        .hero-section {
            background: url('stationary_background.jpg') no-repeat center center / cover;
            color: white;
            text-align: center;
            padding: 8rem 1rem;
            position: relative;
        }
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .hero-section h1 {
            font-size: 3rem;
            z-index: 1;
            font-weight: 700;
        }
        .hero-section p {
            font-size: 1.2rem;
            z-index: 1;
        }
        .hero-section a {
            font-size: 1.2rem;
            z-index: 2;
        }
        .btn-cta {
            padding: 0.8rem 2rem;
            font-weight: 600;
            border-radius: 25px;
        }
        .product-card {
            border: none;
            transition: transform 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .product-card:hover {
            transform: translateY(-10px);
        }
        .product-card img {
            border-radius: 10px;
        }
        .footer {
            background-color: #333;
            color: #fff;
            padding: 2rem 1rem;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Stationary Supplies</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <a href="../mainFunctions/pageFunctions/Logout.php" class="text-decoration-none">Logout</a>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section d-flex flex-column justify-content-center align-items-center">
    <h1>Discover Quality Stationary</h1>
    <p class="lead">Providing excellence in stationary for professionals, students, and creatives.</p>
    <a href="#" class="btn btn-primary btn-cta">Shop Now</a>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row">
            <!-- Example Product Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card product-card">
                    <img src="product1.jpg" class="card-img-top" alt="Notebook">
                    <div class="card-body text-center">
                        <h5 class="card-title">Notebook</h5>
                        <p class="card-text">Sleek, high-quality notebooks for all your needs.</p>
                        <a href="#" class="btn btn-outline-primary btn-cta">Buy Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card product-card">
                    <img src="product1.jpg" class="card-img-top" alt="Notebook">
                    <div class="card-body text-center">
                        <h5 class="card-title">Notebook</h5>
                        <p class="card-text">Sleek, high-quality notebooks for all your needs.</p>
                        <a href="#" class="btn btn-outline-primary btn-cta">Buy Now</a>
                    </div>
                </div>
            </div>
            <!-- Add more product cards here -->
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2024 Stationary Supplies. All rights reserved.</p>
</footer>

<!-- MDBootstrap and Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
