<?php 

    class ApiRoutes {
        public function initRoutes(){
           
            $arrayRoutes = explode("/",$_SERVER['REQUEST_URI']);

            if(array_filter($arrayRoutes)[3]== "customers"){
            
                require_once "customers.php";
            
            }else if(array_filter($arrayRoutes)[3]== "courses"){
            
                require_once "courses.php";
            
            }else{
            
                sendError(404,"Route not found"); 
            } 
        }
    }
?>