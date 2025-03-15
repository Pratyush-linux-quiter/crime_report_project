<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $crime_type = $_POST['crime_type'];
    $description = $_POST['description'];

    // Convert crime type to a short code
    $crime_codes = [
        "Cyber Crime" => "CYB",
        "Robbery" => "ROB",
        "Assault" => "ASS",
        "Fraud" => "FRD",
        "Other" => "OTH"
    ];

    $crime_prefix = isset($crime_codes[$crime_type]) ? $crime_codes[$crime_type] : "GEN";

    // Count existing users with the same crime prefix
    $result = $conn->query("SELECT COUNT(*) as count FROM users WHERE crime_type = '$crime_type'");
    $row = $result->fetch_assoc();
    $user_number = $row['count'] + 1;

    // Generate User ID (e.g., CYB001, ROB002)
    $user_id = $crime_prefix . str_pad($user_number, 3, '0', STR_PAD_LEFT);

    // Insert user into users table
    $sql_user = "INSERT INTO users (user_id, name, email, phone, crime_type) 
                 VALUES ('$user_id', '$name', '$email', '$phone', '$crime_type')";
    
    if ($conn->query($sql_user) === TRUE) {
        // Now insert the report using the generated user_id
        $sql_report = "INSERT INTO reports (user_id, name, email, phone, crime_type, description) 
                       VALUES ('$user_id', '$name', '$email', '$phone', '$crime_type', '$description')";
        
        if ($conn->query($sql_report) === TRUE) {
            echo "<script>alert('Crime report submitted successfully! Your User ID: $user_id'); window.location.href='index.html';</script>";
        } else {
            echo "Error inserting report: " . $conn->error;
        }
    } else {
        echo "Error inserting user: " . $conn->error;
    }

    $conn->close();
}
?>