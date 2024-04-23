<?php
include 'connection.php';

function registerUser($username, $email, $password) {
    global $db;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    try {
        $stmt->execute();
        setcookie("email", $email, time() + (86400 * 30), "/");
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
function logout() {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit();
}


function loginUser($email, $password) {
    global $db; 
    $sql = "SELECT id, username, email, password FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);

    try {
        session_destroy();
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                session_start();

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                setcookie("email", $row['username'], time() + (86400 * 30), "/");

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return false;
    }
}
function createDonationsTable() {
    global $db;
    $sql = "CREATE TABLE IF NOT EXISTS donations (
        id SERIAL PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        cycle_type VARCHAR(50),
        condition VARCHAR(50),
        repair_options TEXT,
        donation_type VARCHAR(50) NOT NULL,
        payment_option VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

// Function to store donation form data
function storeDonationFormData($name, $phone, $address, $email, $cycleType, $condition, $repairOptions, $donationType, $paymentOption) {
    global $db;
        $sql = "INSERT INTO donations (name, phone, address, email, cycle_type, condition, repair_options, donation_type, payment_option) VALUES (:name, :phone, :address, :email, :cycleType, :condition, :repairOptions, :donationType, :paymentOption)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cycleType', $cycleType);
        $stmt->bindParam(':condition', $condition);
        $stmt->bindParam(':repairOptions', $repairOptions);
        $stmt->bindParam(':donationType', $donationType);
        $stmt->bindParam(':paymentOption', $paymentOption);

        try {
            if ($stmt->execute()) {
            } else {
                return "Error storing form data.";
            }
        } catch (PDOException $e) {
            return "Error executing SQL statement: " . $e->getMessage();
        }
    }

function storeContactFormData($fullName, $email, $message) {
    global $db; 

    $sql = "INSERT INTO contact_forms (full_name, email, message, submission_time) VALUES (:fullName, :email, :message, NOW())";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':fullName', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);

    try {
        $stmt->execute();
        return "Form data stored successfully.";
    } catch (PDOException $e) {
        return "Error storing form data: " . $e->getMessage();
    }
}

?>
