<?php

class PostReply {

    private $id, $authorID, $datetime;
    public $title, $body;

    public function __construct() {}

    public function __toString() {
        return $this->id;
    }

    public function FillObject($row, $object) {
        $object->setID($row['ReplyID']);
        $object->body = $row['ReplyBody'];
        $object->authorID = $row['ReplyAuthorID'];
        if($row['UserName']) {
            $object->author = new User;
            $object->author->FillObject($row, $object->author);
        }
        $object->datetime = $row['ReplyDateTime'];
        return $object;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getID() {
        return $this->id;
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
        $stmt = $db->prepare("SELECT fp.*, u.* FROM forum_posts fp, members m WHERE fp.ForumID = :forumID AND u.UserID = fp.PostAuthorID ORDER BY fp.PostDateTime DESC");
        $stmt->bindParam(':forumID', $forumID);
        $stmt->execute();
        $posts = array();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $post = new Post;
            $post->FillObject($row, $post);
            array_push($posts, $post);
        }
        return $posts;
    }

    public static function FindRepliesByPostID($postID) {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("SELECT fr.*, u.* FROM forum_replies fr, users u WHERE fr.PostID = :postID AND u.UserID = fr.ReplyAuthorID GROUP BY fr.ReplyID");
        $stmt->bindParam(':postID', $postID);
        $stmt->execute();
        $replies = array();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $reply = new PostReply;
                $reply->FillObject($row, $reply);
                array_push($replies, $reply);
            }
        }
        return $replies;
    }

    public function create($postID) {
      if($this->author) {
          $db = DatabasePDO::start();
          $stmt = $db->prepare("INSERT INTO forum_replies (PostID, ReplyBody, ReplyAuthorID, ReplyDateTime) VALUES "
                  . "(:postID, :body, :authorID, NOW())");
          $stmt->bindParam(':postID', $postID);
          $stmt->bindParam(':body', $this->body);
          $stmt->bindValue(':authorID', $this->author->id);
          $stmt->execute();
          $this->setID($db->lastInsertId());
          $post = Post::FindById($postID);
          $post->UpdateLastEdit();
          return $this;
      }
    }
}

?>
