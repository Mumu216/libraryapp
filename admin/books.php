<?php include "inc/header.php";  ?>

        <!-- Content Wrapper. Contains page content start -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Book's Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Book's Management</li>
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

                    <?php
                      $do = isset($_GET['do']) ?  $_GET['do'] : "Manage" ;
                      if($do == "Manage" )
                      {
                        ?>
                        <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Manage All Book</h3>
          
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <table class="table table-dark table-bordered table-hover table-striped">
                                  <thead>
                                  <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Thumbnail</th>
                                      <th scope="col">Title</th>
                                      <th scope="col">Sub Title</th>
                                      <th scope="col">Author Name</th>
                                      <th scope="col">Category Name</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Status</th>
                                      <th scope="col">Action</th>



                                  </tr>
                                  </thead>
                                  <tbody>

                                        <?php  
                                         
                                         $sql = "SELECT * FROM book WHERE status = 1 ORDER BY title ASC";

                                         $allData= mysqli_query($db,$sql);
                                         $numOfBooks = mysqli_num_rows($allData);

                                         if ($numOfBooks==0)
                                         {?>

                                            <div class="alert alert-info">
                                              opps!!! No Book Found in our Library. Please Add a Book First.

                                            </div>
                                      <?php }

                                         else
                                         {

                                          $i=0;
                                          while ($row = mysqli_fetch_assoc( $allData)) 
                                        
                                      {             
                                          $id                =$row['id'];
                                          $title             =$row['title'];
                                          $sub_title         =$row['sub_title'];
                                          $description       =$row['description'];
                                          $cat_id            =$row['cat_id'];
                                          $author_name       =$row['author_name'];
                                          $quantity          =$row['quantity'];
                                          $image             =$row['image'];
                                          $status            =$row['status'];
                                          $i++;
 
                                          ?>  
 
                                      <tr>
                                       <th scope="row"><?php echo $i;  ?></th>
                                       <td>
                                           <?php
                                            if(!empty($image)) { ?>
                                               
                                             <img src="dist/img/books/<?php  echo $image; ?>" width="35">
                                           <?php } 
 
                                           else{?>
                                              
                                             <img src="dist/img/books/ default.jpg" width="35">
                                          <?php  }
                                          ?>
                                       </td>
                                       <td><?php echo $title;  ?></td>
                                       <td> <?php echo $sub_title;?></td>
                                       <td><?php echo $author_name;?></td>
                                       <td>
                                         
                                         <?php 

                                           $sql ="SELECT * FROM category WHERE cat_id = $cat_id" ;
                                           $categoryName = mySqli_query($db,$sql);

                                           while($row= mysqli_fetch_assoc($categoryName))
                                           {
                                              $cat_id   =$row['cat_id'];
                                              $cat_name   =$row['cat_name'];
                                              ?>
                                              <span class="badge badge-info"><?php echo $cat_name;  ?></span>

                                          <?php }


                                          ?>
                                      
                                       </td>
                                       <td><?php echo $quantity;?> Pcs</td>
 
                                      <td>
                                        <?php
                                          if( $status==2) 
                                          { ?>  
 
                                                <span class="badge badge-danger">Inactive </span>
                                                
                                         <?php   }
 
                                       else if($status==1)
                                       { ?>
                                         
                                         <span class="badge badge-success"> Active </span>
                                      <?php   }
                                       ?>
                                       </td>
                                       <td>
 
                                       <div class="table-action">
                                           <ul>
                                           
                                           <li> <a href="books.php?do=Edit&uid=<?php echo $id; ?>"><i class="fa fa-edit"></i></a>
                                           </li>
                                           <li> <a href="books.php?do=Delete&uid=<?php echo $id; ?>" data-toggle="modal" data-target="#delUserId<?php echo $user_id;?>"><i class="fa fa-trash"></i></a>
                                           </li>
                                           </ul>
 
                                           <!-- Modal-->
 
 
                                           <div class="modal fade" id="delUserId<?php echo $user_id;  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                           <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                               <div class="modal-header">
                                                 <h5 class="modal-title" id="exampleModalLabel">Do you confirm to delete this User</h5>
                                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                 </button>
                                               </div>
                                               <div class="modal-body">
                                                  <div class="modal-buttons">
                                                    <ul>
                                                      <li>
                                                        <a href="users.php?do=Delete&user_id=<?php echo $user_id; ?>"  class="btn btn-success">Confirm</a>
                                                      </li>
                                                      <li>
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
 
                                                      </li>
                                                    </ul>
 
                                                  </div>
                                               </div>
                                             </div>
                                           </div>  
                                         </div>
                                          </div>
                                       </td>
                                    </tr>
 
                                            
                       <?php   }
 
                          ?>
                     </tbody>
                     </table>
                       </div>
                     </div>
                   
                        <?php
                     }
                                       
                    }
                                      
                       
                     else if ( $do == "Add")

                      {
                        ?>
                              
                       <div class="card">
                         <div class="card-header">
                           <h3 class="card-title">Register A New Book</h3>
                         </div>
                         <div class="card-body">
                           <div class="row">
                             <div class="col-lg-6">

                             <form action="books.php?do=Store" method="POST" enctype="multipart/form-data">
                             <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" name="title" class="form-control" placeholder="Title of the book......" required="required" autocomplete="off" >
                             </div>
                                
                
                             <div class="form-group">
                                 <label>Sub Title</label>
                                 <input type="text" name="sub_title" class="form-control" placeholder="Sub Title..." required="required" autocomplete="off">
                             </div>

                             <div class="form-group">
                                 <label>Author Name</label>
                                 <input type="text" name="author_name" class="form-control" placeholder="Name of the Author..." required="required" autocomplete="off">
                             </div>

                             <div class="form-group">
                                 <label>Quantity</label>
                                 <input type="text" name="quantity" class="form-control" placeholder="Quantity..." required="required" autocomplete="off">
                             </div>

                             <div class="form-group">
                               <labe> Category Name</label>
                               <select class="form-control" name="cat_id">
                               <option> Please the Category or Sub Category Name</option>
                               <?php

                               $sql = "SELECT * FROM category WHERE is_parent=0 ORDER BY cat_name ASC";
                               $parentCat = mysqli_query($db,$sql);
                               while($row = mysqli_fetch_assoc($parentCat)){

                                $p_cat_id      =$row['cat_id'];
                                $p_cat_name    =$row['cat_name'];
                                ?>
                                  
                               <option value="<?php echo $p_cat_id; ?>"> <?php echo $p_cat_name;   ?></option>

                               <!-- Sub Category starts-->
                          
                          <?php 

                              $query = "SELECT * FROM category WHERE is_parent= '$p_cat_id' ORDER BY cat_name ASC";
                              $childCat = mysqli_query($db, $query);
                              while($row = mysqli_fetch_assoc($childCat))
                              {
                                $c_cat_id      =$row['cat_id'];
                                $c_cat_name    =$row['cat_name'];
                                ?>
                                  
                               <option value="<?php echo $c_cat_id; ?>"> --<?php echo $c_cat_name; ?></option>


                           <?php   }
                      
                           } 
                            ?>
                               </select>
                            </div>

                            <div class="form-group">
                                 <label>Book Status</label>
                                  <select class="form-control" name="status">
                                    <option value="1">Please Select Book Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">InActive</option>
                                   </select>
                             </div>
                         </div>

          
                           <div class="col-lg-6">
                               <div class="form-group">
                                 <label>Description</label>
                                 <textarea id="description" class="form-control" name="description"  rows="5"></textarea>
                             </div>

                            <div class="form-group">
                                <label> Thumbnail </label>
                                 <input type="file" name="image" class="form-control-file">
                               </div>

                               <div class="form-group">
                                 <input type="submit" name="addBook" class="btn btn-success" value="Register the Book">
                                 </div>

                               </div>

                           </div>
                           </form>
                      </div>
                   </div>

                   <?php
                 }
                    


                      else if( $do == "Store")
                      {
                         
                        if (isset($_POST['addBook']))
                        { 
                           $title              = mysqli_real_escape_string($db, $_POST['title']);
                           $sub_title          = mysqli_real_escape_string($db, $_POST['sub_title']);
                           $author_name        =$_POST['author_name'];
                           $quantity           =$_POST['quantity'];
                           $cat_id             =$_POST['cat_id'];
                           $description        = mysqli_real_escape_string($db, $_POST['description']);
                           $status             =$_POST['status'];

                          
                           $image           =$_FILES['image']['name'];
                           $image_temp      =$_FILES['image']['tmp_name'];

                             if(!empty($image))
                             {
                                
                                $image_name     =rand(1,999999) .  '_' . $image;

                                 move_uploaded_file ($image_temp, "dist/img/books/$image_name");
                             
                                $sql ="INSERT INTO book(title	,sub_title,	description,cat_id	,author_name, quantity,	image,	status) VALUES ('$title','$sub_title','$description','$cat_id','$author_name','$quantity', '$image_name', '$status')";
                                
                                 
                                $registerBook = mysqli_query($db,$sql) ;

                                 if($registerBook) {
                                   header("Location: books.php?do=Manage");
                                 } 
                                 else{
                                   
                                 die("MySQli Error. "  . mysqli_error($db));

                                 }

                                }

                              else 
                              {
                              $sql ="INSERT INTO book(title	,sub_title,	description	,cat_id	,author_name,	quantity,	status) VALUES ('$title','$sub_title','$description','$cat_id','$author_name','$quantity', '$status')";
                                 
                              $registerBook = mysqli_query($db,$sql) ;

                              if($registerBook) {
                                header("Location: books.php?do=Manage");
                              }else{
                                 die("MySQli Error. "  . mysqli_error($db));
                              }
                      
                             }

                   }
                         
                      }
                      

                      else if( $do == "Edit")
                      {
                          if(isset($_GET['uid']))
                          {
                            $updateID = ($_GET['uid']);
                            
                            $sql = "SELECT * FROM book WHERE id = '$updateID'" ;
                            $userData = mysqli_query($db,$sql);
                            while($row = mysqli_fetch_assoc($userData))

                             {
                                    $id                 =$row['id'];
                                    $title              =$row['title'];
                                    $sub_title          =$row['sub_title'];
                                    $description        =$row['description'];
                                    $author_name        =$row['author_name'];
                                    $quantity           =$row['quantity'];
                                    $status             =$row['status'];
                                    $image              =$row['image'];
                                    ?>

                                     <!-- HTML FROM STart-->

                        <div class="card">
                         <div class="card-header">
                           <h3 class="card-title">Manage All Book</h3>
                         </div>
                         <div class="card-body">
                           <div class="row">
                             <div class="col-lg-6">

                             <form action="books.php?do=Update" method="POST" enctype="multipart/form-data">
                             <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" name="title" class="form-control" placeholder="Title of the book......" required="required" autocomplete="off" value="<?php echo $title;?>">
                             </div>
                                
                
                             <div class="form-group">
                                 <label>Sub Title</label>
                                 <input type="text" name="sub_title" class="form-control" placeholder="Sub Title..." required="required" autocomplete="off" value="<?php echo $sub_title; ?>">
                             </div>

                             <div class="form-group">
                                 <label>Author Name</label>
                                 <input type="text" name="author_name" class="form-control" placeholder="Name of the Author..." required="required" autocomplete="off" value="<?php echo $author_name; ?>">
                             </div>

                             <div class="form-group">
                                 <label>Quantity</label>
                                 <input type="text" name="quantity" class="form-control" placeholder="Quantity..." required="required" autocomplete="off" value="<?php echo $quantity; ?>">
                             </div>

                             <div class="form-group">
                               <labe> Category Name</label>
                               <select class="form-control" name="cat_id">
                               <option> Please the Category or Sub Category Name</option>
                               <?php

                               $sql = "SELECT * FROM category WHERE is_parent=0 ORDER BY cat_name ASC";
                               $parentCat = mysqli_query($db,$sql);
                               while($row = mysqli_fetch_assoc($parentCat)){

                                $p_cat_id      =$row['cat_id'];
                                $p_cat_name    =$row['cat_name'];
                                $is_parent    = $row['is_parent'];

                                ?>
                                  
                               <option value="<?php echo $p_cat_id; ?>"> <?php echo $p_cat_name;   ?></option>

                               <!-- Sub Category starts-->
                          
                          <?php 

                              $query = "SELECT * FROM category WHERE is_parent= '$p_cat_id' ORDER BY cat_name ASC";
                              $childCat = mysqli_query($db, $query);
                              while($row = mysqli_fetch_assoc($childCat))
                              {
                                $c_cat_id      =$row['cat_id'];
                                $c_cat_name    =$row['cat_name'];
                                $is_parent    = $row['is_parent'];
                                ?>
                                  
                               <option value="<?php echo $c_cat_id; ?>"> --<?php echo $c_cat_name; ?></option>


                           <?php   }
                      
                           } 
                            ?>
                               </select>
                            </div>

                            <div class="form-group">
                                 <label>Book Status</label>
                                  <select class="form-control" name="status">
                                    <option value="1">Please Select Book Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">InActive</option>
                                   </select>
                             </div>
                         </div>

          
                           <div class="col-lg-6">
                               <div class="form-group">
                                 <label>Description</label>
                                 <textarea id="description" class="form-control" name="description"  rows="5" value="<?php echo $description; ?>"></textarea>
                             </div>

                                           
                             <div class="form-group">
                                <label> Profile picture</label>
                                 <br>
                                <?php
                                   if(!empty($image)) { ?>
                                    <img src="dist/img/books/<?php  echo $image; ?>" width="35">
                                          <?php } 

                                          else{?>
                                             
                                           <p>No Profile picture Uploaded</p>
                                         <?php  }
                                         ?>
                                         <br><br>
                                <input type="file" name="image" class="form-control-file">
                               </div>

                               <div class="form-group">
                                 <input type="hidden" name="id" value="<?php echo $id;  ?>">
                                 <input type="submit" name="updateBook" class="btn btn-success" value="Save Changes">

                               </div>

                               </div>

                           </div>
                           </form>
                      </div>
                   </div>
                  
                                     <!-- HTML FROM End-->

                                    
                            <?php
                             }
                          }
                      }

                      else if( $do == "Update")
                      {
                          if(isset($_POST['updateBook']))
                          {
                            $id                  =$_POST['id'] ;
                            $title               =mysqli_real_escape_string($db, $_POST['title']);
                            $sub_title           =mysqli_real_escape_string($db, $_POST['sub_title']);
                            $description         =mysqli_real_escape_string($db, $_POST['description']);
                            $cat_id              =$_POST['cat_id'];
                            $author_name         =$_POST['author_name'];
                            $quantity            =$_POST['quantity'];
                            $status              =$_POST['status'];

                     

                            $image          =$_FILES['image']['name'];
                            $image_temp     =$_FILES['image']['tmp_name'];

                          
                           if(!empty($image))
                           {
                             //Delete Existing Image if user change image
                             $sql = "SELECT * FROM book WHERE id = '$id' ";
                             $oldImage = mysqli_query($db, $sql);
                             while($row = mysqli_fetch_assoc($oldImage))
                             {
                               $exisitingImage = $row['image'];
                               unlink("dist/img/books/" . $exisitingImage);
                             }
       
                            //Upload New Image
                             $image_name = rand(1, 9999999) . "_" . $image;
                             move_uploaded_file($image_temp, "dist/img/books/$image_name");
       
                             $UpdateSql = "UPDATE book SET title = '$title', sub_title= '$sub_title', description = '$description', cat_id = '$cat_id', author_name = '$author_name', quantity = '$quantity', status = '$status', image = '$image_name'  WHERE id = '$id' ";
       
                             $UpdateQuery = mysqli_query($db, $UpdateSql);
       
                             if( $UpdateQuery )
                             {
                               header("Location: books.php?do=Manage");
                             }
                             else
                             {
                               die("MySQLi Error" . mysqli_error($db) );
                             }
       
                           }
                           else
                           {
                             $UpdateSql = "UPDATE book SET title = '$title', sub_title= '$sub_title', description = '$description', cat_id = '$cat_id', author_name = '$author_name', quantity = '$quantity', status = '$status'  WHERE id = '$id' ";
                             $UpdateQuery = mysqli_query($db, $UpdateSql);
       
                             if( $UpdateQuery )
                             {
                               header("Location: books.php?do=Manage");
                             }
                             else
                             {
                               die("MySQLi Error" . mysqli_error($db) );
                             }
                           }
                         }
                     }
                        

                           
                      

                      else if( $do == "Delete")
                      {
                         
                          if(isset($_GET['id']))  {
                          $deleteID= $_GET['id'];
                          //Delete SQL Command
                          $deletesql= "DELETE  FROM book WHERE id= '$deleteID'" ;
                    
                          $deleteData = mysqli_query($db, $deletesql) ;
                              
                          if($deleteData) {
                             
                            header( "Location: users.php?do=Manage");
                          } else{
                               die("MySQLi Error. "  .  mysqli_error($db) )  ;
                          }
                    
                          
                      }
                    }
            
                        ?>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Content Wrapper. Contains page content End -->






<?php include "inc/footer.php";  ?>
