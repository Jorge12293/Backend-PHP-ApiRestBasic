<?php 

    class ControllerCourses {

        public function createCourse(array $dataCourse) {
            if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ){
                sendError(404,"User without permissions"); 
                return;
            }
            $custmoners = ModelCustomer::findCustomerByIdCustomerAndKeySecret($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);   
            if(empty($custmoners)){
                sendError(404,"Invalid user"); 
                return;
            }
            $customer=$custmoners[0];
            $data = array(
                "title"=>$dataCourse["title"],
                "description"=>$dataCourse["description"],
                "instructor"=>$dataCourse["instructor"],
                "image"=>$dataCourse["image"],
                "price"=>$dataCourse["price"],
                "id_user_create"=>$customer["id"],
                "create_at"=>date('Y-m-d h:i:s'),
                "update_at"=>date('Y-m-d h:i:s'),
            );
            $create = ModelCourse::createCourse($data);
            if($create=="ok"){
                sendResponse(200, "OK", $data);
                return;
            }else{
                sendError(404, $create); 
                return; 
            }
        }

        public function updateCourse($idCourse,$dataCourse) {
            if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ){
                sendError(404,"User without permissions"); 
                return;
            }
            $custmoners = ModelCustomer::findCustomerByIdCustomerAndKeySecret($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);   
            if(empty($custmoners)){
                sendError(404,"Invalid user"); 
                return;
            }
            $data = array(
                "id"=>$idCourse,
                "title"=>$dataCourse["title"],
                "description"=>$dataCourse["description"],
                "instructor"=>$dataCourse["instructor"],
                "image"=>$dataCourse["image"],
                "price"=>$dataCourse["price"],
                "update_at"=>date('Y-m-d h:i:s'),
            );
            
            $update = ModelCourse::updateCourse($data,$idCourse);
            if($update=="ok"){
                sendResponse(200, "OK", $data);
                return;
            }else{
                sendError(404, $update); 
                return; 
            }
        }

        public function deleteCourse($idCourse) {
            $delete = ModelCourse::deleteCourse($idCourse);
            if($delete=="ok"){
                sendResponse(200, "OK");
                return;
            }else{
                sendError(404, $delete); 
                return; 
            }
        }

        public function listCourses() {
            if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ){
                sendError(404,"User without permissions"); 
                return;
            }
            $custmoners = ModelCustomer::findCustomerByIdCustomerAndKeySecret($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);   
            if(empty($custmoners)){
                sendError(404,"Invalid user"); 
                return;
            }
            $courses = ModelCourse::listCourses();
            sendResponse(200, "OK", $courses);
            return;
        }

        public function courseById($idCourse) {
            $courses = ModelCourse::findCourseById($idCourse);
            if(!empty($courses)){
                sendResponse(200, "OK", $courses[0]);
            }else{
                sendError(404,"Course not found"); 
            }
            return;
        }
    }
?>