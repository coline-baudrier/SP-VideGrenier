<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userId = $_POST['user_id'] ?? 'not set';
        $subject = $_POST['subject'] ?? 'not set';
        $message = $_POST['message'] ?? 'not set';


        $logContent = "Date: " . date('Y-m-d H:i:s') . " | ";
        $logContent .= "User ID: $userId | ";
        $logContent .= "Subject: $subject | ";
        $logContent .= "Message: $message\n";


        $logPath = __DIR__ . '/../../logs/messages.log';
        if (!error_log($logContent, 3, $logPath)) {
            $response = ['status' => 'error', 'message' => 'Erreur lors de l\'enregistrement du message.'];
        } else {
            $response = ['status' => 'success', 'message' => 'Message enregistré avec succès.'];
        }


        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Méthode de requête invalide.']);
    }
