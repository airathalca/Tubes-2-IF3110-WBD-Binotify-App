<?php

class SubsModel
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function createSubs($creator_id, $subscriber_id, $creator_name)
    {
        $query = 'INSERT INTO subscription (creator_id, subscriber_id, creator_name) VALUES (:creator_id, :subscriber_id, :creator_name)';
        $this->database->query($query);
        $this->database->bind('creator_id', $creator_id);
        $this->database->bind('subscriber_id', $subscriber_id);
        $this->database->bind('creator_name', $creator_name);
        $this->database->execute();
    }

    public function updateSubs($creator_id, $subscriber_id, $status)
    {
        $query = 'SELECT status from subscription WHERE creator_id = :creator_id AND subscriber_id = :subscriber_id';
        $this->database->query($query);
        $this->database->bind('creator_id', $creator_id);
        $this->database->bind('subscriber_id', $subscriber_id);
        $stat = $this->database->fetch();
        if ($stat->status == 'ACCEPTED') {
            return 'Submission Already Accepted';
        }
        elseif ($stat->status == 'REJECTED') {
            return 'Submission Already Rejected';
        }
        $query = "UPDATE subscription SET status = '$status' WHERE creator_id = :creator_id AND subscriber_id = :subscriber_id";
        $this->database->query($query);
        $this->database->bind('creator_id', $creator_id);
        $this->database->bind('subscriber_id', $subscriber_id);
        $this->database->execute();
        return 'Submission Updated';
    }
}
