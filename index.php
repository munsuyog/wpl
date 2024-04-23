<?php
// Start session
session_start();

// Check if user is logged in
$loggedIn = isset($_SESSION['user_id']);
$user ='';

// Function to display navbar
function displayNavbar($loggedIn) {
    // Display common navbar items
    // Example: Home, About, Contact, etc.

    // Display donate button if logged in
    if ($loggedIn) {
        echo '<li class="nav-item">
        <a class="nav-link click-scroll" href="donate.php">Donate</a>
    </li>';
    }
}

function displayBtn($loggedIn) {
    if($loggedIn) {
        echo '<form method="post" style="display: inline;">
        <button type="submit" name="logoutBtn" class="btn custom-btn custom-border-btn" role="button" aria-controls="offcanvasExample">Logout</button>
    </form>';
    }
    else {
        echo '<a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Member Login</a>';
    }
}
?>

<?php
// Include the connection file
include 'php/connection.php';

// Include the functions file
include 'php/functions.php';
// Initialize variables
$username = $email = $password = '';
$username_err = $email_err = $password_err = '';

// Check if the form is submitted for user registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['member-signup-username'], $_POST['member-signup-email'], $_POST['member-signup-password'])) {
    // Retrieve data from the form
    $username = $_POST['member-signup-username'];
    $email = $_POST['member-signup-email'];
    $password = $_POST['member-signup-password'];

    // Call the registerUser function
    if (registerUser($username, $email, $password)) {
        $loggedIn = true;
    } else {
        echo "Registration failed."; // Display error message
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['member-login-email'], $_POST['member-login-password'])) {
    // Retrieve data from the form
    $email = $_POST['member-login-email'];
    $password = $_POST['member-login-password'];

    // Call the loginUser function
    if (loginUser($email, $password)) {
        $loggedIn = true;
        $user = $email;
    } else {
        echo "Login failed. Please check your email and password."; // Display error message
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['full-name'], $_POST['email'],$_POST['phone'],$_POST['address'] )) {
    // Retrieve form data
    $fullName = $_POST['full-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    // You may handle CV upload separately and store the file path in the database

    // Call the function to store membership data
    $result = storeMembershipFormData($fullName, $email, $phone, $address);

    // Provide feedback to the user
    if ($result === true) {
        echo "Membership form submitted successfully.";
    } else {
        echo "Error: Unable to submit membership form.";
    }
}

// Function to store membership form data
function storeMembershipFormData($fullName, $email, $phone, $address) {
    global $db; // Access the database connection

    // Prepare SQL statement to insert form data into database
    $sql = "INSERT INTO membership (full_name, email, phone, address) VALUES (:fullName, :email, :phone, :address)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':fullName', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);

    // Execute the statement
    try {
        $stmt->execute();
        return true; // Form data stored successfully
    } catch (PDOException $e) {
        // Handle database error
        error_log("Error storing membership form data: " . $e->getMessage());
        return false; // Form data storage failed
    }
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['full-name'], $_POST['email'], $_POST['message'])) {
    // Retrieve form data
    $fullName = $_POST['full-name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Call the storeContactFormData function
    $result = storeContactFormData($fullName, $email, $message);
    
    // Display result message
    echo $result;
}

if(isset($_POST['logoutBtn'])) {
    // Call the logout function
    logout();
}
?>




<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Cycle Revive</title>

        <!-- CSS FILES -->                
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-tiya-golf-club.css" rel="stylesheet">
        
    </head>
    
    <body>

        <main>

            <nav class="navbar navbar-expand-lg">                
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="index.html">
                        <img src="images/logo.png" class="navbar-brand-image img-fluid" alt="">
                        <span class="navbar-brand-text">
                            Cycle
                            <small>Revive</small>
                        </span>
                    </a>

                    <div class="d-lg-none ms-auto me-3">
                        <?php displayBtn($loggedIn); ?>
                    </div>
    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_1">Home</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_2">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_3">Volunteer</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_4">Events</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_5">Contact Us</a>
                            </li>

                            <?php displayNavbar($loggedIn); ?>

                            <li class="nav-item"><a class="nav-link click-scroll" href="event-listing.html">Past Event Listing</a></li>

<li class="nav-item"><a class="nav-link click-scroll" href="event-detail.html">Why Us?</a></li>
                            <?php
                            if($loggedIn) {
                                echo `<li class="nav-item"><a class="nav-link click-scroll" href="event-detail.html">$user</a></li>`;
                            }
                             ?>
                        </ul>

                        <div class="d-none d-lg-block ms-lg-3">
                            <?php displayBtn($loggedIn); ?>
                        </div>

                    </div>
                </div>
            </nav>

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">                
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Member Login</h5>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                
                <div class="offcanvas-body d-flex flex-column">
                    <form class="custom-form member-login-form login-form" style="display: block" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form">

                        <div class="member-login-form-body">
                            <div class="mb-4">
                                <label class="form-label mb-2" for="member-login-email">Email</label>

                                <input type="text" name="member-login-email" id="member-login-email" class="form-control" placeholder="email@domain.com" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label mb-2" for="member-login-password">Password</label>

                                <input type="password" name="member-login-password" id="member-login-password" pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Password" required="">
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                              
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>

                            <div class="col-lg-5 col-md-7 col-8 mx-auto">
                                <button type="submit" class="form-control" name="loginBtn">Login</button>
                            </div>
                            <div class="text-center my-4">
                                <a href="#" class="register-btn">Register</a>
                            </div>
                        </div>
                    </form>

                    <form class="custom-form member-login-form register-form hide" style="display: none !important" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form" >

<div class="member-signup-form-body">
    <div class="mb-4">
        <label class="form-label mb-2" for="member-signup-username">Username</label>

        <input type="text" name="member-signup-username" id="member-signup-username" class="form-control" placeholder="username" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="member-signup-email">Email</label>

        <input type="text" name="member-signup-email" id="member-signup-email" class="form-control" placeholder="email" required>
    </div>

    <div class="mb-4">
        <label class="form-label mb-2" for="member-signup-password">Password</label>

        <input type="password" name="member-signup-password" id="member-signup-password" pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Password" required="">
    </div>

    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
      
        <label class="form-check-label" for="flexCheckDefault">
            Remember me
        </label>
    </div>

    <div class="col-lg-5 col-md-7 col-8 mx-auto">
        <button type="submit" class="form-control">Register</button>
    </div>
</div>
</form>

                    <div class="mt-auto mb-5">
                        <p>
                            <strong class="text-white me-3">Any Questions?</strong>

                            <a href="tel: 010-020-0340" class="contact-link">
                            	010-020-0340
                            </a>
                        </p>
                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#3D405B" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            </div>
            

            <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

                <div class="section-overlay"></div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#3D405B" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path></svg>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                            <h2 class="text-white">Welcome to CycleRevive</h2>

                            <h1 class="cd-headline rotate-1 text-white mb-4 pb-2">
                                <span>Where Wheels Find</span>
                                <span class="cd-words-wrapper">
                                    <b class="is-visible">Purpose</b>
                                    <b>Generosity</b>
                                    <b>New Beginning</b>
                                </span>
                            </h1>

                            <div class="custom-btn-group">
                                <a href="#section_2" class="btn custom-btn smoothscroll me-3">Our Story</a>

                                <a href="#section_3" class="btn custom-btn smoothscroll">Become a member</a>
                            </div>
                        </div>

    

                    </div>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            </section>


            <section class="about-section section-padding" id="section_2">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">About CycleRevive</h2>
                        </div>

                        <div class="col-lg-12 col-12 me-auto mb-4 mb-lg-0">
                            <h3 class="mb-3">About CycleRevive</h3>

                            <p><strong>Since 2004</strong>CycleRevive is ranked #8 in the top 10 Non Government Organization in India</p>

                            <p>Cycle Revive is more than just a platform; it's a movement driven by a passionate commitment to sustainability, community empowerment, and positive environmental change. Our core mission revolves around breathing new life into discarded bicycles and promoting the benefits of sustainable transportation. At the heart of our endeavors lies a strong emphasis on donation initiatives, where we refurbish and donate bicycles to individuals and communities in need. Through these efforts, we aim to not only provide affordable and eco-friendly mobility solutions but also foster a sense of community well-being</p>
                        </div>
                    </div>
                </div>
            </section>


            <section class="section-bg-image">
                <svg viewBox="0 0 1265 144" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="rgba(255, 255, 255, 1)" d="M 0 40 C 164 40 164 20 328 20 L 328 20 L 328 0 L 0 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 327 20 C 445.5 20 445.5 89 564 89 L 564 89 L 564 0 L 327 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 563 89 C 724.5 89 724.5 48 886 48 L 886 48 L 886 0 L 563 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 885 48 C 1006.5 48 1006.5 67 1128 67 L 1128 67 L 1128 0 L 885 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 1127 67 C 1196 67 1196 0 1265 0 L 1265 0 L 1265 0 L 1127 0 Z" stroke-width="0"></path></svg>

                <div class="container">
                    <div class="row">

                        <div class="col-lg-6 col-12">
                            <div class="section-bg-image-block">
                                <h2 class="mb-lg-3">Get our newsletter</h2>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor ut labore et dolore.</p>

                                <form action="#" method="get" class="custom-form mt-lg-4 mt-2" role="form">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bi-envelope" id="basic-addon1"></span>

                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">

                                        <button type="submit" class="form-control">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <svg viewBox="0 0 1265 144" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="rgba(255, 255, 255, 1)" d="M 0 40 C 164 40 164 20 328 20 L 328 20 L 328 0 L 0 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 327 20 C 445.5 20 445.5 89 564 89 L 564 89 L 564 0 L 327 0 Z" stroke-width="0"></path> <path fill="rgba(255, 255, 255, 1)" d="M 563 89 C 724.5 89 724.5 48 886 48 L 886 48 L 886 0 L 563 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 885 48 C 1006.5 48 1006.5 67 1128 67 L 1128 67 L 1128 0 L 885 0 Z" stroke-width="0"></path><path fill="rgba(255, 255, 255, 1)" d="M 1127 67 C 1196 67 1196 0 1265 0 L 1265 0 L 1265 0 L 1127 0 Z" stroke-width="0"></path></svg>
            </section>


            <section class="membership-section section-padding" id="section_3">
                <div class="container">
                    <div class="row">
            
                        <div class="col-lg-12 col-12 mx-auto mb-lg-5 mb-4">
                            <div class="text-center">
                                <h2><span>Volunteer</span> at CycleRevive</h2>
                            </div>
            
                            <div class="col-lg-10 col-12 mx-auto">
                                <h4 style="text-align:center" class="mb-4 pb-lg-2">Please join us!</h4>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="custom-form membership-form shadow-lg" role="form">
                                    <h4 class="text-white mb-4">Become our part today!</h4>
                                
                                    <div class="form-floating">
                                        <input type="text" name="full-name" id="full-name" class="form-control" placeholder="Full Name" required="">
                                        <label for="full-name">Full Name</label>
                                    </div>
                                
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">
                                        <label for="email">Email address</label>
                                    </div>
                                
                                    <div class="form-floating">
                                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone number" required="">
                                        <label for="phone">Phone number</label>
                                    </div>
            
                                    <div class="form-floating">
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Address" required="">
                                        <label for="address">Address</label>
                                    </div>
                                
                                
                                    <button type="submit" class="form-control">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            

            <section class="events-section section-bg section-padding" id="section_4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h2 class="mb-lg-3">Upcoming Events</h2>
                        </div>

                        <div class="row custom-block mb-3">
                            <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">
                                <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">
                                    <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">24</h6>
                                    
                                    <strong class="text-white">May 2024</strong>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">
                                <div class="custom-block-image-wrap">
                                    <a href="event-detail.html">
                                        <img src="images\privateevent.jpeg" class="custom-block-image img-fluid" alt="">

                                        <i class="custom-block-icon bi-link"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 order-3 order-lg-0">
                                <div class="custom-block-info mt-2 mt-lg-0">
                                    <a href="event-detail.html" class="events-title mb-3">Private activities</a>

                                    <p class="mb-0">
"Engage in private fundraisers or events to collect donations for cycling initiatives and equipment."</p>

                                    <div class="d-flex flex-wrap border-top mt-4 pt-3">

                                        <div class="mb-4 mb-lg-0">
                                            <div class="d-flex flex-wrap align-items-center mb-1">
                                                <span class="custom-block-span">Location:</span>

                                                <p class="mb-0">Sambhaji Ground,Mulund</p>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row custom-block custom-block-bg">
                            <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">
                                <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">
                                    <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">28</h6>
                                    
                                    <strong class="text-white">June 2024</strong>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">
                                <div class="custom-block-image-wrap">
                                    <a href="event-detail.html">
                                        <img src="images\groupevent.jpg" class="custom-block-image img-fluid" alt="">

                                        <i class="custom-block-icon bi-link"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 order-3 order-lg-0">
                                <div class="custom-block-info mt-2 mt-lg-0">
                                    <a href="event-detail.html" class="events-title mb-3">Group tournament activities</a>

                                    <p class="mb-0">"Organize group tournaments for competitive sports or gaming events, fostering teamwork and camaraderie among participants."</p>

                                    <div class="d-flex flex-wrap border-top mt-4 pt-3">

                                        <div class="mb-4 mb-lg-0">
                                            <div class="d-flex flex-wrap align-items-center mb-1">
                                                <span class="custom-block-span">Location:</span>

                                                <p class="mb-0">Somaiya University,Vidyavihar</p>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="contact-section section-padding" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-5 col-12">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="custom-form contact-form" role="form">
                                <h2 class="mb-4 pb-2">Contact CycleRevive</h2>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-floating">
                                            <input type="text" name="full-name" id="full-name" class="form-control" placeholder="Full Name" required="">
                                            
                                            <label for="floatingInput">Full Name</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12"> 
                                        <div class="form-floating">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">
                                            
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="message" name="message" placeholder="Describe message here"></textarea>
                                            
                                            <label for="floatingTextarea">Message</label>
                                        </div>

                                        <button type="submit" class="form-control">Submit Form</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="contact-info mt-5">
                                <div class="contact-info-item">
                                    <div class="contact-info-body">
                                        <strong>Mumbai, India</strong>

                                        <p class="mt-2 mb-1">
                                            <a href="tel: 010-020-0340" class="contact-link">
                                                (+91) 
                                                877-621-0100
                                            </a>
                                        </p>

                                        <p class="mb-0">
                                            <a href="mailto:info@company.com" class="contact-link">
                                                cyclerevive@company.com
                                            </a>
                                        </p>
                                    </div>

                                    <div class="contact-info-footer">
                                        <a href="#">Directions</a>
                                    </div>
                                </div>

                                <img src="images/WorldMap.svg" class="img-fluid" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 me-auto mb-5 mb-lg-0">
                        <a class="navbar-brand d-flex align-items-center" href="index.html">
                            <img src="images/logo.png" class="navbar-brand-image img-fluid" alt="">
                            <span class="navbar-brand-text">
                                Cycle
                                <small>Revive</small>
                            </span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-12">
                        <h5 class="site-footer-title mb-4">Join Us</h5>

                        <p class="d-flex border-bottom pb-3 mb-3 me-lg-3">
                            <span>Mon-Fri</span>
                            10:00 AM - 9:00 PM
                        </p>

                        <p class="d-flex me-lg-3">
                            <span>Sat-Sun</span>
                            12:30 AM - 9:30 PM
                        </p>
                        <br>
                        <p class="copyright-text">Copyright © 2024 CycleRevive</p>
                    </div>

                        <div class="col-lg-2 col-12 ms-auto">
                            <ul class="social-icon mt-lg-5 mt-3 mb-4">
                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-instagram"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-twitter"></a>
                                </li>

                                <li class="social-icon-item">
                                    <a href="#" class="social-icon-link bi-whatsapp"></a>
                                </li>
                            </ul>
                            <p class="copyright-text">Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">Bhakti Lahane,Suyog Mundhe,Ninad Marathe</a></p>
                            
                        </div>

                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#81B29A" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
        </footer>


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/animated-headline.js"></script>
        <script src="js/modernizr.js"></script>
        <script src="js/custom.js"></script>
        <script>
        // Function to switch between login and register forms
        function showRegisterForm() {
            document.querySelector('.login-form').style.display = 'none';
            document.querySelector('.register-form').style.display = 'block';
        }

        // Function to switch between register and login forms
        function showLoginForm() {
            document.querySelector('.register-form').style.display = 'none';
            document.querySelector('.login-form').style.display = 'block';
        }

        // Event listener to show register form when "Register" link is clicked
        document.querySelector('.register-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            showRegisterForm(); // Call function to show register form
        });
    </script>

    </body>
</html>