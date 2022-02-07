<?php include "inc/header.php"; ?>

	<!-- Content Wrapper Start -->
  	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">All Category and Sub Category for the Books</h1>
	          </div>
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
	              <li class="breadcrumb-item active">Manage All Category</li>
	            </ol>
	          </div>
	        </div>
	      </div>
	    </div>
	    <!-- /.content-header -->

	    <!-- Main content -->
	    <section class="content">
	      	<div class="container-fluid">
		        <div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						
						<?php 
							// Ternary Condition [ Condition ? True : False ]
							$do = isset($_GET['do']) ? $_GET['do'] : "Manage";

							// All Users Manage Page
							if ( $do == "Manage" )
							{ 
								?>
									
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">All Category and Sub Category Manage</h3>

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
										      <th scope="col">#Sl.</th>
										      <th scope="col">Category Name</th>
										      <th scope="col">Description</th>
										      <th scope="col">Category / Sub Category</th>
										      <th scope="col">Status</th>
										      <th scope="col">Action</th>
										    </tr>
										  </thead>
										  <tbody>

	<?php
		$sql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC";
		$allCat = mysqli_query($db, $sql);
		$i = 0;

		while ( $row = mysqli_fetch_assoc($allCat) ) {
			$cat_id 		= $row['cat_id'];
			$cat_name 		= $row['cat_name'];
			$cat_desc 		= $row['cat_desc'];
			$is_parent 		= $row['is_parent'];
			$status 		= $row['status'];
			$i++;
			?>
			<tr>
	      <th scope="row"><?php echo $i; ?></th>
	      <td><?php echo $cat_name; ?></td>
	      <td><?php echo $cat_desc; ?></td>
	      <td>
	      	<?php 
	      		if ( $is_parent == 0 )
	      		{ ?>
	      			<span class="badge badge-success">Primary Category</span>
	      		<?php }
	      		else
	      		{ ?>
	      			<span class="badge badge-primary">Sub Category</span>
	      		<?php }
	      	?>
	      </td>
	      <td>
			<?php 
	      		if ( $status == 1 )
	      		{ ?>
	      			<span class="badge badge-success">Active</span>
	      		<?php }
	      		else if ( $status == 2 )
	      		{ ?>
	      			<span class="badge badge-danger">Inactive</span>
	      		<?php }
	      	?>
	      </td>
	      <td>
	      	<div class="table-action">
	      		<ul>
	      			<li><a href="category.php?do=Edit&cat_id=<?php echo $cat_id; ?>"><i class="fa fa-edit"></i></a></li>
	      			<li><a href="" data-toggle="modal" data-target="#delParCat<?php echo $cat_id; ?>"><i class="fa fa-trash"></i></a></li>
	      		</ul>

	      		<!-- Delete Parent Category Modal -->
				<div class="modal fade" id="delParCat<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Do You Confirm to Delete this Parent Category?</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="modal-buttons">
				        	<ul>
				        		<li>
				        			<a href="category.php?do=Delete&cat_id=<?php echo $cat_id; ?>" class="btn btn-danger">Confirm</a>
				        		</li>
				        		<li>
				        			<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
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





	    <!-- Sub Category Check Start -->
	    <?php  
	    	$sql = "SELECT * FROM category WHERE is_parent = '$cat_id' ORDER BY cat_name ASC";
				$allSubCat = mysqli_query($db, $sql);

				while ( $row = mysqli_fetch_assoc($allSubCat) ){
				$cat_id 		= $row['cat_id'];
	  			$cat_name 		= $row['cat_name'];
	  			$cat_desc 		= $row['cat_desc'];
	  			$is_parent 		= $row['is_parent'];
	  			$status 		= $row['status'];
	  			
	  			?>
	  			<tr>
	      <th scope="row"></th>
	      <td>-- <?php echo $cat_name; ?></td>
	      <td><?php echo $cat_desc; ?></td>
	      <td>
	      	<?php 
	      		if ( $is_parent == 0 )
	      		{ ?>
	      			<span class="badge badge-success">Primary Category</span>
	      		<?php }
	      		else
	      		{ ?>
	      			<span class="badge badge-primary">Sub Category</span>
	      		<?php }
	      	?>
	      </td>
	      <td>
			<?php 
	      		if ( $status == 1 )
	      		{ ?>
	      			<span class="badge badge-success">Active</span>
	      		<?php }
	      		else if ( $status == 2 )
	      		{ ?>
	      			<span class="badge badge-danger">Inactive</span>
	      		<?php }
	      	?>
	      </td>
	      <td>
	      	<div class="table-action">
	      		<ul>
	      			<li><a href="category.php?do=Edit&cat_id=<?php echo $cat_id; ?>"><i class="fa fa-edit"></i></a></li>
	      			
	      			<li><a href="" data-toggle="modal" data-target="#delChildCat<?php echo $cat_id; ?>"><i class="fa fa-trash"></i></a></li>
	      		</ul>

	      		<!-- Delete Child Category Modal -->
				<div class="modal fade" id="delChildCat<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Do You Confirm to Delete this Parent Category?</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="modal-buttons">
				        	<ul>
				        		<li>
				        			<a href="category.php?do=Delete&cat_id=<?php echo $cat_id; ?>" class="btn btn-danger">Confirm</a>
				        		</li>
				        		<li>
				        			<button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
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
			<?php	}
	    ?>
	    <!-- Sub Category Check End -->


	<?php	}
	?>
																			    
										  </tbody>
										</table>									
									</div>
								</div>


								<?php 
							}


							else if ( $do == "Add" )
							{
								?>

								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Add New Category</h3>

										<div class="card-tools">
										  	<button type="button" class="btn btn-tool" data-card-widget="collapse">
										    	<i class="fas fa-minus"></i>
										  	</button>
										</div>
									</div>
									
									<div class="card-body">
										<form action="category.php?do=Store" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label>Category Name</label>
												<input type="text" name="name" class="form-control" placeholder="Category Title..." required="required" autocomplete="off">
											</div>

											<div class="form-group">
												<label>Description (Optional)</label>
												<textarea class="form-control" name="desc"></textarea>
											</div>

											<div class="form-group" >
												<label>Parent Category</label>
												<select class="form-control" name="is_parent">
													<option value="0">Please Select the Parent Category</option>
													<?php 
														$sql = "SELECT * FROM category WHERE is_parent = 0";
														$parentCat = mysqli_query($db, $sql);

														while( $row = mysqli_fetch_assoc($parentCat) ){
															$cat_id 	= $row['cat_id'];
															$cat_name 	= $row['cat_name'];
															?>
															<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
													<?php	}
													?>
												</select>
											</div>

											<div class="form-group" >
												<label>Category Status</label>
												<select class="form-control" name="status">
													<option value="1">Please Select the Status</option>
													<option value="1">Active</option>
													<option value="2">Inactive</option>
												</select>
											</div>

											<div class="form-group">
												<input type="submit" class="btn btn-success" value="Add New Category" name="addCat">
											</div>
										</form>
									
									</div>
								</div>

								<?php
							}


							else if ( $do == "Store" )
							{
								if ( isset($_POST['addCat']) )
								{
									$name 			= $_POST['name'];
									$desc 			= $_POST['desc'];
									$is_parent 		= $_POST['is_parent'];
									$status 		= $_POST['status'];

									$sql = "INSERT INTO category (cat_name, cat_desc, is_parent, status) VALUES ('$name', '$desc', '$is_parent', '$status')";

									$addCategory = mysqli_query($db, $sql);

									if ( $addCategory ){
										header("Location: category.php?do=Manage");
									}
									else{
										die( "MySQL Query Failed." . mysqli_error($db) );
									}

								}
							}


							else if ( $do == "Edit" )
							{
								if ( isset($_GET['cat_id']) ){
									$updateID = $_GET['cat_id'];
									echo $updateID ;
									$sql = "SELECT * FROM category WHERE cat_id = '$updateID'";
									$readData = mysqli_query($db, $sql);

									while( $row = mysqli_fetch_assoc($readData) ){
										$cat_id 		= $row['cat_id'];
							  			$cat_name 		= $row['cat_name'];
							  			$cat_desc 		= $row['cat_desc'];
							  			$is_parent 		= $row['is_parent'];
							  			$status 		= $row['status'];
							  			?>

							  			<div class="card">
											<div class="card-header">
												<h3 class="card-title">Add New Category</h3>

												<div class="card-tools">
												  	<button type="button" class="btn btn-tool" data-card-widget="collapse">
												    	<i class="fas fa-minus"></i>
												  	</button>
												</div>
											</div>
											
											<div class="card-body">
												<form action="category.php?do=Update" method="POST" enctype="multipart/form-data">
													<div class="form-group">
														<label>Category Name</label>
														<input type="text" name="name" class="form-control" placeholder="Category Title..." required="required" autocomplete="off" value="<?php echo $cat_name; ?>">
													</div>

													<div class="form-group">
														<label>Description (Optional)</label>
														<textarea id="description" class="form-control" name="desc"><?php echo $cat_desc; ?></textarea>
													</div>

													<div class="form-group" >
														<label>Parent Category</label>
														<select class="form-control" name="is_parent">

															<?php 

																// Primary Category 
																if ( $is_parent == 0 )
																{
																	$sql = "SELECT cat_id AS 'pCatID', cat_name AS 'pCatName' FROM category  ORDER BY cat_name ASC";
																	$parentCat = mysqli_query($db, $sql);
																	while( $row = mysqli_fetch_assoc($parentCat) )
																	{
																		extract($row);
																		?>
																			<option value="0"
																				<?php 
																					if ( $pCatID == $updateID )
																					{
																						echo 'selected';
																					}
																					
																				?>
																			><?php echo $pCatName; ?></option>
																		<?php						
																	}
																}

																// Sub Category
																else {
																	$sql = "SELECT cat_id AS 'cCatID', cat_name AS 'cCatName' FROM category WHERE is_parent = 0 ORDER BY cat_name ASC";
																	$childCat = mysqli_query($db, $sql);
																	while( $row = mysqli_fetch_assoc($childCat) )
																	{
																		extract($row);
																		?>
																			<option value="<?php echo $cCatID; ?>"
																				<?php 
																					if ( $cCatID == $is_parent )
																					{
																						echo 'selected';
																					}
																				?>
																			><?php echo $cCatName; ?></option>
																		<?php						
																	}
																}

															?>



																

														</select>
													</div>

													<div class="form-group" >
														<label>Category Status</label>
														<select class="form-control" name="status">
															<option value="1">Please Select the Status</option>
															<option value="1" <?php if ( $status == 1 ) { echo 'selected'; } ?> >Active</option>
															<option value="2" <?php if ( $status == 2 ) { echo 'selected'; } ?> >Inactive</option>
														</select>
													</div>

													<div class="form-group">
														<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
														<input type="submit" class="btn btn-success" value="Save Changes" name="updateCat">
													</div>
												</form>
											</div>
										</div>
								<?php	}
								}
							}


							else if ( $do == "Update" )
							{
								if ( isset($_POST['updateCat']) )
								{
									$cat_id 		= $_POST['cat_id'];
									$name 			= $_POST['name'];
									$desc 			= $_POST['desc'];
									$is_parent 		= $_POST['is_parent'];
									$status 		= $_POST['status'];
									$sql = "UPDATE category SET cat_name='$name', cat_desc='$desc', is_parent='$is_parent', status='$status' WHERE cat_id = '$cat_id'";
									$updateCategory = mysqli_query($db, $sql);
									if ( $updateCategory ){
										header("Location: category.php?do=Manage");
									}
									else{
										die( "MySQL Query Failed." . mysqli_error($db) );
									}
								}
							}


							else if ( $do == "Delete" )
							{
								if ( isset($_GET['cat_id']) )
								{
									$delID = $_GET['cat_id'];

									// To Check either this delete category id is parent or sub category

									$sql = "SELECT * FROM category WHERE cat_id = '$delID'";
									$delData = mysqli_query($db, $sql);

									while ( $row = mysqli_fetch_assoc($delData) ) 
									{
										$cat_id 		= $row['cat_id'];
										$is_parent 		= $row['is_parent'];

										// Single Sub Category Item Delete
										if ( $is_parent != 0 )
										{
											$sql = "DELETE FROM category WHERE cat_id = '$delID'";
											$deleteSubCat = mysqli_query($db, $sql);

											if ( $deleteSubCat )
											{
												header("Location: category.php?do=Manage");
											}
											else
											{
												die( "MySQLi Error. " . mysqli_error($db) );
											}
										}

										// Delete Parent Category and all Its Sub Category
										else if ( $is_parent == 0 )
										{
											$sql = "SELECT * FROM category WHERE is_parent = '$cat_id'";
											$dataAllSubCat = mysqli_query($db, $sql);
											while( $row = mysqli_fetch_assoc($dataAllSubCat) )
											{
												$subCatID = $row['cat_id'];

												$delSubCatsql = "DELETE FROM category WHERE cat_id = '$subCatID'";		
												$delSubCat = mysqli_query($db, $delSubCatsql);										
											}
											$sql = "DELETE FROM category WHERE cat_id = '$delID'";
											$deleteParentCat = mysqli_query($db, $sql);

											if ( $deleteParentCat )
											{
												header("Location: category.php?do=Manage");
											}
											else
											{
												die( "MySQLi Error. " . mysqli_error($db) );
											}


										}
									}
								}
							}

						?>

					</div>
		      	</div>
	  		</div>
		</section>

	</div>
	<!-- Content Wrapper End -->

<?php include "inc/footer.php"; ?>