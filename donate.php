<?php
include 'php/connection.php';
include 'php/functions.php'; // Include the file where storeDonationFormData() function is defined

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['donation-name'];
    $phone = $_POST['donation-phone'];
    $address = $_POST['donation-address'];
    $email = $_POST['donation-email'];
    $cycleType = $_POST['donation-type'];
// In the form submission handling PHP code
$condition = isset($_POST['donation-condition']) ? implode(', ', $_POST['donation-condition']) : '';
    $repairOptions = isset($_POST['repair-options']) ? implode(', ', $_POST['repair-options']) : '';
    $donationType = $_POST['donation-type'];
    $paymentOption = $_POST['donation-payment'];
    
    // Call the storeDonationFormData function
    $result = storeDonationFormData($name, $phone, $address, $email, $cycleType, $condition, $repairOptions, $donationType, $paymentOption);
    
    // Display result message
    echo $result;
}
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title> Donate at cyclerevive</title>

        <!-- CSS FILES -->        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-kind-heart-charity.css" rel="stylesheet">

    </head>
    
    
    <body>

        <header class="site-header">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-8 col-12 d-flex flex-wrap">
                        <p class="d-flex me-4 mb-0">
                            <i class="bi-geo-alt me-2"></i>
                            Mumbai,India
                        </p>

                        <p class="d-flex mb-0">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:info@company.com">
                                info@company.com
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-3 col-12 ms-auto d-lg-block d-none">
                        <ul class="social-icon">
                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-twitter"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-facebook"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-instagram"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-youtube"></a>
                            </li>

                            <li class="social-icon-item">
                                <a href="#" class="social-icon-link bi-whatsapp"></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg bg-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo.png" class="logo img-fluid" alt="">
                    <span>
                        Cycle
                        <small>Revive</small>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_1">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_2">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_3">Volunteer</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_4">Event Details</a>
                        </li>

                    
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="index.php#section_5">Contact Us</a>
                        </li>

                        <li class="nav-item ms-3">
                            <a class="nav-link custom-btn custom-border-btn btn" href="donate.php">Donate</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <style>
            /* Add your CSS styles here */
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
            }
    
            .donate-section {
                padding: 50px 0;
                text-align: center;
                background: url('images/group-people-volunteering-foodbank-poor-people.jpg');
                object-fit: cover;
            }
    
            .custom-form {
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }
    
            .btn {
                display: inline-block;
                padding: 10px 20px;
                margin: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
    
            .btn:hover {
                background-color: #0056b3;
            }
    
            h3 {
                margin-bottom: 20px;
                color: #333;
            }
    
            h5 {
                margin-bottom: 10px;
                color: #333;
            }
    
            .form-check {
                text-align: left;
                margin-bottom: 10px;
            }
    
            .form-check-label {
                color: #333;
            }
            .site-header, .site-footer {
                background-color: #3D405B;
            }
            .site-footer-title {
                color: white
            }
        </style>
    </head>
    <body>
    
    <!-- Page 1: Personal Information -->
    <form class="custom-form donate-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form">
    <main>
        <section class="donate-section">
            <div class="container">
                <div class="col-lg-6 col-12 mx-auto">
                    <div class="custom-form donate-form" action="#" method="post" role="form">
                        <h3>Make a donation</h3>
    
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h5>Personal Information</h5>
                            </div>
                            <!-- Personal Information Fields -->
                            <div class="col-lg-6 col-12 mt-2">
                                <input type="text" name="donation-name" id="donation-name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-lg-6 col-12 mt-2">
                                <input type="tel" name="donation-phone" id="donation-phone" class="form-control" placeholder="Your Phone Number" required>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input type="text" name="donation-address" id="donation-address" class="form-control" placeholder="Your Address" required>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <input type="email" name="donation-email" id="donation-email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="col-lg-12 col-12 mt-4">
                                <button type="button" class="btn" onclick="nextPage(2)">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Page 2: Cycle Details -->
    <main style="display:none;">
        <section class="donate-section">
            <div class="container">
                <div class="col-lg-6 col-12 mx-auto">
                    <div class="custom-form donate-form" action="#" method="post" role="form">
                        <h3>Make a donation</h3>
    
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h5>Cycle Details</h5>
                            </div>
                            <!-- Cycle Details Fields -->
                            <div class="col-lg-12 col-12 mt-4">
                                <h5>Type of Cycle</h5>
                                <!-- Type of Cycle Select -->
                                <select class="form-select" aria-label="Select Type of Cycle">
                                    <option selected>Select</option>
                                    <option value="road">Road Bike</option>
                                    <option value="mountain">Mountain Bike</option>
                                    <option value="hybrid">Hybrid Bike</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-12 mt-4">
                                <h5>Condition of Cycle</h5>
                                <!-- Condition of Cycle Checkboxes -->
                                <div class="form-check">
                                    <input class="form-check-input" name="donation-condition[]" type="checkbox" value="Good Condition" id="good-condition">
                                    <label class="form-check-label" for="good-condition">
                                        Good Condition
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="donation-condition[]" type="checkbox" value="Needs Repair" id="needs-repair">
                                    <label class="form-check-label" for="needs-repair">
                                        Needs Repair
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mt-4">
                                <button type="button" class="btn" onclick="previousPage(1)">Previous</button>
                                <button type="button" class="btn" onclick="nextPage(3)">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Page 3: Repair Options -->
    <main style="display:none;">
        <section class="donate-section">
            <div class="container">
                <div class="col-lg-6 col-12 mx-auto">
                    <div class="custom-form donate-form" action="#" method="post" role="form">
                        <h3>Make a donation</h3>
    
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h5>Repair Options</h5>
                            </div>
                            <!-- Repair Options -->
                            <div class="col-lg-12 col-12 mt-4">
                                <h5>Repair Needed</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="needs-repair" value="Accessories Repair" name="repair-options[]">
                                    <label class="form-check-label" for="needs-repair">
                                        Accessories Repair
                                    </label>
                                </div>
                                <!-- Additional Repair Options -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tire-repair" value="Tire Repair" name="repair-options[]">
                                    <label class="form-check-label" for="tire-repair">
                                        Tire Repair
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="brake-repair" value="Brake Repair" name="repair-options[]">
                                    <label class="form-check-label" for="brake-repair">
                                        Brake Repair
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gear-repair" value="Gear Repair" name="repair-options[]">
                                    <label class="form-check-label" for="gear-repair">
                                        Gear Repair
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="frame-repair" value="Frame Repair" name="repair-options[]">
                                    <label class="form-check-label" for="frame-repair">
                                        Frame Repair
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="chain-repair" value="Chain Repair" name="repair-options[]">
                                    <label class="form-check-label" for="chain-repair">
                                        Chain Repair
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mt-4">
                                <button type="button" class="btn" onclick="previousPage(2)">Previous</button>
                                <button type="button" class="btn" onclick="nextPage(4)">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Page 4: Donation Type -->
    <main style="display:none;">
        <section class="donate-section">
            <div class="container">
                <div class="col-lg-6 col-12 mx-auto">
                    <div class="custom-form donate-form" action="#" method="post" role="form">
                        <h3>Make a donation</h3>
    
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h5>Donation Type</h5>
                            </div>
                            <!-- Donation Type Options -->
                            <div class="col-lg-12 col-12 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="donation-type" value="full cycle" id="full-cycle" checked>
                                    <label class="form-check-label" for="full-cycle">
                                        Full Cycle
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="donation-type" value="cycle parts" id="cycle-parts">
                                    <label class="form-check-label" for="cycle-parts">
                                        Cycle Parts
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mt-4">
                                <button type="button" class="btn" onclick="previousPage(3)">Previous</button>
                                <button type="button" class="btn" onclick="nextPage(5)">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Page 5: Payment -->
    <main style="display:none;">
        <section class="donate-section">
            <div class="container">
                <div class="col-lg-6 col-12 mx-auto">
                    <div class="custom-form donate-form">
                        <h3>Make a donation</h3>
    
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h5>Cycle Delivery Options</h5>
                            </div>
                            
                            <div class="col-lg-12 col-12 mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="donation-payment" value="Voluntary handover at NGO" id="credit-card" checked>
                                    <label class="form-check-label" for="credit-card">
                                        Voluntary handover at NGO
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="donation-payment" value="Schedule pickup arrangement" id="paypal">
                                    <label class="form-check-label" for="paypal">
                                        Schedule pickup arrangement
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mt-4">
                                <button type="button" class="btn" onclick="previousPage(4)">Previous</button>
                                <button type="submit" class="btn">Submit Donation</button>
                            </div>
                        </div>
        </div>
                </div>
            </div>
        </section>
    </main>
        </form>
    
    <script>
        let currentPage = 1;
    
        function nextPage(pageNumber) {
            document.querySelectorAll('main')[currentPage - 1].style.display = 'none';
            document.querySelectorAll('main')[pageNumber - 1].style.display = 'block';
            currentPage = pageNumber;
        }
    
        function previousPage(pageNumber) {
            document.querySelectorAll('main')[currentPage - 1].style.display = 'none';
            document.querySelectorAll('main')[pageNumber - 1].style.display = 'block';
            currentPage = pageNumber;
        }
    </script>
    
        

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 mb-4">
                        <img src="images/logo.png" class="logo img-fluid" alt="">
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <h5 class="site-footer-title mb-3">Quick Links</h5>

                        <ul class="footer-menu">
                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Our Story</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Newsroom</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">About Us</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Become a volunteer</a></li>

                            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Event details</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12 mx-auto">
                        <h5 class="site-footer-title mb-3">Contact Infomation</h5>

                        <p class="text-white d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            <a href="tel: 120-240-9600" class="site-footer-link">
                                120-240-9600
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:donate@charity.org" class="site-footer-link">
                                cyclerevive@company.com
                            </a>
                        </p>

                        <p class="text-white d-flex mt-3">
                            <i class="bi-geo-alt me-2"></i>
                            Mumbai,India
                        </p>

                        <a href="#" class="custom-btn btn mt-3">Get Direction</a>
                    </div>
                </div>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-md-7 col-12">
                            <p class="copyright-text mb-0">Copyright © 2024 cyclerevive <a href="#">Cycle</a>Revive
                        	Design: <a href="https://templatemo.com" target="_blank">Bhakti Lahane,Suyog Mundhe,Ninad Marathe</a></p>
                        </div>
                        
                        <div class="col-lg-6 col-md-5 col-12 d-flex justify-content-center align-items-center mx-auto">
                            <ul class="social-icon">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-facebook"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-linkedin"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="https://youtube.com/templatemo" class="social-icon-link bi-youtube"></a>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/counter.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>