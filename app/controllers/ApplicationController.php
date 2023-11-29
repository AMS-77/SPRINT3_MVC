<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */

//require_once '../models/TaskModel.php';
//require_once '../../lib/base/Controller.php'; //Isn't necessary..

class ApplicationController extends Controller {



    //Attributes
    private $jsonDB;
    private $taskOrganizer;//eliminamos la necesidad de crear una nueva instancia en cada metodo 

    //Constructor
    public function __construct(){
        $this->jsonDB = '../app/models/database/db.json';
        $this->taskOrganizer = new TaskModel();
    }

    public function indexAction(){
        //take all tasks and insert them on the variable
        $taskList = new TaskModel();
        
        $tasks = $taskList->getAllTasks();
        //Send the tasks to view
        $this->view->tasks = $tasks;
    }
    public function showAllTasks(){
        //take all tasks and insert them on the variable
        $taskList = new TaskModel();
        
        $tasks = $taskList->getAllTasks();
        //Send the tasks to view
        $this->view->tasks = $tasks;
    }

    public function createTaskAction(){
                
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Take information from the form
            $title = $_POST['title'];
            $userName = $_POST['userName'];
            $description = $_POST['description'];
            $taskStatus = $_POST['taskStatus'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $this->taskOrganizer->createTask($title, $userName, $description, $taskStatus, $startDate, $endDate);


        }
    }

    public function deleteTaskAction() {
    
        /* El ID de la tarea que eliminemos nos viene a través de la URL, por eso usamos
        la variable superglobal $_GET */
        $taskId = $_GET['id'];
    
        // Comprobamos si el envio del formulario es a través del metodo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Eliminamos la tarea
            $this->taskOrganizer->deleteTask($taskId);	
        }
    }

    public function updateTaskAction(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Cogemos los datos del formulario
            $taskId = $_POST ['id'];
            $title = $_POST['title'];
            $userName = $_POST['userName'];
            $description = $_POST['description'];
            $taskStatus = $_POST['taskStatus'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $this->taskOrganizer->updateTask($taskId, $title, $userName, $description, $taskStatus, $startDate, $endDate);


        }
    }
}

?>