<?php 
    $arrayRoutes = explode("/",$_SERVER['REQUEST_URI']);
    $courses = new ControllerCourses();

    if( count(array_filter($arrayRoutes)) == 3 && isset($_SERVER['REQUEST_METHOD']) 
        && $_SERVER['REQUEST_METHOD'] == "GET"){
        
        $courses->listCourses();
        return;
    }

    if( count(array_filter($arrayRoutes)) == 3 && isset($_SERVER['REQUEST_METHOD']) 
        && $_SERVER['REQUEST_METHOD'] == "POST"){
        
        $dataCourse = array(
            "title"=>$_POST["title"], 
            "description"=>$_POST["description"], 
            "instructor"=>$_POST["instructor"], 
            "image"=>$_POST["image"], 
            "price"=>$_POST["price"],
        );
        $courses->createCourse($dataCourse);
        return;
    }

    if( count(array_filter($arrayRoutes)) == 4 && is_numeric(array_filter($arrayRoutes)[4]) &&
        isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "PUT"){

            $data = file_get_contents('php://input');
            $dataCourse = json_decode($data, true);
            $courses->updateCourse(array_filter($arrayRoutes)[4],$dataCourse);
            return;
    }

    if( count(array_filter($arrayRoutes)) == 4 && is_numeric(array_filter($arrayRoutes)[4]) &&
        isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "DELETE" ){

        $courses->deleteCourse(array_filter($arrayRoutes)[4]);
        return;
    }

    if( count(array_filter($arrayRoutes)) == 4 && is_numeric(array_filter($arrayRoutes)[4]) && 
        isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){
            
        $courses->courseById(array_filter($arrayRoutes)[4]);
        return; 
    }
    
    sendError(404,"Route not found");
    return;

?>
