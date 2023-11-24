<?php

require_once 'TaskStatus.php';

class Task{

//Attributes
private int $id;
private string $title;
private string $userName;
private string $description;
private TaskStatus $taskStatus;
private DateTime $startDate;
private DateTime $endDate;

//Constructor
public function __construct(string $title, string $userName, string $description, TaskStatus $taskStatus, DateTime $startDate, DateTime $endDate){
$this->id = uniqid(); //Generate an unique ID with this native function. Is like the id: uuidv4() on JS. 
$this->title = $title;
$this->userName = $userName;
$this->description = $description;
$this->taskStatus = $taskStatus;
$this->startDate = $startDate;
$this->endDate = $endDate;
    
}

//Getters PS: We don't need all these methods. Leave them here for now.
public function getId(){
    return $this->id;
}

public function getTitle(){
    return $this->title;
}

public function getUserName(){
    return $this->userName;
}

public function getDescription(){
    return $this->description;
}

public function getTaskStatus(){
    return $this->taskStatus;
}

public function getStartDate(){
    return $this->startDate;
}

public function getEndDate(){
    return $this->endDate;
}

//Setters PS: We don't need all these methods. Leave them here for now.

public function setTitle($title){
    $this->title = $title;
}

public function setDescription($description){
    $this->description = $description;
}

public function setTaskStatus($taskStatus){
    $this->taskStatus = $taskStatus;
}

public function setStartDate($startDate){
    $this->startDate = $startDate;
}

public function setEndDate($endDate){
    $this->endDate = $endDate;
}



}