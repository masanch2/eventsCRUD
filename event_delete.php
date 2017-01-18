<?php
    require '../include/database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
		
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM events WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM events WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: events.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
        <div class="row">
			<div class="page-header">
				<h3>Delete an Event</h3>
            </div>
       </div>
	   
	   <div class="row">
		<div class="col-md-6">
                     
                <form class="form-horizontal" action="event_delete.php" method="post">
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="alert alert-error">Are you sure to delete <strong><?php echo $data['description'];?>?</strong></p>
					  
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn btn-default" href="events.php">No</a>
                </form>
					
            </div>
		</div>
                 
    </div> <!-- /container -->
  </body>
</html>
