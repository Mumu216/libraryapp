<?php include "inc/header.php" ; ?>

     <!--  Book Details Section Start-->
     <section class="all-books">
           <div class="container">
               <div class="row">
                   <div class="col-lg-9">
                     <h2>Search Result - </h2>
                     <div class="row">
                     <?php
                       if( $_POST['searchBtn'])
                       {
                            $sContent =$_POST['search'];

                            $sql ="SELECT * FROM book WHERE title LIKE  '%$sContent%' OR description LIKE '%$sContent%' OR  author_name LIKE '%$sContent%' ORDER BY title ASC ";

                            $readData = mysqli_query($db, $sql);
                            $foundTotal = mysqli_num_rows($readData);

                            if( $foundTotal == 0)
                            {?>
                              <div class="alert alert-info">
                                 Sorry!!! No book found in your database regarding in your search topic - <b> <?php echo $sContent; ?></b>
                            </div>
                            <?php }
                              else
                              {
                                while($row = mysqli_fetch_assoc($readData))
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
                                          <a href="" class="book-btn">Book Now</a>


                                      </div>
                                  </div>
                                  
                            <?php   }

                               }

                              }
                            ?>
                        </div>
                    </div>

                     <!-- Sidebar start-->
                     <?php include "inc/sidebar.php" ; ?>
                   
                   <!-- Sidebar End-->

       </div>
    </div>
</section>

<?php include "inc/footer.php" ; ?>
