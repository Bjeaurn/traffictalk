<?php
class Chat extends Model {

    public $id, $userID, $body, $datetime, $textdate;

    public function FillObject($row) {
        parent::FillObject($row);
        $this->userID = $row['UserID'];
        if($row['UserName']) {
            $this->user = new User;
            $this->user->FillObject($row);
        }
        $this->datetime = $row['ChatDateTime'];
        $this->textdate = dateToText($this->datetime);
    }

    public static function getChat() {
        $db = DatabasePDO::start();
        $result = $db->prepare("SELECT c.*, u.* FROM chatbox c, users u WHERE u.UserID = c.UserID GROUP BY c.ChatID ORDER BY ChatDateTime DESC LIMIT 20");
        $result->execute();
        $chats = array();
        while($row = $result->fetch()) {
            $chat = new Chat;
            $chat->FillObject($row);
            array_push($chats, $chat);
        }
        return $chats;
    }

    public static function getFromDate($datetime) {
        $db = DatabasePDO::start();
        $result = $db->prepare("SELECT c.*, u.* FROM chatbox c, users u WHERE c.ChatDateTime >= :datetime AND u.UserID = c.UserID GROUP BY c.ChatID ORDER BY ChatDateTime DESC");
        $result->bindParam(":datetime", $datetime);
        $result->execute();
        $chats = array();
        while($row = $result->fetch()) {
            $chat = new Chat;
            $chat->FillObject($row);
            array_push($chats, $chat);
        }
        return $chats;
    }

    public function create($userID) {
        if($this->body) {
            $db = DatabasePDO::start();
            $result = $db->prepare("INSERT INTO chatbox (UserID, ChatBody, ChatDateTime) VALUES (:userID, :body, NOW())");
            $result->bindParam(":userID", $userID);
            $result->bindParam(":body", $this->body);
            $result->execute();
            return $db->lastInsertId();
        }
        return false;
    }
}
