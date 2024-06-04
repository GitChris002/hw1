<?php

session_start();


if(!isset($_SESSION['username'])) {
    echo json_encode(["error" => "Not authenticated"]);
    exit;
}

header('Content-Type: application/json');

$content = [
    "specialOffers" => [
        "title" => "Offerte speciali questo mese",
        "offers" => [
            "Abbonamento standard: 30,90€/mese",
            "Abbonamento flex: 40,90€/mese",
            "Sconto del 10% se porti un amico"
        ]
    ],
   
];

echo json_encode($content);
?>