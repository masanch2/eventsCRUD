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
					<h3>Upcoming Events</h3>
				</div>
            </div>
			
            <div class="row">
                <p>
                    <a href="event_create.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Location</th>
                      <th>Description</th>
                      <th>Date</th>
					  <th>Time</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
					   include '../include/database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM events ORDER BY id DESC';
					   foreach ($pdo->query($sql) as $row) {
								echo '<tr>';
								echo '<td>'. $row['location'] . '</td>';
								echo '<td>'. $row['description'] . '</td>';
								echo '<td>'. $row['date'] . '</td>';
								echo '<td>'. $row['time'] . '</td>';
								echo '<td width=250>';
								echo '<a class="btn btn-default" href="event_read.php?id='.$row['id'].'">Read</a>';
								echo ' ';
								echo '<a class="btn btn-success" href="event_update.php?id='.$row['id'].'">Update</a>';
								echo ' ';
								echo '<a class="btn btn-danger" href="event_delete.php?id='.$row['id'].'">Delete</a>';
								echo '</td>';
								echo '</tr>';
					   }
					   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
