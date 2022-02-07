<?php include "inc/header.php" ; ?>

 <section class="booking-page">
     <div class="container">
         <div class="row">
             <div class="col-lg-9">

                
                <h2> Booking  History</h2>

                  <?php
                     if(!empty($_SESSION['msg']) )
                     {?>
                        <div class="alert alert-info">
                            <?php echo $_SESSION['msg'] ; ?>
                        </div>

                    <?php }

                    ?>
                 <table class="table table-hover table-bordered table-striped">
                     <thead>
                         <tr>
                             <th>#Sl.</th>
                             <th>Book Title</th>
                             <th>Order Date</th>
                             <th>Receive Date</th>
                             <th>Return Date</th>
                             <th>Status</th>
                             <th>Action</th>



                         </tr>
                     </thead>

                      <tbody>

                      <?php  

                            if($_SESSION['user_id'])
                            {
                                $user_id   = $_SESSION['user_id'];
                                $sql = "SELECT * FROM booking_list WHERE user_id = '$user_id' ORDER BY id ASC" ;
                                $allBookList = mysqli_query($db,$sql);
                                $numberCount  = mysqli_num_rows($allBookList);
                                $i=0;
                                    
                                if(  $numberCount <=0)
                                {?>
                                <div class="alert alert-info">No Booking List Found yet.</div>
                                    
                                <?php }
                                else
                                {
                                    while($row = mysqli_fetch_assoc($allBookList))
                                    {

                                        $id              =$row['id'];
                                        $book_id         =$row['book_id'];
                                        $user_id         =$row['user_id'];
                                        $rcv_date        =$row['rcv_date'];
                                        $rtn_date        =$row['rtn_date'];
                                        $booking_date    =$row['booking_date'];
                                        $status          =$row['status'];
                                        $i++;

                                  ?>
                                    <tr>
                                            <td><?php echo $i;  ?></td>
                                             <td>
                                                <?php
                                                 $sql = "SELECT * FROM book WHERE id ='$book_id' ";
                                                 $theBook = mysqli_query($db,$sql);
                                                 while($row = mysqli_fetch_assoc($theBook))
                                                 {
                                                     $title  = $row['title'];
                                                     echo $title;
                                                 }
                                                ?>
                                           </td>
                                            <td><?php echo $booking_date; ?></td>
                                            <td><?php echo $rcv_date; ?></td>
                                            <td><?php echo $rtn_date;  ?></td>
                                            <td>
                                                <?php
                                                 if($status == 1)
                                                 {?>
                                                    <span class="badge bg-primary">Active Booking</span>
                                                <?php }
                                                  else if($status == 2)
                                                  {?>
                                                     <span class="badge bg-success">Book Returned</span>
                                                 <?php }
                                                    else if($status == 3)
                                                    {?>
                                                       <span class="badge bg-danger">Booking Canceled</span>
                                                   <?php }
                                                     else if($status == 4)
                                                     {?>
                                                        <span class="badge bg-info">Pending Booking</span>
                                                    <?php }
                                                    ?>
                                            </td>
                                            <td>
                                                Edit
                                            </td>
                                    </tr>
                                      
                                    <?php }
                                }

                            }


                            ?>
                     
                      </tbody>

                 </table>

              

             
            </div>




             
                      <!-- Sidebar start-->
                      <?php include "inc/sidebar.php" ; ?>
                   
                   <!-- Sidebar End-->
         </div>
     </div>
 </section>
 <?php
     unset($_SESSION['msg']);
  ?>

<?php include "inc/footer.php" ; ?>