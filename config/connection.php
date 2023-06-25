


<?php 
    Class Connection{

        static public function connect(){
            $dsn = GlobalVariables::$db_dsn;
            $user = GlobalVariables::$db_user;
            $password = GlobalVariables::$db_password;
            
            try {
                // Create instance of connection PDO
                $connection = new PDO($dsn, $user, $password);
                // Configure options of PDO
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                // Return of connection
                return $connection;
            } catch (PDOException $e) {
                // Errors Connection
                echo 'Error de conexión: ' . $e->getMessage();
                return null;
            }
        }
    }
?>
