<?php
    require '../include/database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: events.php");
    }
     
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE events SET description = ?, location = ?, date =?, time =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($description,$location,$date,$time,$id));
            Database::disconnect();
            header("Location: events.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM events WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $description = $data['description'];
        $location = $data['location'];
        $date = $data['date'];
        $time = $data['time'];
        Database::disconnect();
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
    <div class="container">
     
        <div class="row">
			<div class="page-header">
				<h3>Update an Event</h3>
			</div>
        </div>
		
		<div class="row">
			<div class="col-md-6">
			
                <form class="form-horizontal" action="event_update.php?id=<?php echo $id?>" method="post">
				
                    <div class="form-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" placeholder="Describe your event"><?php echo !empty($description)?$description:'';?></textarea>
							<?php if (!empty($descriptionError)): ?>
                                <p class="help-block"><?php echo $descriptionError;?></p>
                            <?php endif; ?>
                        </div>
                    </div>
					
                    <div class="form-group <?php echo !empty($locationError)?'error':'';?>">
                        <label class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="location" type="text" placeholder="Event location" value="<?php echo !empty($location)?$location:'';?>">
                            <?php if (!empty($locationError)): ?>
                                <p class="help-block"><?php echo $locationError;?></p>
                            <?php endif;?>
                        </div>
                    </div>
					
                    <div class="form-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="date" type="text"  placeholder="XX/XX/XXXX" value="<?php echo !empty($date)?$date:'';?>">
                            <?php if (!empty($dateError)): ?>
                                <p class="help-block"><?php echo $dateError;?></p>
                            <?php endif;?>
                        </div>
                    </div>
					
                    <div class="form-group <?php echo !empty($timeError)?'error':'';?>">
                        <label class="col-sm-2 control-label">Time</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="time" type="text"  placeholder="XX:XX am/pm" value="<?php echo !empty($time)?$time:'';?>">
                            <?php if (!empty($timeError)): ?>
                                <p class="help-block"><?php echo $timeError;?></p>
                            <?php endif;?>
                        </div>
                    </div>
					  
                    <button type="submit" class="btn btn-success">Update</button>
                    <a class="btn btn-default" href="events.php">Back</a>
					
                </form>
         
			</div> <!-- col-md-6 -->
		</div> <!-- row -->	
		
    </div> <!-- /container -->
	
  </body>
</html>
