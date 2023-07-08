<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faxNumber = $_POST["fax_number"];
    $faxFile = $_FILES["fax_file"]["tmp_name"];
    
    // Set Asterisk REST API credentials
    $username = 'your_username';
    $password = 'your_password';
    
    // Set Asterisk server details
    $asteriskIP = 'your_asterisk_ip';
    $asteriskPort = 'your_asterisk_port';
    
    // Build the URL for the Asterisk REST API
    $url = "http://{$asteriskIP}:{$asteriskPort}/ari/channels";
    
    // Create a new channel for fax transmission
    $channelData = array(
        "endpoint" => "PJSIP/{$faxNumber}",
        "extension" => "fax",
        "context" => "your_context",
        "priority" => 1,
        "app" => "sendfax",
        "appArgs" => "local/{$faxFile} tiff"
    );
    
    $jsonChannelData = json_encode($channelData);
    
    $curl = curl_init($url);
    
    curl_setopt($curl, CURLOPT_USERPWD, "{$username}:{$password}");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonChannelData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);
    
    if ($httpCode == 201) {
        // Fax submission successful
        echo "Fax sent successfully!";
    } else {
        // Fax submission failed
        echo "Failed to send fax.";
    }
}
?>
