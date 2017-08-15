<?php

class Forum {

    private $id;
    public $name, $description;

    public function __construct() {}

    public function __toString() {
        return $this->id;
    }

    public function FillObject($row, $object) {
        $object->setID($row['ForumID']);
        $object->name = $row['ForumName'];
        $object->description = $row['ForumDescription'];
        return $object;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getID() {
        return $this->id;
    }

    public static function FindAll() {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("SELECT f.*, COUNT(fp.PostID) as 'Posts' FROM forums f LEFT JOIN forum_posts fp ON fp.ForumID = f.ForumID GROUP BY f.ForumID");
        $stmt->execute();
        $forums = array();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $forum = new Forum;
                $forum->FillObject($row, $forum);
                $forum->posts = $row['Posts'];
                array_push($forums, $forum);
            }
        }
        return $forums;
    }

    public static function FindById($forumID) {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("SELECT * FROM forums WHERE ForumID = :forumID");
        $stmt->bindParam(':forumID', $forumID);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            $forum = new forum;
            $forum->FillObject($row, $forum);
            return $forum;
        }
        return false;
    }

    public function FindPosts() {
        return Post::FindByForumId($this->getID());
    }

    public static function FindActive($limit = 5) {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("SELECT fp.* FROM forum_posts fp LEFT JOIN forum_replies fr ON fp.PostID = fr.PostID GROUP BY fp.PostID ORDER BY fp.LastEditDateTime DESC, fp.PostDateTime DESC LIMIT ". $limit ."");
        $stmt->execute();
        $posts = array();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $post = new Post;
                $post->FillObject($row, $post);
                array_push($posts, $post);
            }
        }
        return $posts;
    }

    public function create() {
        $db = DatabasePDO::start();
        $stmt = $db->prepare("INSERT INTO forums (ForumName, ForumDescription) VALUES "
                . "(:name, :description)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->execute();
        $this->setID($db->lastInsertId());
        return $this;
    }
}

?>
