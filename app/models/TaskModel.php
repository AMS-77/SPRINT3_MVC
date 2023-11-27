<?php

require_once 'Task.php';

class TaskModel {

//Attributes
private array $tasksArray;
private $jsonDB;

//Constructor
public function __construct(){
    $this->jsonDB = __DIR__ . "/database/db.json";
    $this->takeJsonDbAndDecode();
}

//Method to take the json file data base and decode it into an array for PHP usage. Initialize it on the constructor.
public function takeJsonDbAndDecode(){
    if(file_exists($this->jsonDB)){
        $jsonContent = file_get_contents($this->jsonDB);
        $this->tasksArray = json_decode($jsonContent, true);
    } else {
        $this->tasksArray = [];
    }
}

/* private function readData(){
    $tasksData = file_get_contents($this->jsonDB);
    return $dataReaded = json_decode($tasksData, true);
} */

public function getId($taskId){
    foreach($this->tasksArray as $task){
        if($task['id'] == $taskId){
            return $task;
        }
    }
    return null;
}

public function getAllTasks(){
    return $this->tasksArray;
}

private function saveTasks(){
    $result = file_put_contents($this->jsonDB, json_encode($this->tasksArray, JSON_PRETTY_PRINT));

    if($result == false){
        exit("Failed to save new task on the JSON database");
    }
}

public function createTask($title, $username, $description,$taskStatus, $startDate, $endDate){
    $id = uniqid(); //unique ID generator
    //Create a new task with the given info from the basic class, add the task to the array and save it there.
    $newtask =
    [
        'id' => $id,
        'title' => $title,
        'userName' => $username,
        'description' => $description,
        'taskStatus' => $taskStatus,
        'startdate' => $startDate,
        'enddate' => $endDate,        
    ];

    $this->tasksArray[] = $newtask;
    $this->saveTasks($newtask);
}

public function deleteTask($id){

    // Vamos a iterar sobre el array de tareas
    foreach ($this->tasksArray as $i => $task) {
        
        if ($task['id'] == $id) {
            // Si lo encontramos se elimina la tarea
            unset($this->tasksArray[$i]);
            // Una vez eliminada salimos del bucle
            break;
        }
    }   
}

public function updateTask($id, $title, $username, $description,$taskStatus, $startDate, $endDate){
    
    // Vamos a iterar sobre el array de tareas
    foreach ($this->tasksArray as $i=>$task) {
        if ($task['id'] == $id) {
            //Hacemos una copia de la tarea y actualizamos sobre ella
            $copyTask = $task;

            $copyTask['title'] = $title;
            $copyTask['userName'] = $username;
            $copyTask['description'] = $description;
            $copyTask['taskStatus'] = $taskStatus;
            $copyTask['startdate'] = $startDate;
            $copyTask['enddate'] = $endDate; 

            //Introducimos la copia actualizada al array, indicando el indice ($i)
            $this->tasksArray[$i] = $copyTask;

            //Guardamos los cambios en caso de haberse encontrado la tarea
            $this->saveTasks();

            //Salimos del bucle si ya la ha encontrado,  para que no siga iterando
            break;
        }    
    }

}

}


?>