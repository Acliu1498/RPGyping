<?php
class Model
{
    public $string;
    
    public function __construct() {
        print("HI");
        $this->string = "MVC + PHP = Awesome, click here!";
    }

}

class View
{
    private $model;
    private $controller;

    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output() {
        print("TEST");
        //return '<p><a href="../config/Test.php?action=clicked"' . $this->model->string . "</a></p>";
        return '<p><a href="../config/Test.php?action=clicked">'.$this->model->string.'</a></p>';
    }
}

class Controller
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function clicked() {
        $this->model->string = "Updated Data, thanks to MVC and PHP!";
    }
}

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller->{$_GET['action']}();
}

echo $view->output();
?>