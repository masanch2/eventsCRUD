<?php
    require '../include/database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM events where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<!-- Set .checkbox { font-weight: 100 } -->
    <link   href="../css/task01.css" rel="stylesheet">
</head>
 
<body>

	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Read an Event</h3>
				</div>
			</div>
		</div>
	</div>
	
    <div class="container" id="main">
		<div class="row">
			<div class="col-md-6">
		
				<form class="form-horizontal" action="event_create.php" method="post">
			
					<div class="form-group">
						<label class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
							<label class="checkbox">
								<?php echo $data['description'];?>
							</label>
						</div>
					</div>
						
					<div class="form-group">
						<label class="col-sm-2 control-label">Location</label>
						<div class="col-sm-10">
                            <label class="checkbox">
                                <?php echo $data['location'];?>
                            </label>
                        </div>
					</div>
						
					<div class="form-group">
						<label class="col-sm-2 control-label">Date</label>
						<div class="col-sm-10">
                            <label class="checkbox">
                                <?php echo $data['date'];?>
                            </label>
                        </div>
					</div>
						
					<div class="form-group">
						<label class="col-sm-2 control-label">Time</label>
						<div class="col-sm-10">
                            <label class="checkbox">
                                <?php echo $data['time'];?>
                            </label>
                        </div>
					</div>
						  
					<a class="btn btn-default" href="events.php">Back</a>
							
				</form>
				
			</div> <!-- col-md-6 -->
                 
		</div> <!-- /container -->
		
	</body>
</html>
