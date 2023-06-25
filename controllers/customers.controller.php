<?php 

    class ControllerCustomers {

        public function createCustomer(array $dataCustomer) {
            if(isset($dataCustomer["first_name"]) && !preg_match('/^[a-zA-Z]+$/', $dataCustomer["first_name"])){
                sendError(404,"Error the name field only allows letters."); 
                return;
            }
            if(isset($dataCustomer["last_name"]) && !preg_match('/^[a-zA-Z]+$/', $dataCustomer["last_name"])){
                sendError(404,"Error the surname field only allows letters."); 
                return;
            }
            if(isset($dataCustomer["email"]) && !preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $dataCustomer["email"])){
                sendError(404,"Invalid email format error."); 
                return;
            }
            $hasCustomers = ModelCustomer::findCustomerByEmail($dataCustomer["email"]);
            if (!empty($hasCustomers)) {
                sendError(404,"Error email already exists."); 
                return;
            }
             
            $id_customer = str_replace("$","c",crypt($dataCustomer["first_name"].$dataCustomer["last_name"].$dataCustomer["email"],'$2a$10$R.gJb2U2N.FmZ4hPp1y2CN$'));
            $key_secret  = str_replace("$","c",crypt($dataCustomer["first_name"].$dataCustomer["email"].$dataCustomer["last_name"],'$2a$10$R.gJb2U2N.FmZ4hPp1y2CN$'));
            $data= array (
                "first_name"=> $dataCustomer["first_name"],
                "last_name"=> $dataCustomer["last_name"],
                "email" => $dataCustomer["email"],
                "id_customer"=>$id_customer,
                "key_secret"=>$key_secret,
                "create_at"=>date('Y-m-d h:i:s'),
                "update_at"=>date('Y-m-d h:i:s'),
            );
            $create = ModelCustomer::createCustomer($data);
            if($create=="ok"){
                sendResponse(200, "OK", $data);
                return;
            }else{
                sendError(404,$create); 
                return; 
            }

        }
        
        public function listCustomers() {
            $customers = ModelCustomer::listCustomers();
            sendResponse(200, "OK", $customers);
            return;
        }

        public function customerById($idCustomer) {
            $customers = ModelCustomer::findCustomerById($idCustomer);
            if(!empty($customers)){
                sendResponse(200, "OK", $customers[0]);
            }else{
                sendError(404,"Customer not found"); 
            }
            return;
        }
    }
?>