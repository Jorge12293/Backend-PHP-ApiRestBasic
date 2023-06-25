<?php 
    require_once "./config/connection.php";
    class ModelCustomer {

        static public function createCustomer(array $data) {
            $stmt = Connection::connect()->prepare("INSERT INTO customers (
                first_name, last_name, email, id_customer, key_secret, create_at, update_at
            ) VALUES (
                :first_name, :last_name, :email, :id_customer, :key_secret, :create_at, :update_at
            )");
            $stmt->bindParam(":first_name", $data["first_name"], PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $data["last_name"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
            $stmt->bindParam(":id_customer", $data["id_customer"], PDO::PARAM_STR);
            $stmt->bindParam(":key_secret", $data["key_secret"], PDO::PARAM_STR);
            $stmt->bindParam(":create_at", $data["create_at"], PDO::PARAM_STR);
            $stmt->bindParam(":update_at", $data["update_at"], PDO::PARAM_STR);
            if ($stmt->execute()) {
                return "ok";
            } else {
               return "Error al ejecutar la consulta: " . implode(" - ", $stmt->errorInfo());
            }
        }
        

        static public function updateCustomer(array $data,$idCustomer) {

            $stmt = Connection::connect()->prepare("UPDATE customers
            SET first_name=:first_name, last_name=:last_name, email=:email, update_at=:update_at
            WHERE id=:id");

            $stmt->bindParam(":id",$idCustomer,PDO::PARAM_STR);
            $stmt->bindParam(":first_name", $data["first_name"], PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $data["last_name"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
            $stmt->bindParam(":update_at", $data["update_at"], PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
               return "Error al ejecutar la consulta: " . implode(" - ", $stmt->errorInfo());
            }
        }

        
        static public function deleteCustomer($idCustomer) {
            $stmt = Connection::connect()->prepare("DELETE FROM customers WHERE id=:id");
            $stmt->bindParam(":id",$idCustomer,PDO::PARAM_STR); 
            
            if ($stmt->execute()) {
                return "ok";
            } else {
               return "Error al ejecutar la consulta: " . implode(" - ", $stmt->errorInfo());
            }
        }
        

        static public function listCustomers(){
            $stmt = Connection::connect()->prepare("SELECT * FROM customers");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            $stmt->closeCursor();
            return $results;
        }


        static public function findCustomerById($idCustomer){
            $stmt = Connection::connect()->prepare("SELECT * FROM customers where id =:id");
            $stmt->bindParam(":id",$idCustomer,PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $stmt->closeCursor();
            return $results;
        }

        static public function findCustomerByEmail($email){
            $stmt = Connection::connect()->prepare("SELECT * FROM customers where email like :email");
            $stmt->bindParam(":email",$email,PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $stmt->closeCursor();
            return $results;
        }

        static public function findCustomerByIdCustomerAndKeySecret($idCustomer,$keySecret){
            $stmt = Connection::connect()->prepare("SELECT * FROM customers where id_customer like '$idCustomer' and key_secret like '$keySecret'");
            $stmt->bindParam(":id_customer",$email,PDO::PARAM_STR);
            $stmt->bindParam(":key_secret",$keySecret,PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $stmt->closeCursor();
            return $results;
        }
    }
?>