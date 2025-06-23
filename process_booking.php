<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $serviceType = htmlspecialchars($_POST['serviceType']);
    $frequency = htmlspecialchars($_POST['frequency']);
    $bedrooms = htmlspecialchars($_POST['bedrooms']);
    $bathrooms = htmlspecialchars($_POST['bathrooms']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $instructions = htmlspecialchars($_POST['instructions']);
    
    // Process checkboxes
    $extras = isset($_POST['extras']) ? $_POST['extras'] : [];
    $additionalServices = !empty($extras) ? implode(", ", $extras) : "None";
    
    // Email configuration
    $to = "bee.100.zw@gmail.com";
    $subject = "New Cleaning Service Booking";
    
    // Create email content
    $message = "You have received a new cleaning service booking:\n\n";
    $message .= "Full Name: $fullName\n";
    $message .= "Email: $email\n";
    $message .= "Phone: $phone\n";
    $message .= "Address: $address\n";
    $message .= "Service Type: $serviceType\n";
    $message .= "Frequency: $frequency\n";
    $message .= "Bedrooms: $bedrooms\n";
    $message .= "Bathrooms: $bathrooms\n";
    $message .= "Preferred Date: $date\n";
    $message .= "Preferred Time: $time\n";
    $message .= "Additional Services: $additionalServices\n";
    $message .= "Special Instructions:\n$instructions\n";
    
    // Email headers
    $headers = "From: CleanPro Booking System <noreply@cleanpro.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    if (mail($to, $subject, $message, $headers)) {
        // Redirect back to form with success message
        header('Location: index.html?status=success');
    } else {
        // Redirect back to form with error message
        header('Location: index.html?status=error');
    }
} else {
    // Redirect back if accessed directly
    header('Location: index.html');
}
?>