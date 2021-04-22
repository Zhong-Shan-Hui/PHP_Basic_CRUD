<?php
	
session_start();

$logged_in = false;
$autos = [];

if (isset($_SESSION['name']) ) {

	$logged_in = true;
	$status = false;

	if ( isset($_SESSION['status']) ) {
		$status = htmlentities($_SESSION['status']);
		$status_color = htmlentities($_SESSION['color']);

		unset($_SESSION['status']);
		unset($_SESSION['color']);
	}

	try 
	{
	    $pdo = new PDO("mysql:host=localhost;dbname=misc", "fred", "zap");
	    // set the PDO error mode to exception
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $all_autos = $pdo->query("SELECT * FROM autos");

		while ( $row = $all_autos->fetch(PDO::FETCH_OBJ) ) 
		{
		    $autos[] = $row;
		}
	}
	catch(PDOException $e)
	{
	    echo "Connection failed: " . $e->getMessage();
	    die();
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
	<title>Zhong Shan Hui</title>
	<link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"/> 
	</head>
	<body>
		<div class="container">
			<h1>Welcome to the Automobiles Database</h1>

			<?php if (!$logged_in) : ?>
				<p>
					<a href="login.php">Please log in</a>
				</p>
				<p>
					Attempt
					<a href="add.php">add data</a> 
					without logging in.
				</p>
			<?php else : ?>

				<?php
	                if ( $status !== false ) 
	                {
	                    // Look closely at the use of single and double quotes
	                    echo(
	                        '<p style="color: ' .$status_color. ';" class="col-sm-10">'.
	                            $status.
	                        "</p>\n"
	                    );
	                }
	            ?>

				<?php if (empty($autos)) : ?>
					<p>No rows found</p>
				<?php else : ?>
					<p>
						<table id="Table" class="table">
							<thead>
								<tr>
									<th>Make</th>
									<th>Model</th>
									<th>Year</th>
									<th>Mileage</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($autos as $auto) : ?>
			                        <tr>
			                        	<td><?php echo $auto->make; ?></td>
										<td><?php echo $auto->model; ?></td>
										<td><?php echo $auto->year; ?></td>
										<td><?php echo $auto->mileage; ?></td>
										<td><a href="edit.php?autos_id=<?php echo $auto->auto_id; ?>">Edit</a> / <a href="delete.php?autos_id=<?php echo $auto->auto_id; ?>">Delete</a></td>
			                        </tr>
			                    <?php endforeach; ?>
							</tbody>
						</table>
					</p>
				<?php endif; ?>
				<p>
					<a href="add.php">Add New Entry</a>
				</p>
				<p>
					<a href="logout.php">Logout</a>
				</p>

			<?php endif; ?>	
		</div>
    <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="http://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>		
    <script>
    $(document).ready( function () {
        $('#Table').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel',  'pdf'
        ]
    });
    });
    </script>
	</body>
</html>
