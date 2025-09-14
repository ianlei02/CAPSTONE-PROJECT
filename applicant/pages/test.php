<?php
// generate_psgc_offline.php

// Function to fetch a URL
function fetchUrl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $data = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
        throw new Exception("Curl error fetching $url: $err");
    }
    return $data;
}

$urls = [
    "regions"   => "https://psgc.cloud/api/v2/regions",
    "provinces" => "https://psgc.cloud/api/v2/provinces",
    "cities"    => "https://psgc.cloud/api/v2/cities-municipalities",
    "barangays" => "https://psgc.rootscratch.com/barangay"
];

$all = [];
foreach ($urls as $key => $url) {
    echo "Fetching $key...\n";
    $response = fetchUrl($url);
    $decoded = json_decode($response, true);
    if ($decoded === null) {
        throw new Exception("Failed to decode JSON for $key");
    }
    $all[$key] = $decoded;
}

// Save to offline file
$offlineFile = __DIR__ . "/psgc_offline_full(2).json";
file_put_contents($offlineFile, json_encode($all, JSON_PRETTY_PRINT));

echo "Offline PSGC data saved to $offlineFile\n";
