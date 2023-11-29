<?php

require_once 'Task.php';

class TaskModel {

    // Atributos
    private array $tasksArray;
    private $jsonDB;

    // Constructor
    public function __construct(){
        $this->jsonDB = __DIR__ . "/database/db.json";
        $this->takeJsonDbAndDecode();
    }

    // Método para tomar la base de datos en formato JSON y decodificarla en un array para su uso en PHP. Inicializado en el constructor.
    public function takeJsonDbAndDecode(){
        if(file_exists($this->jsonDB)){
            $jsonContent = file_get_contents($this->jsonDB);
            $this->tasksArray = json_decode($jsonContent, true);
        } else {
            $this->tasksArray = [];
        }
    }

    // Entrega el array de tareas al controlador.
    public function getAllTasks(){
        return $this->tasksArray;
    }

    // Guardar las tareas en el archivo JSON
    private function saveTasks(){
        $result = file_put_contents($this->jsonDB, json_encode($this->tasksArray, JSON_PRETTY_PRINT));
        if($result === false)
        {
        exit("Failed to save new task on the JSON database");
        }
    }

    // Crear una nueva tarea
    public function createTask ($title, $username, $description, $taskStatus, $startDate, $endDate){
        $id = uniqid(); // Generador de ID único, para que no se repita ninguna vez
        // Crear una nueva tarea con la información proporcionada, 
        // Agrega la tarea al array y la guarda en el Json a través de saveTasks
        $newTask = [
            'id' => $id,
            'title' => $title,
            'userName' => $username,
            'description' => $description,
            'taskStatus' => $taskStatus,
            'startDate' => $startDate,
            'endDate' => $endDate        
        ];

        $this->tasksArray[] = $newTask;
        $this->saveTasks();
    }

    // Eliminar una tarea por su ID
    public function deleteTask( $taskId){
        // Iterar sobre el array de tareas
        foreach ($this->tasksArray as $i => $task) {
            if ($task['id'] == $taskId) {
                // Si se encuentra, eliminar la tarea y salir del bucle
                unset($this->tasksArray[$i]);
                $this->saveTasks();
                break;
            }
        }   
    }

    // Actualizar una tarea por su ID con datos actualizados
    public function updateTask($taskId, $taskUpdate){   
        // Actualizar la tarea en el array
        foreach ($this->tasksArray as $i => $task) {
            if ($task['taskId'] == $taskId) {
                $this->tasksArray[$i] = $taskUpdate;
                break;
            }
        }
            // Guardar los cambios
            $this->saveTasks();
        
    }
}




?>