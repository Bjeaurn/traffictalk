<?php

class Post {

    private $id, $authorID, $datetime, $forumID;
    public $title, $body;

    public function __construct() {}

    public function __toString() {
        return $this->id;
    }

    public function FillObject($row, $object) {
        $object->setID($row['PostID']);
        $object->forumID = $row['ForumID'];
        $object->title = $row['PostTitle'];
        $object->body = $row['PostBody'];
        $object->authorID = $row['PostAuthorID'];
        if($row['UserName']) {
            $object->author = new User;
            $object->author->FillObject($row, $object->author);
        }
        $object->datetime = $row['PostDateTime'];
        return $object;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getID() {
        return $this->id;
    }

    public function getForumID() {
        return $this->forumID;
    }

    public function datetime() {
        return date("Y-m-d H:i", strtotime($this->datetime));
    }

    public static function FindById($postID) {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("SELECT fp.*, u.* FROM forum_posts fp, users u WHERE fp.PostID = :postID AND u.UserID = fp.PostAuthorID");
        $stmt->bindParam(':postID', $postID);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $post = new Post;
            $post->FillObject($row, $post);
            return $post;
        }
        return false;
    }

    public static function FindByForumId($forumID) {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("SELECT fp.*, u.* FROM forum_posts fp, users u WHERE fp.ForumID = :forumID AND u.UserID = fp.PostAuthorID GROUP BY fp.PostID ORDER BY fp.PostDateTime DESC");
        $stmt->bindParam(':forumID', $forumID);
        $stmt->execute();
        $posts = array();
        if ($stmt->rowCount() > 0) {
            while($row = $stmt->fetch()) {
                $post = new Post;
                $post->FillObject($row, $post);
                array_push($posts, $post);
            }
        }
        return $posts;
    }

    public function FindReplies() {
        return PostReply::FindRepliesByPostID($this->getID());
    }

    public function create($forumID) {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("INSERT INTO forum_posts (ForumID, PostTitle, PostBody, PostAuthorID, PostDateTime, LastEditDateTime) VALUES "
                . "(:forumID, :title, :body, :authorID, NOW(), NOW())");
        $stmt->bindParam(':forumID', $forumID);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindValue(':authorID', $this->author->id);
        $stmt->execute();
        $this->setID($db->lastInsertId());
        return $this;
    }

    public function UpdateLastEdit() {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("UPDATE forum_posts SET LastEditDateTime = NOW() WHERE PostID = :postID");
        $stmt->bindValue(':postID', $this->getID());
        $stmt->execute();
        $this->setID($db->lastInsertId());
        return true;
    }
}

?>
