<?php
class ToDo  //because the word "List" is already in use as far as php cares
{
    public $id;
    public $title;
    public $description;
    public $shareUUID;
    public $taskCount;
    public $created;
    public $updated;

    public function __construct($_title, $_description, $_id = null, $_shareUUID = null, $_taskCount = null, $_created = null, $_updated = null) {
        $this->id = $_id;
        $this->title = $_title;
        $this->description = $_description;
        $this->shareUUID = $_shareUUID;
        $this->taskCount = $_taskCount;
        $this->created = $_created;
        $this->updated = $_updated;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getShareUUID() {
        return $this->shareUUID;
    }

    public function getTaskCount() {
        return $this->taskCount;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getUpdated() {
        return $this->updated;
    }
}
