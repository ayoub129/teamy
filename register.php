<?php  
   require_once("config/db.php");
   
   // define variables and set to empty values
   $email = $name =  $passerr = $emailerr = $nameerr  = $pass2err = '';

   if(isset($_POST["register"])) {
        $target_dir = "uploads/users/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
   
        // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
             // if everything is ok, try to upload file
         } else {
              if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                      // security functions on input to prevent xss
                        function test_input($data) {
                            $data = trim($data);
                            $data = stripslashes($data);
                            $data = htmlspecialchars($data);
                            return $data;
                        }
                    
                        if (empty($_POST["username"])) {
                            $nameerr = "username is required";
                        } else {
                            $name = test_input($_POST["username"]);
                            // check if name only contains letters and whitespace
                            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                                $nameerr = "Only letters and white space allowed";
                            }
                        }
                        
                        //  password required
                        if (empty($_POST["password"] )) {
                            $passerr = "password is required";
                        } else {
                            $password = test_input($_POST["password"]);
                            $hash_pass = password_hash("$password", PASSWORD_BCRYPT);
                        }
                        
                        if (empty($_POST["password2"])) {
                            $pass2err = "password Dosn't Match";
                        } else {
                            $pass = test_input($_POST["password"]);
                            $pass2 = test_input($_POST["password2"]);
                            if ($pass != $pass2 ) {
                                $pass2err = "password Dosn't Match";
                            }
                        }
                        
                        if (empty($_POST["email"])) {
                            $emailerr = "email is required";
                        }  else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                            $emailerr = "Invalid email format";
                        } 
                        else {
                            $email = test_input($_POST["email"]);
                        }


                        if($passerr == null && $emailerr == null && $nameerr == null && $pass2err == null) {
                            $users = "INSERT INTO users  (`username` , `email`  , `password` , `admin` , `image`)  VALUES ('$name' ,  '$email' , '$hash_pass' , 'false' , '$target_file')";
                            if (mysqli_query($conn , $users)) {
                                header("Location:login.php") ; 
                            } 
                        }
              } else {
                  echo "Sorry, there was an error uploading your file.";
             }
         }
   } 

    require_once("includes/header.php");
?>
      <div class="row w-100 text-dark">
          <form method="POST" enctype="multipart/form-data" class="col-sm-6 col-12 bg-white shadow-none">
              <div class="w-75 mx-auto py-4">
                <a href="index.php" class="logo fs-4 fw-bold text-dark"><span class="text-primary">T</span>eamy</a>
                <div class="mt-5">
                    <h1 class="fs-2 fw-bold mb-3">
                        Register 🖕
                    </h1>
                    <div class="d-flex align-items-center my-5">
                        <hr class="w-50">
                        <p class="mb-0 w-50 ps-4 text-secondary f-montserat"> Sign Up With Email</p> 
                        <hr class="w-50">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="mb-1">UserName</label>
                        <input type="text" name="username" value="<?php  echo $name ?>" id="name" placeholder="Username" class="form-control ">
                        <small class="text-danger fw-bold"> <?php echo $nameerr ;  ?></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="mb-1">Email</label>
                        <input type="text" name="email" value="<?php  echo $email ?>" id="email" placeholder="Email" class="form-control ">
                        <small class="text-danger fw-bold"> <?php echo $emailerr ;  ?></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pass" class="mb-1">Password</label>
                        <input type="password" name="password" id="pass" placeholder="Password" class="form-control ">
                        <small class="text-danger fw-bold"> <?php echo $passerr ;  ?></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cpass" class="mb-1">Confirm Password</label>
                        <input type="password" name="password2" id="cpass" placeholder="Confirm Password" class="form-control ">
                        <small class="text-danger fw-bold"> <?php echo $pass2err ;  ?></small>
                    </div>

                    <div class="form-group">
                        <label>Select Image</label>
                        <input type="file" class="show" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                    </div>
                   
                    <button name="register" type="submit" class="btn d-block w-100 mt-5 btn-primary fw-bold">Register </button>
                    <div class="fw-bold mt-4">
                        <p class="text-capitalize">Already Have An Account ? <a href="login.php"> Login</a></p>
                    </div>
                    <p class="mt-4 text-secondary">&copy; 2021 All Right Reserved , Created By Digital Fontaine</p>
                </div>
            </div>
        </form>
            <div class="col-sm-6 col-12">
                <img src="assets/images/img.jpg" class="img-fluid  hvh-100" alt="image">
            </div>
        </div>
<?php  
   require_once("includes/footer.php");
?>

