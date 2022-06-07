<?php
    Class Database {
        private $connection;
        public function __construct(){
            $dbname = "php_crud";
            $servername = "localhost";
            $username = "root";
            $password = "";

            // Create connection
            $this->connection = mysqli_connect($servername, $username, $password, $dbname );

            // Check connection
            if (!$this->connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }

        public function add_data($data){
            $username = $data['username'];
            $email = $data['email'];
            $phone = $data['phone'];
            $image_name = $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];
            
            $insert_query = "INSERT INTO user (username, email, phone, image) 
                            VALUES('$username', '$email', '$phone', '$image_name')";

            if(mysqli_query($this->connection, $insert_query)){
                move_uploaded_file( $temp_name, 'uploads/images/'. $image_name);
                return "Data Inserted Successfully";
            }else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($this->conn);
              }
        }

        public function read_data(){
            $select_data = "SELECT * FROM user";
            $result = mysqli_query($this->connection, $select_data);
            if($result){
                return $result;
            }
        }

        public function read_data_by_id($id){
            $query = "SELECT * FROM user WHERE id=$id";
            if(mysqli_query($this->connection,$query)){
                $data =mysqli_query($this->connection,$query);
                $result=mysqli_fetch_assoc($data); 
                return $result;
                
            }
        }

        public function update_data($data){
           
            $username = $data['u_username'];
            $email = $data['u_email'];
            $phone = $data['u_phone'];
            $id = $data['user_id'];
            $user_image = $_FILES["u_image"]["name"];
            $data = "SELECT * FROM user WHERE id=$id";
            $result = mysqli_query($this->connection, $data);
            $user = mysqli_fetch_assoc($result);
            if(isset($user) && !empty($user)){
                $image = $user['image'];
            }
            if(isset($user_image) && !empty( $user_image)) {
                $sql = "Update user Set username='$username', email='$email', phone='$phone', image='$user_image' Where id='$id'";
                if(file_exists('uploads/images/'.$image)){
                    unlink('uploads/images/'.$image);
                }
                move_uploaded_file($_FILES["u_image"]["tmp_name"],'uploads/images/'.$user_image);
                $result = mysqli_query($this->connection, $sql);
                }
                else{
                    $sql = "Update user Set username='$username', email='$email', phone='$phone' Where id='$id'";
                    $result = mysqli_query($this->connection, $sql);
                }
        }

        public function delete_user($id){
            $data = "SELECT * FROM user WHERE id=$id";
            $result = mysqli_query($this->connection, $data);
            $user = mysqli_fetch_assoc($result);
           if(isset($user) && !empty($user)){
               $image = $user['image'];
           }
            $query = "DELETE FROM user WHERE id=$id";
            if(mysqli_query($this->connection, $query)){
                if(file_exists('uploads/images/'.$image)){
                    unlink('uploads/images/'.$image);
                }
                return 'User Deleted Successfully';
            }
        }


    }

?>