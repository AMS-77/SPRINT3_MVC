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
        //Este es el primer método del CRUD que se ejecuta en la vista principal, hace de Read.
        $tasks = $this->taskOrganizer->getAllTasks();
        //Enviamos el array de tareas, que se enseñará en la vista.
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
            //Enviamos datos al modelo
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
    }

    public function updateTaskAction(){
        // Inicializamos la variable $taskToUpdate.
        $taskToUpdate = null;
        
        //var_dump($_GET); // Verificamos los datos enviados a ver si el id llega por URL.
        //exit; 
        
        //Capturamos el id, aun sabiendo que llega por URL comprobamos si es POST, GET,
        //de no ser ninguno se declara como null.
        $taskId = $_POST['taskId'] ?? $_GET['taskId'] ?? null;

        // Obtenemos todas las tareas actuales llamando a la función del Modelo
        $arrayTasks = $this->taskOrganizer->getAllTasks();
    
        // Buscamos la tarea correspondiente al ID
        foreach ($arrayTasks as $task) {
            if ($task['id'] == $taskId) {
                $taskToUpdate = $task;
                break;
            }
        }
    
        // Si el formulario se envió...
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtenemos los datos del formulario
            $title = $_POST['title'];
            $userName = $_POST['userName'];
            $description = $_POST['description'];
            $taskStatus = $_POST['taskStatus'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
    
            // Creamos un array con los datos actualizados
            $taskUpdate = [
                'title' => $title,
                'userName' => $userName,
                'description' => $description,
                'taskStatus' => $taskStatus,
                'startDate' => $startDate,
                'endDate' => $endDate
            ];
    
            // Llamamos al método del modelo para actualizar la tarea
            $this->taskOrganizer->updateTask($taskId, $taskUpdate);
    
            // Redirigimos a la pantalla principal con el listado de tareas ya actualizado
            header("Location: ../web/");
            exit;
        }
    
        // Enviamos $taskToUpdate as la vista para que se muestren los datos actuales en el formulario
        $this->view->taskToUpdate = $taskToUpdate;
    }
}

?>