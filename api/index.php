<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $response = array(
        "message" => "Hello, World!"
    );

    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(array('error' => "Method Not Allowed"));
}