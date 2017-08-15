<?php
class Event extends Model {
  public $id, $name, $category, $description, $userID, $startDateTime, $endDateTime, $startText, $endText;

  public function FillObject($row) {
    parent::FillObject($row);
    $this->startText = dateToText($row['EventStartDateTime']);
    $this->endText = dateToText($row['EventEndDateTime']);
  }

  public static function FindFuture() {
    $db = DatabasePDO::start();
    $result = $db->prepare("SELECT * FROM events WHERE EventEndDateTime >= NOW() ORDER BY EventStartDateTime DESC");
    $result->execute();
    $events = array();
    if($result->rowCount() > 0) {
      while($row = $result->fetch()) {
        $event = new Event;
        $event->FillObject($row);
        array_push($events, $event);
      }
    }
    return $events;
  }

  public static function FindAll() {
    $db = DatabasePDO::start();
    $result = $db->prepare("SELECT * FROM events ORDER BY EventStartDateTime DESC");
    $result->execute();
    $events = array();
    if($result->rowCount() > 0) {
      while($row = $result->fetch()) {
        $event = new Event;
        $event->FillObject($row);
        array_push($events, $event);
      }
    }
    return $events;
  }

  public static function FindById($eventID) {
    $db = DatabasePDO::start();
    $result = $db->prepare("SELECT * FROM events WHERE EventID = :eventID");
    $result->bindParam(":eventID", $eventID);
    $result->execute();
    if($result->rowCount() == 1) {
      $row = $result->fetch();
      $event = new Event;
      $event->FillObject($row);
      $event->attending = Attendance::FindByEventId($eventID);
      return $event;
    }
    return false;
  }

  public function create($userID) {
    if($this->name && $this->category && $this->startDateTime && $this->endDateTime) {
      $db = DatabasePDO::start();
      $result = $db->prepare("INSERT INTO events (EventName, EventCategory, EventAuthorID, EventStartDateTime, EventEndDateTime, EventDescription) VALUES (:name, :category, :userID, :start, :end, :description)");
      $result->bindParam(":name", $this->name);
      $result->bindParam(":category", $this->category);
      $result->bindParam(":userID", $userID);
      $result->bindParam(":start", $this->startDateTime);
      $result->bindParam(":end", $this->endDateTime);
      $result->bindParam(":description", $this->description);
      $result->execute();
      $this->id = $db->lastInsertId();
      return $this;
    }
  }

}
