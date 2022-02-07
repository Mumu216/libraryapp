<?php include "inc/header.php" ; ?>

 <!-- All Book Section Start-->
 <section class="booking-page">
     <div class="container">
         <div class="row">
             <!-- book content start-->
             <div class="col-lg-9">
                 <?php
                   if(isset($_GET['do']))
                   {
                       $mngId =$_GET['do'];
                       $sql = "SELECT * FROM users WHERE user_id ='$mngId'";
                       $userDataMng = mysqli_query($db,$sql);
                       while($row = mysqli_fetch_assoc($userDataMng))
                       { 
                             
                           $user_id     =$row['user_id'];
                           $fullname    =$row['fullname'];
                           ?>

                           <h2>Manage Your Profile</h2>

                                <form action="" method="POST">
        
                                    <div class="mb-3">
                                      <label for="">Full Name</label>
                                        <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>"  autocomplete="off" >
                                    </div>

                                    <div class="mb-3">
                                      <label for="">phone</label>
                                        <input type="phone" value="<?php echo $row['phone']; ?>" name="phone" class="form-control"  autocomplete="off" required="required">
                                    </div>
                                    <div class="mb-3">
                                      <label for="">Address</label>
                                        <input type="address" name="address" value="<?php echo $row['address']; ; ?>" class="form-control"  autocomplete="off" required="required">
                                    </div>

                                    <div class="mb-3">
                                       <label for="">Password</label>
                                         <input type="password" placeholder="*****" name="password" class="form-control"   >
                                    </div>

                                    <div class="mb-3">
                                      <label for="">Confirm Password</label>
                                        <input type="password" placeholder="*****" name="cpassword" class="form-control"   >
                                    </div>

                                    <div class="mb-3 ">
                                     <input type="submit" name="upProfile" value="Save Changes" class="btn btn-dark ">
                                </div>
                            </form>

                       <?php }
                   }

                             if(isset($_POST['upProfile']))
                             {
                                 $user_id       =$_POST['user_id'];
                                 $fullname      =$_POST['fullname'];
                                 $phone         =$_POST['phone'];
                                 $address       =$_POST['address'];
                                 $password      =$_POST['password'];
                                 $cpassword     =$_POST['cpassword'];

                                 if(!empty($password)){
                                     if($password == $cpassword){
                                         $hassedPass =sha1($password);
                                      
                                        $sql=" UPDATE users SET fullname='$fullname', password='$hassedPass', phone='$phone' , address='$address' WHERE user_id='$mngId' " ;
                                        $getManage = mysqli_query($db,$sql);
                                        
                                           if($getManage){
                                               echo "Profile Updated" ;
                                           }else{
                                               echo " Something Went Wrong" ;
                                           }

                                        }
                                        else{
                                            echo " password Doesn't Match" ;
                                        }
                                 }
                                   
                                 else{
                                     $query= "UPDATE users SET  fullname='$fullname', phone='$phone' , address='$address' WHERE user_id='$mngId'";
                                     $getManagePro = mysqli_query($db,$query);

                                     if($getManagePro){
                                         echo "Profile Updated";
                                     }else{
                                         echo "Something Went Wrong";
                                     }

                                 }


                             }
                 ?>
                   
              
               </div>
                 <!-- Sidebar start-->
                 <?php include "inc/sidebar.php" ; ?>
                   
                   <!-- Sidebar End-->
        </div>
    </div>
</section>

<?php include "inc/footer.php" ; ?>
