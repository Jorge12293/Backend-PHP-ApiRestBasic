<?php 
    require_once "global/variables.global.php";
    require_once "routes/api.routes.php";
    require_once "controllers/courses.controller.php";
    require_once "controllers/customers.controller.php";
    require_once "models/course.model.php";
    require_once "models/customer.model.php";
    require_once "utils/response.php";

    $routes = new ApiRoutes();
    $routes->initRoutes();
?>