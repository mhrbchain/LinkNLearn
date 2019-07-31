<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Upload Test</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <p> <br/><br/> </p>
    <div class ="container">
	<?php 
		include "config.php";
			
		  if(isset($_FILES['files'])) {
			
			$name = $_FILES['files']['name'];
			$size = $_FILES['files']['size'];
			$type = $_FILES['files']['type'];
			$tmp  = $_FILES['files']['tmp_name'];
			$files = 'uploads/'.$_FILES['files']['name'];
			if(!file_exists($files)){ //is not file exists
				$size1 = 2 * 1024 * 1024 * 1024 * 1024;
				if($size<=$size1){ //is not file above 100kb
					
						$upload = move_uploaded_file($tmp,$files);
						
						if($upload){
						
							$add = $db->prepare("insert into em values('',?)");
							$add->bindParam(1,$name);
							
							if($add->execute()){
			 				?> 
								<div class="alert alert-success alert-dismissible" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  			  <strong>Success!</strong> File has been uploaded and saved to database.
								</div>
				
								<?php	
							} else{
								?> 
								<div class="alert alert-danger alert-dismissible" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  			  <strong>Failed!</strong> Failed to overwrite files to database.
								</div>
								<?php
							   }
						} else{
								?> 
								<div class="alert alert-warning alert-dismissible" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  			  <strong>Sorry!</strong> File has not been uploaded to the directory.
								</div>
								<?php
						}
				/*	} else{
						?> 
						<div class="alert alert-warning alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  			  <strong>Only image format [png, jpg, jpeg, gif] are allowed!</strong>
						</div>
						<?php
					}		*/
				} else{
						?> 
						<div class="alert alert-info alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  			  <strong>Files cannot be more than 100kb!</strong>
						</div>
						<?php
					}	
			} else{
						?> 
						<div class="alert alert-info alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  			  <strong>Sorry File already exists!</strong>
						</div>
						<?php
				}
		}
			
		?>

		<form method = "POST" enctype="multipart/form-data">
		  
		  <div class="form-group">
			 <label for="files">Upload File</label>
			 <input type="file" id="files" name="files" >
			 <p class="help-block">File here</p>
		  </div>
		  
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>
		
		<p><br/><br/></p>	
		
		<div class="row">
		 <?php
		 	if(isset($_GET['delete'])){
		 		$img = $_GET['delete'];
		 		$id = $_GET['id'];
		 		$delete = unlink('uploads/'.$img);
		 		if($delete){
		 			$hps = $db->prepare("delete from em where id ='$id'");
		 			if($hps->execute()){
			 								?> 
						<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  			  <strong>Success!</strong> File has been deleted from the directory and database.
						</div>
					<?php
		 			} else{
						?> 
						<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  			  <strong>Total Fail!</strong> File failed to be deleted from the database.
						</div>
					<?php
		 			}

		 		} else{
					?> 
					<div class="alert alert-warning alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  			  <strong>Error!</strong> File has not been deleted from the directory.
					</div>
				<?php
			   }
			}	

		  	$stmt = $db->prepare("select * from em");
		  	$stmt->execute();
		  	while($row = $stmt->fetch()){



		 ?>
		  <div class="col-sm-6 col-md-4">
			 <div class="thumbnail">
				<img style="height:200px;" src="uploads/<?php echo $row['file'] ?>" alt="<?php echo $row['file'] ?>" title="<?php echo $row['file'] ?>">
				<div class="caption text-center" >
				  <p><a href="?delete=<?php echo $row['file'] ?>&id=<?php echo $row['id'] ?>" class="btn btn-danger" role="button">Delete</a></p>
				</div>
			 </div>
		  </div>
		  <?php
		  	}
		  ?>
		</div>
			 	
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
