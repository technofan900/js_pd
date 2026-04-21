<?php
require_once "models/TaskModel.php";

class TaskController {
    private $model;

    public function __construct() {
        $this->model = new TaskModel();
    }

    public function index() {
        include "views/taskView.php";
    }

    public function add() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["task"])) {
            $this->model->addTask($_POST["task"]);
        }
        header("Location: index.php");
        exit;
    }

    public function delete() {
        if (isset($_GET["index"])) {
            $this->model->deleteTask((int)$_GET["index"]);
        }
        header("Location: index.php");
        exit;
    }

    public function edit() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["index"]) && isset($_POST["task"])) {
            $this->model->updateTask((int)$_POST["index"], $_POST["task"]);
        }
        header("Location: index.php");
        exit;
    }

    // For AJAX
    public function getTasks() {
        header("Content-Type: application/json");
        echo json_encode($this->model->getAllTasks());
    }

    public function addAjax() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["task"])) {
            $this->model->addTask($_POST["task"]);
            $this->getTasks();
        }
    }

    public function deleteAjax() {
        if (isset($_POST["index"])) {
            $this->model->deleteTask((int)$_POST["index"]);
            $this->getTasks();
        }
    }

    public function editAjax() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["index"]) && isset($_POST["task"])) {
            $this->model->updateTask((int)$_POST["index"], $_POST["task"]);
            $this->getTasks();
        }
    }

    public function toggleAjax() {
        if (isset($_POST["index"])) {
            $this->model->toggleStatus((int)$_POST["index"]);
            $this->getTasks();
        }
    }
}
?>
