<?php
// Function to generate the hash of the password
function generateHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Example usage
echo "Admin password hash: " . generateHash("adminpassword") . "\n";
echo "Seller password hash: " . generateHash("sellerpassword") . "\n";
echo "Customer password hash: " . generateHash("customerpassword") . "\n";
?>
