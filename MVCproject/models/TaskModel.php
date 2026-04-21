<?php
class TaskModel {
    private $filePath;

    public function __construct($filePath = 'data/tasks.json') {
        $this->filePath = $filePath;
    }

    public function getAllTasks() {
        if (file_exists($this->filePath)) {
            $data = file_get_contents($this->filePath);
            return json_decode($data, true) ?: [];
        }
        return [];
    }

    public function addTask($task) {
        $tasks = $this->getAllTasks();
        $id = count($tasks) + 1;
        $tasks[] = ["id" => (string)$id, "title" => trim($task), "status" => "not done"];
        $this->saveTasks($tasks);
    }

    public function updateTask($index, $newTask) {
        $tasks = $this->getAllTasks();
        if (isset($tasks[$index])) {
            $tasks[$index]["title"] = trim($newTask);
            $this->saveTasks($tasks);
        }
    }

    public function deleteTask($index) {
        $tasks = $this->getAllTasks();
        if (isset($tasks[$index])) {
            unset($tasks[$index]);
            $tasks = array_values($tasks); // reindex
            $this->saveTasks($tasks);
        }
    }

    private function saveTasks($tasks) {
        file_put_contents($this->filePath, json_encode($tasks));
    }

    public function toggleStatus($index) {
        $tasks = $this->getAllTasks();
        if (isset($tasks[$index])) {
            $tasks[$index]["status"] = $tasks[$index]["status"] === "done" ? "not done" : "done";
            $this->saveTasks($tasks);
        }
    }
}
?>