<?php
     
    require '../include/database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $descriptionError = null;
        $locationError = null;
        $dateError = null;
        $timeError = null;
         
        // keep track post values
        $description = $_POST['description'];
        $location = $_POST['location'];
        $date = $_POST['date'];
        $time = $_POST['time'];
         
        // validate input
        $valid = true;
        if (empty($description)) {
            $descriptionError = 'Please enter Description';
            $valid = false;
        }
         
        if (empty($location)) {
            $locationError = 'Please enter Location';
            $valid = false;
        }
         
        if (empty($date)) {
            $dateError = 'Please enter Date';
            $valid = false;
        }
         
        if (empty($time)) {
            $timeError = 'Please enter Time';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO events (description,location,date,time) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($description,$location,$date,$time));
            Database::disconnect();
            header("Location: events.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!-- Set .help-block { font-color: a00 } -->
    <link   href="../css/task01.css" rel="stylesheet">
</head>
 
<body>

	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Create an Event</h3>
				</div>
			</div>
		</div>
	</div>
	
    <div class="container" id="main">
		<div class="row">
			<div class="col-md-6">
					
				<form class="form-horizontal" action="event_create.php" method="post">
						
					<div class="form-group <?php echo !empty($descriptionError)?'error':'';?>">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<textarea name="description" class="form-control" placeholder="Describe your event"><?php echo !empty($description)?$description:'';?></textarea>
							<?php if (!empty($descriptionError)): ?>
								<p class="help-block"><?php echo $descriptionError;?></p>
							<?php endif; ?>
						</div>
					</div>
							
					<div class="form-group <?php echo !empty($locationError)?'error':'';?>">
						<label class="col-sm-2 control-label">Location</label>
						<div class="col-sm-10">
							<input name="location" type="text" class="form-control" placeholder="Event Location" value="<?php echo !empty($location)?$location:'';?>">
							<?php if (!empty($locationError)): ?>
								<p class="help-block"><?php echo $locationError;?></p>
							<?php endif;?>
						</div>
					</div>
						  
					<div class="form-group <?php echo !empty($dateError)?'error':'';?>">
						<label class="col-sm-2 control-label">Date</label>
						<div class="col-sm-10">
							<input name="date" type="text" class="form-control" placeholder="XX/XX/XXXX" value="<?php echo !empty($date)?$date:'';?>">
							<?php if (!empty($dateError)): ?>
								<p class="help-block"><?php echo $dateError;?></p>
							<?php endif;?>
						</div>
					</div>
							
					<div class="form-group <?php echo !empty($timeError)?'error':'';?>">
						<label class="col-sm-2 control-label">Time</label>
						<div class="col-sm-10">
							<input name="time" type="text" class="form-control" placeholder="XX:XX am/pm" value="<?php echo !empty($time)?$time:'';?>">
							<?php if (!empty($timeError)): ?>
								<p class="help-block"><?php echo $timeError;?></p>
							<?php endif;?>
						</div>
					</div>
						  
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn btn-default" href="events.php">Back</a>
							
				</form>
					
			</div>
		</div> <!-- row -->
                 
    </div> <!-- /container -->
  </body>
</html>








