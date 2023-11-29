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


}