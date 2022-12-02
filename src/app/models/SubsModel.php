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
        $query = "UPDATE subscription SET status = '$status' WHERE creator_id = :creator_id AND subscriber_id = :subscriber_id";
        $this->database->query($query);
        $this->database->bind('creator_id', $creator_id);
        $this->database->bind('subscriber_id', $subscriber_id);
        $this->database->execute();
        return 'Submission Updated';
    }

    public function getSubsFromID($subscriber_id)
    {
        $query = 'SELECT subscriber_id, creator_id, creator_name, status FROM subscription WHERE subscriber_id = :subscriber_id';
        $this->database->query($query);
        $this->database->bind('subscriber_id', $subscriber_id);
        return $this->database->fetchAll();
    }
}
