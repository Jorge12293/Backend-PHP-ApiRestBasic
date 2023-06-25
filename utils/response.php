<?php

    function sendResponse($status, $message, $data = null) {
        $response = array(
            "status" => $status,
            "message" => $message,
            "data" => $data
        );
        header("Content-Type: application/json");
        http_response_code($status);
        echo json_encode($response);
        exit;
    }

    function sendError($status, $message) {
        sendResponse($status, $message);
    }

?>
