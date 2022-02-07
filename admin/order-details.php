<?php include "inc/header.php";  ?>

        <!-- Content Wrapper. Contains page content start -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">All Order List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage All Order List</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



     <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                 <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">

                          <!-- Card-body-->
                          <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Mange All Order List</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collaps">
                                        <i class="fas fa-minus"></i>

                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                               <?php

                                 $do =isset($_GET['do'])  ?  $_GET['do'] : 'Manage' ;
                                 if($do== 'Manage')
                                 {?>
                                       
                                       <table id="dataSearch" class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Book Title</th>
                                                    <th>User Name</th>
                                                    <th>Order Date</th>
                                                    <th>Receive Date</th>
                                                    <th>Return Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php
                                                
                                                $sql = "SELECT * FROM booking_list ORDER BY id DESC" ;
                                                $allBookList = mysqli_query($db,$sql);
                                                $i=0;

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
                                                            <td><?php echo $i; ?></td>
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
                                                            <td>
                                                                    <?php
                                                                    $sql = "SELECT * FROM users WHERE user_id ='$user_id' ";
                                                                    $theUser = mysqli_query($db,$sql);
                                                                    while($row = mysqli_fetch_assoc($theUser))
                                                                    {
                                                                        $fullname  = $row['fullname'];
                                                                        echo $fullname;
                                                                    }
                                                                    ?>
                                                            </td>
                                                            <td><?php echo $booking_date; ?></td> 
                                                            <td>
                                                                <span class="badge bg-primary"><?php echo $rcv_date;  ?></span>
                                                            </td>    
                                                            <td>
                                                                <span class="badge bg-primary"><?php echo $rtn_date;  ?></span>
                                                            </td>    
                                                            <td>
                                                                        <?php
                                                                    if($status == 1)
                                                                    {?>
                                                                        <span class="badge bg-info">Active Booking</span>
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
                                                                            <span class="badge bg-warning">Pending Booking</span>
                                                                        <?php }
                                                                        ?>
                                                                </td>
                                                                <td>
                                                                <div class="table-action">
                                                                <ul>
                                                                    <li> <a href="order-details.php?do=Edit&o_id=<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
                                                                    </li>
                                                                    <li> <a href=""   data-toggle="modal" data-target="#delorderID"><i class="fa fa-trash"></i></a>
                                                                    </li>
                                                                    </ul>
                                                                    </div>
                                                                </td>    

                                                
                                                        </tr>
                                            <?php  }

                                                ?>

                                            </tbody>
                                        </table>

                                    
                                            

                                    <?php  }

                                    else if($do=='Edit')
                                    {
                                       if(isset($_GET['o_id']))
                                       {
                                           $order_id  = $_GET['o_id'];
                            
                                           $sql = "SELECT * FROM booking_list WHERE id ='$order_id' ";
                                           $orderData = mysqli_query($db,$sql);
                                           while($row= mysqli_fetch_assoc($orderData))
                                           {
                                                        
                                                    $id              =$row['id'];
                                                    $book_id         =$row['book_id'];
                                                    $user_id         =$row['user_id'];
                                                    $rcv_date        =$row['rcv_date'];
                                                    $rtn_date        =$row['rtn_date'];
                                                    $booking_date    =$row['booking_date'];
                                                    $status          =$row['status'];
                                                    ?>

                                                       <form action="order-details.php?do=Update"  method="POST">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                  <div class="form-group">
                                                                    <label>Receive Date</label>
                                                                      <input type="text" id="datepicker" name="rcv_date" class="form-control" autocomplete="off" required="required" value="<?php echo $rcv_date; ?>">
                                                                  </div>

                                                                  <div class="form-group">
                                                                     <label>Return Date</label>
                                                                        <input type="text" id="rtndatepicker" name="rtn_date" class="form-control" autocomplete="off" required="required"  value="<?php echo $rtn_date; ?>">
                                                                  </div>
                                            
                                                                </div>
                                                                <div class="col-lg-6">

                                                                <div class="form-group">
                                                                        <label>Booking Status</label>
                                                                         <select class="form-control" name="status">
                                                                             <option value="4">Please Select Booking Status</option>
                                                                             <option value="1" <?php if ($status == 1 ) {echo 'selected' ;} ?>>Active</option>
                                                                             <option value="2" <?php if ($status == 2 ) {echo 'selected' ;} ?>>Returned</option>
                                                                             <option value="3" <?php if ($status == 3 ) {echo 'selected' ;} ?>>Cancel</option>
                                                                             <option value="4" <?php if ($status == 4 ) {echo 'selected' ;} ?>>Pending</option>
                                                                       </select>
                                                                   </div>
                                                                   <div>
                                                                       <input type="hidden" name="order_id" value="<?php echo $id;  ?>">
                                                                       <input type="hidden" name="book_id" value="<?php echo $book_id;  ?>">
                                                                       <input type="submit" name="updateOrder" class="btn btn-success" value="save changes">


                                                                   </div>

                                                                </div>

                                                            </div>

                                                        </form>

                                          <?php }

                                            }
                                    }
                                        else if($do=='Update')
                                                {
                                                    if(isset($_POST['updateOrder']))
                                                    {
                                                        $order_id       =$_POST['order_id'];
                                                        $book_id        =$_POST['book_id'];
                                                        $rcv_date       =date('Y-m-d', strtotime($_POST['rcv_date']));
                                                        $rtn_date       =date('Y-m-d', strtotime($_POST['rtn_date']));
                                                        $status         =$_POST['status'];


                                                        if( $status == 1)
                                                        {
                                                            $sql = "UPDATE booking_list SET rcv_date='$rcv_date' , rtn_date='$rtn_date', status='$status' WHERE id= '$order_id'";
                                                            $update_order_details= mysqli_query($db,$sql);
    
                                                            // update the quantity of the ordered book
    
                                                            $query= " SELECT * FROM book WHERE id = '$book_id'";
                                                            $bookData = mysqli_query($db,$query);
                                                            while( $row = mysqli_fetch_assoc($bookData))
                                                            {
                                                                $quantity    =$row['quantity'];
                                                                $quantity--;
                                                            }
                        
                                                            $query2 ="UPDATE book SET quantity ='$quantity' WHERE id='$book_id'";
                                                            $updateBookData = mysqli_query($db,$query2);
                                                            if( $updateBookData)
                                                            {
                                                               header("Location: order-details.php?do=Manage");
    
                                                            }
                                                            else
                                                            {
                                                                die("MySQL Error . " . mysqli_error($db));
                                                            }
    
                 

                                                        }


                                                        else if( $status == 2)
                                                        {
                                                            $sql = "UPDATE booking_list SET rcv_date='$rcv_date' , rtn_date='$rtn_date', status='$status' WHERE id= '$order_id'";
                                                            $update_Order_details= mysqli_query($db,$sql);
    
                                                            // update the quantity of the ordered book
    
                                                            $query= " SELECT * FROM book WHERE id = '$book_id'";
                                                            $bookData = mysqli_query($db,$query);
                                                            while( $row = mysqli_fetch_assoc($bookData))
                                                            {
                                                                $quantity    =$row['quantity'];
                                                                $quantity++;
                                                            }
    
                                                            $query2 ="UPDATE book SET quantity ='$quantity' WHERE id='$book_id'";
                                                            $updateBookData = mysqli_query($db,$query2);
                                                            if( $updateBookData)
                                                            {
                                                               header("Location: order-details.php?do=Manage");
    
                                                            }
                                                            else
                                                            {
                                                                die("MySQL Error . " . mysqli_error($db));
                                                            }

                                                        }

                                        

                                                }
                                                }
                                            

                                ?>
                                 
                            </div>
                        </div>
                        <!-- Card-End-->

                   </div>
               </div>
           </div>
       </section>

</div>

<!-- Content Wrapper. Contains page content End -->


<?php include "inc/footer.php";  ?>
