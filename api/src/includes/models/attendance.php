<?php
class Attendance extends Model {
  public $userID, $eventID, $status, $statusText, $datetime, $user;

  public function FillObject($row) {
    parent::FillObject($row);
    $this->userID = $row['UserID'];
    $this->eventID = $row['EventID'];
    $this->status = $row['AttendanceStatus'];
    switch($this->status) {
      case "0":
      default:
        $this->statusText = "Not attending";
        break;
      case "1":
        $this->statusText = "Maybe";
        break;
      case "9":
        $this->statusText = "Attending";
        break;
    }
    $this->datetime = $row['AttendanceDateTime'];
    if($row['UserName']) {
      $this->user = new User;
      $this->user->FillObject($row);
    }
  }

  public static function FindByEventID($eventID) {
    $db = DatabasePDO::start();
    $result = $db->prepare("SELECT ea.*, u.* FROM event_attendance ea, users u WHERE EventID = :eventID AND u.UserID = ea.UserID ORDER BY AttendanceStatus DESC, AttendanceDateTime DESC");
    $result->bindParam(":eventID", $eventID);
    $result->execute();
    $attending = array();
    if($result->rowCount() > 0) {
      while($row = $result->fetch()) {
        $attendance = new Attendance;
        $attendance->FillObject($row);
        array_push($attending, $attendance);
      }
    }
    return $attending;
  }

  public static function FindByEventAndUserID($eventID, $userID) {
    $db = DatabasePDO::start();
    $result = $db->prepare("SELECT * FROM event_attendance WHERE UserID = :userID AND EventID = :eventID");
    $result->bindParam(":eventID", $eventID);
    $result->bindParam(":userID", $userID);
    $result->execute();
    if($result->rowCount() == 1) {
      $row = $result->fetch();
      $attendance = new Attendance;
      $attendance->FillObject($row);
      return $attendance;
    }
    return false;
  }

  public function update() {
    // TODO - ON DUPLICATE KEY part doesn't work.
    $db = DatabasePDO::start();
    $result = $db->prepare("INSERT IGNORE INTO event_attendance (UserID, EventID, AttendanceStatus, AttendanceDateTime) VALUES (:userID, :eventID, :status, NOW())
    ON DUPLICATE KEY UPDATE AttendanceStatus = :status AND AttendanceDateTime = NOW()");
    $result->bindParam(":userID", $this->userID);
    $result->bindParam(":eventID", $this->eventID);
    $result->bindParam(":status", $this->status);
    $result->execute();
  }
}
?>
