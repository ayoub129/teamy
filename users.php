<?php
    require_once("config/db.php");
    require_once("includes/sidebar.php");

    $user = "SELECT * FROM `users` WHERE `admin` ='false'";
    $result = mysqli_query($conn , $user);

    
    if(isset($_POST['approve'])) {
        $id= $_POST['id'];
        $update_status = "UPDATE `users` SET `status`='approved' WHERE `id` = '$id'";
        if (mysqli_query($conn , $update_status)) {
            header("Location:dashboard.php");
        }
    } elseif(isset($_POST['reject'])) {
        $id= $_POST['id'];
        $update_status = "UPDATE `users` SET `status`='rejected' WHERE `id` = '$id'";
        if (mysqli_query($conn , $update_status)) {
            header("Location:dashboard.php");
        }
    }
    ?>
    <div class="col-md-10 col-12 bg-light ms-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center pt-3 justify-content-between">
                <div class="text-dark fw-bold text-uppercase">
                Users
                </div>
                <div class="d-flex align-items-center">
                <div class="position-relative">
                    <input type="text" placeholder="Search" class="form-control">
                    <i class="ri-search-line position-absolute search-icon"></i>
                </div>
                <i class="ri-settings-2-line ms-3"></i>
                <i class="ri-notification-line ms-3"></i>
                </div>
            </div>
             <hr />
            <p class="fw-bold text-capitalize text-dark mt-2">Users</p>
            <div class="bg-white mt-2 shadow-none p-4">
                <table class="table fw-bold datatable ">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">team</th>
                            <th scope="col">Tasks Done</th>
                            <th scope="col">Files Uploaded</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($row = mysqli_fetch_assoc($result)) {
                                    $t = $row['team_id']
                            ?>
                             <tr class="height">
                                 <form method="POST">
                                    <td><?php echo $row["username"] ?></td>
                                    <td><?php echo $row["email"] ?></td>
                                    <td>
                                        <?php
                                        $team = "SELECT * FROM `team` WHERE `id` = '$t'";
                                        $res = mysqli_query($conn , $team);
                                        while ($row2 = mysqli_fetch_assoc($res)) {
                                            echo $row2["name"];   
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        Nothing Found
                                    </td>
                                    <td>0</td>
                                    <td>

                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <?php if($row['status'] == "pending") { ?>
                                                <span class="badge bg-warning text-capitalize"><?php echo $row["status"] ?></span> 
                                        <?php } elseif($row['status'] == "rejected") { ?>
                                            <span class="badge bg-danger text-capitalize"><?php echo $row["status"] ?></span> 
                                        <?php } elseif($row['status'] == "approved") {?>
                                            <span class="badge bg-success text-capitalize"><?php echo $row["status"] ?></span> 
                                        <?php } ?>
                                    </td>
                                     <td>
                                        <button name="approve" class="btn btn-primary p-0 px-1  text-white">Approve</button> 
                                        <button name="reject" class="btn btn-danger p-0 px-1  text-white">Reject</button>
                                    </td>
                                </form>
                           </tr>
                        <?php } ?> 
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
<?php
    require_once("includes/footer.php")
?>