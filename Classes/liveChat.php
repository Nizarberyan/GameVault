<?php

require_once "./../config/Db.php";

class Chat
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Db::getInstance();
    }

    public function getAllMessages($game_id)
    {
        $messages = $this->pdo->prepare("SELECT message, full_name FROM live_chat 
                                        JOIN users ON users.user_id = live_chat.user_id 
                                        WHERE live_chat.game_id = ? 
                                        ORDER BY live_chat.created_at DESC LIMIT 20;");
        $messages->execute([$game_id]);
        echo json_encode($messages->fetchAll());
    }

    public function sendMessage($game_id, $message, $user_id)
    {
        $insert = $this->pdo->prepare("INSERT INTO live_chat (game_id, message, user_id) VALUES(?, ?, ?);");
        $insert->execute([
            $game_id,
            $message,
            $user_id
        ]);
    }
}

$chat = new Chat();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $chat->sendMessage($data['game_id'], $data['message'], $data['user_id']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $chat->getAllMessages($_GET['id']);
}
