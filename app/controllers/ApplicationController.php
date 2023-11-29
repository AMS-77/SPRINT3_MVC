<?php

/**
 * Controlador de la aplicación...
 */

class ApplicationController extends Controller {

    //Atributo.
    private $taskOrganizer;//eliminamos necesidad de crear una nueva instancia en cada metodo 

    //Constructor
    public function __construct(){
        $this->taskOrganizer = new TaskModel(); //se inicializa la instancia en el Constructor
    }

    public function indexAction(){
        //Este es el primer método del CRUD que se ejecuta en la vista principal, es la R.
        $tasks = $this->taskOrganizer->getAllTasks();
        //Gracias al array que hemos rescatado del modelo, se enseñará en la vista.
        $this->view->tasks = $tasks ;
    }

    public function createTaskAction(){
                
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Coge la información escrita en el formulario
            $title = $_POST['title'];
            $userName = $_POST['userName'];
            $description = $_POST['description'];
            $taskStatus = $_POST['taskStatus'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            //enviamos datos al modelo
            $this->taskOrganizer->createTask($title, $userName, $description, $taskStatus, $startDate, $endDate);
            //Regresa a la pantalla principal.
            header("Location: ../web/"); 
            exit;
        }
        
    }

    public function deleteTaskAction() {
        /*El ID de la tarea que eliminemos nos viene a través de la URL, por eso usamos
       la variable superglobal $_GET */
        $taskId = $_GET['taskId'];
        
        // Enviamos el ID de la tarea al método del Modelo que se encargará de borrar definitivamente
        $this->taskOrganizer->deleteTask($taskId);	
        //Regresa a la pantalla principal.
        header("Location: ../web/"); 
        exit;
    }

    public function updateTaskAction(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Cogemos los datos del formulario
            $taskId = $_POST['taskId'];
            $title = $_POST['title'];
            $userName = $_POST['userName'];
            $description = $_POST['description'];
            $taskStatus = $_POST['taskStatus'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $taskUpdate = [
                'title' => $title,
                'userName' => $userName,
                'description' => $description,
                'taskStatus' => $taskStatus,
                'startDate' => $startDate,
                'endDate' => $endDate ];
            
            $this->taskOrganizer->updateTask($taskId,$taskUpdate);
            //Regresa a la pantalla principal.
            header("Location: ../web/"); 
            exit; 

        }
    }
}

?>