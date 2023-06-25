<?php 
    $arrayRoutes = explode("/",$_SERVER['REQUEST_URI']);
    $customers = new ControllerCustomers();


    if( count(array_filter($arrayRoutes)) == 3 && 
        isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){
        
        $customers->listCustomers();
        return;
    }

    if( count(array_filter($arrayRoutes)) == 3 && 
        isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
        $dataCustomer = array(
            "first_name"=> $_POST["first_name"],
            "last_name"=> $_POST["last_name"],
            "email" => $_POST["email"],
        );
        $customers = new ControllerCustomers();
        $customers->createCustomer($dataCustomer);
        return;
    }

    if( count(array_filter($arrayRoutes)) == 4 && is_numeric(array_filter($arrayRoutes)[4]) &&
        isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET" ){
    
        $customers->customerById(array_filter($arrayRoutes)[4]);
        return;
    }

    sendError(404,"Route not found");
    return;
?>
