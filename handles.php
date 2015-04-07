<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="css/responsive-calendar.css" rel="stylesheet" media="screen"/>
  <link href="css/bootstrap.datetimepicker.css" rel="stylesheet" media="screen"/>
  <link href="css/smallmodal.css" rel="stylesheet" media="screen"/>

  <style>
    .alert-sm
    {
        padding-top: 6px;
        padding-bottom: 6px;
    }
  </style>

</head>

<body>
<?php
  require('header.php');
?>

<div class="container">
	<div class="row" style="margin-top: 60px">

    <div class="col-md-6" style="margin-top: -20px">
		<h2>Manage QR Codes</h2>
		
		<?php
        $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") or die("Unable to connect to database");
        $query  = "SELECT * FROM handles;";
        $query  = "SELECT * FROM events;";
        $result = pg_query($dbLink, $query);
		?>


		<div class="panel-group" id="accordion">
			<?php while($row = pg_fetch_object($result)): ?>
				<div class="panel panel-default">
				<button id="deleteEvent" data-eventid="<?php echo $row->eventid; ?>" class="pull-right btn btn-danger">Delete</button>
               		        <button id="editEvent" data-eventid="<?php echo $row->eventid; ?>" class="pull-right btn btn-info">Edit</button>
				
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ++$i; ?>"><?php echo $row->title; ?></a>
						</h4>
					</div>

				<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse in">
					<div class="panel-body">                                              
	
     							 <p><img src="qr.php?event_id=<?php echo $row->handle_id; ?>"></p>

                                                        <p><?php echo $row->event_time_start; ?> - <?php echo $row->event_time_end; ?></p>

							<p><?php echo $row->description;?></p>

						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

    </div>
  </div>
</div>


</body>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/responsive-calendar.min.js"></script>
<script src="js/bootstrap.datetimepicker.min.js"></script>
<script src="js/signin.js"></script>
<script src="js/jquery.validate.min.js"></script>

