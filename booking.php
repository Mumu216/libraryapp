<?php include "inc/header.php" ; ?>

 <section class="booking-page">
     <div class="container">
         <div class="row">
             <div class="col-lg-9">

                
             <?php
                if(isset($_GET['id']))
                {
                   $theBookID    =$_GET['id'];
                   $sql = "SELECT * FROM book WHERE id='$theBookID '";
                   $bData = mysqli_query($db,$sql);
                   while($row  = mysqli_fetch_assoc($bData))
                   {
                        $id                =$row['id'];
                        $title             =$row['title'];
                        $quantity          =$row['quantity'];
                            
                  }
                    if($quantity <=0)
                    {?>
                       <span class="alert alert-info text-center">Sorry!!! This Book is not availabe now for Bookinf Purpose. Please Check Back Later. Thanl you.</span>
                    
                    <?php }
                     else
                     {?> 
                       <h2>Please Fillup Information for the Booking Confirmation -</h2>
                         
                    <?php 
                       
                              $user_id =  $_SESSION['user_id'] ;
                              $query   ="SELECT * FROM users WHERE user_id = '$user_id'" ;
                              $userData = mysqli_query($db, $query);
                              while( $row = mysqli_fetch_array($userData) )
                              {
                                  $fullname     =$row['fullname'];
                                  $email        =$row['email'];
                                  $phone        =$row['phone'];
                                  $address      =$row['address'];
                            }?>
                    
                              
                    <form action=""  method="POST" class="booking-form">
                     <div class="row">

                      <div>
                          <table  class="table table-hover table-bordered ">
                              <thead>
                                 <tr>
                                     <th>Fullname</th>
                                     <th>Email Address</th>
                                     <th>Address</th>
                                     <th>Phone No.</th>

                                 </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td><?php echo $fullname;  ?></td>
                                      <td><?php echo $email;  ?></td>
                                      <td><?php echo $address;  ?></td>
                                      <td><?php echo $phone;  ?></td>

                                  </tr>

                              </tbody>
                          </table>
                      </div>
                      

                         <div class="col-lg-6 offset-lg-3">
                             <div class="mb-3">
                                 <label>Receive Date</label>
                                 <input type="text" id="datepicker" name="rcv_date"  class="form-control" placeholder="Please Input the Date for the Receive the Book" autocomplete="off" required="required">
                          </div>

                             <div class="mb-3">
                                 <label>Return Date</label>
                                 <input type="text" id="rtndatepicker" name="rtn_date"  class="form-control" placeholder="Please Input the Date for the Return the Book" autocomplete="off" required="required">
                          </div>

                          <div class="mb-3">
                              <input type="hidden" name="book_id"  value="<?php echo $theBookID; ?>">
                              <input type="hidden" name="user_id"  value="<?php echo $user_id; ?>">
                              <button type="submit" name="placeOrder" class="btn-book">Proceed the Booking</button>

                          </div>
                       </div>
                   </div>
            </form>

                            
                        <?php }

                           // Proceed the booking
                           if(isset($_POST['placeOrder']))
                           {
                                   $book_id         =$_POST['book_id'];
                                   $user_id         =$_POST['user_id'];
                                   $rcv_date        =date('Y-m-d', strtotime($_POST['rcv_date']));
                                   $rtn_date        =date('Y-m-d', strtotime($_POST['rtn_date']));

                                   if( !empty($rcv_date)  &&  !empty($rtn_date) )
                                   {
                                       $sql  = "INSERT INTO booking_list (	book_id	,user_id, rcv_date,	rtn_date, booking_date) VALUES ('$book_id', '$user_id', '$rcv_date' , '$rtn_date', now())";
                                       $bookingConfirmation = mysqli_query($db, $sql);

                                       if($bookingConfirmation)
                                       {   
                                           $_SESSION['msg']= "Your Booking is Pending For Admin Approval. Please Contact with the Library Admin Physically to receive the Book.";
                                           header("Location: order-history.php");
                                       }
                                       else
                                       {
                                           die("MySQLi Error. "  . mysqli_error($db));
                                       }


                                       

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

