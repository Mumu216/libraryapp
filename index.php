 <?php include "inc/header.php" ; ?>

       <!-- All Books Section Start-->
       <section class="all-books">
           <div class="container">
               <div class="row">
                   <!-- Books content start-->
                   <div class="col-lg-9">
                     <h2>Our All Book Collection</h2>
                       <div class="row">

                          <?php

                            $sql = "SELECT * FROM book WHERE status = 1 ORDER BY title ASC" ;
                            $allBooks = mysqli_query($db, $sql);
                            $totalBooks = mysqli_num_rows($allBooks);
                            if( $totalBooks <=0 ){?>
                              <div class= "alert alert-info"> Opps!!!! No Books Found Yet.......</div>
                        <?php } else{
                             while($row= mysqli_fetch_assoc( $allBooks))
                             {
                                $id                =$row['id'];
                                $title             =$row['title'];
                                $sub_title         =$row['sub_title'];
                                $description       =$row['description'];
                                $cat_id            =$row['cat_id'];
                                $author            =$row['author_name'];
                                $quantity          =$row['quantity'];
                                $image             =$row['image'];
                                $status            =$row['status'];
                                ?>

                                    <div class="col-lg-4 book-item">
                                      <div class="book-thumbnail">
                                         
                                      <?php
                                            if(!empty($image)) { ?>
                                               
                                             <img src="admin/dist/img/books/<?php  echo $image; ?>" class="img-fluid">
                                           <?php } 
 
                                           else{?>
                                              
                                             <img src="admin/dist/img/books/ default.jpg" class="img-fluid">
                                          <?php  }
                                          ?>

                                            <div class="author-info">
                                                <h4> <?php echo $author; ?></h4>
                                            </div>
                                      </div>
                                      <div class="book-info">
                                          <h4> <?php echo $title; ?></h4>
                                          <p class="sub_title"> <?php echo $sub_title; ?></p>
                                          <p class="quantity"> Quantity: <span><?php echo $quantity; ?>PCs</span> </p>
                                          <p><?php echo substr($description, 0,50);  ?>.... <a href="details.php?b=<?php echo $id;?>">Read More</a></p>

                                            <?php
                                              if(empty($_SESSION['email']))
                                              {?>
                                                  <a href="login.php" class="book-btn">Login to Reserve your Book</a>
                                              <?php }
                                              else{?>
                                                <a href="booking.php?id=<?php echo $id;  ?>" class="book-btn">Book Now</a>
                                            <?php  }
                                            ?>
                                        </div>
                                  </div>
                                  
                            <?php }

                            }

                           ?>
    
                         </div>
                       </div>
                   <!-- Books content End-->

                      <!-- Sidebar start-->
                     <?php include "inc/sidebar.php" ; ?>
                   
                     <!-- Sidebar End-->


               </div>

           </div>
       </section>
       <!-- All Books Section  End-->
    

<?php include "inc/footer.php" ; ?>
