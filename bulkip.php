<?php
	include 'include/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	  <?php include 'include/style.php';?>
	  <title><?php echo getTitle();?></title>
  </head>
  <body>
    <div class="container-fluid">
	  <?php include 'include/nav.php';?>
      <div class="jumbotron">
        <div class="row">
        	<div class="col-lg-12">
				<table class="table table-hover">
				  <tbody>
				  	<tr style="color:#ff8000;">
				  		<td><b>IP</b></td>
				  		<td><b>Hostname</b></td>
				  		<td><b>City</b></td>
				  		<td><b>Region</b></td>
				  		<td><b>Country</b></td>
				  		<td><b>Location</b></td>
				  		<td><b>Organization</b></td>
				  		<td><b>Postal</b></td>
				  	</tr>
				  	<?php
				  		//code goes here
						$parts = explode(' ', $_GET['ip']);
						foreach ($parts as $key => $value) {
							$url = "http://ipinfo.io/".$value."/json?token=e2f6f944bf2949";
							$json = file_get_contents($url);
							$obj = json_decode($json);
							echo "<tr>";
							echo "<td>".$obj->ip."</td>";
							echo "<td>".$obj->hostname."</td>";
							echo "<td>".$obj->city."</td>";
							echo "<td>".$obj->region."</td>";
							echo "<td>".$obj->country."</td>";
							echo "<td>".$obj->loc."</td>";
							echo "<td>".$obj->org."</td>";
							echo "<td>".$obj->postal."</td>";
							echo "</tr>";
						}
				  	?>
				  </tbody>
				</table>
        	</div>
        </div>
		<form action="bulkip.php">
		  <fieldset>
		    <label for="exampleTextarea"><h2 style="color:#0099ff;">Enter Bulk IP Addresses Here</h2></label>
		    <textarea class="form-control" id="exampleTextarea" rows="17" required name="ip"></textarea>
		  </fieldset><br>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
      </div>

      <footer class="footer">
        <p><?php echo getFooter();?></p>
      </footer>

    </div> <!-- /container -->

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>