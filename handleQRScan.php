<!DOCTYPE html>
<html lang="en">

<head>
  <title>4get-me-not</title>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
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
$dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") or die("Unable to connect to database");
$query  = "SELECT * FROM handles WHERE handle_id='". $_GET['event_id'] ."';";
$result = pg_query($dbLink, $query);
$row = pg_fetch_object($result)
?>

<form action="tagEvent.php" method="post">
	<input name="EventName" class="btn" type="text" disabled="true" value="<?php echo $row->title; ?>"/><br />
	<input name="handle_id" type="hidden" value="<?php echo $row->handle_id; ?>">
	
	<!--<input name="TimeAdjustment" type="radio" value="0">Now
	<input name="TimeAdjustment" type="radio" value="30">30 Minutes Ago
	<input name="TimeAdjustment" type="radio" value="60">1 Hour Ago
	<input name="TimeAdjustment" type="radio" value="120">2 Hour Ago<br />-->
	
	<div class="btn-group" data-toggle="buttons">
		  <label class="btn btn-primary active">
			<input type="radio" name="TimeAdjustment" value="0" id="a0" autocomplete="off" checked> Now
		  </label>
		  <label class="btn btn-primary">
			<input type="radio" name="TimeAdjustment" value="30" id="a30" autocomplete="off"> 30 Minutes Ago
		  </label>
		  <label class="btn btn-primary">
			<input type="radio" name="TimeAdjustment" value="60" id="a60" autocomplete="off"> 1 Hour Ago
		  </label>
	</div>
	
	<br />
	<input class="btn btn-info" type="submit" value="Add Event"/>
</form>


Need a list of all events with the same event_handle_id
<?php 
    $dbLink = pg_connect("host=127.0.0.1 dbname=dev1 user=postgres") or die("Unable to connect to database");
	$query_events  = "SELECT * FROM events WHERE handle_id='". $_GET['event_id'] ."'";
	$result_events = pg_query($dbLink, $query_events);

	while ($events = pg_fetch_object($result_events)): ?>
			<p><?php echo $events->event_time_start; ?> - <?php echo $events->event_time_end; ?></p>
<?php endwhile; ?>


</body>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/bootstrap.datetimepicker.min.js"></script>
<script src="js/signin.js"></script>
<script src="js/jquery.validate.min.js"></script>


