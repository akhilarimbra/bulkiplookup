<?php
	include 'include/functions.php';
	if(isset($_GET['ip'])){
		$url = "http://ipinfo.io/".$_GET['ip']."/json?token=e2f6f944bf2949";
		$json = file_get_contents($url);
		$obj = json_decode($json);
	}else{
		function get_ip_address() {
		    // check for shared internet/ISP IP
		    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
		        return $_SERVER['HTTP_CLIENT_IP'];
		    }

		    // check for IPs passing through proxies
		    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		        // check if multiple ips exist in var
		        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
		            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		            foreach ($iplist as $ip) {
		                if (validate_ip($ip))
		                    return $ip;
		            }
		        } else {
		            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
		                return $_SERVER['HTTP_X_FORWARDED_FOR'];
		        }
		    }
		    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
		        return $_SERVER['HTTP_X_FORWARDED'];
		    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
		        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
		        return $_SERVER['HTTP_FORWARDED_FOR'];
		    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
		        return $_SERVER['HTTP_FORWARDED'];

		    // return unreliable ip since all else failed
		    return $_SERVER['REMOTE_ADDR'];
		}
		$url = "http://ipinfo.io/".get_ip_address()."/json?token=e2f6f944bf2949";
		$json = file_get_contents($url);
		$obj = json_decode($json);
	}
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
        <h1 class="display-3" style="color:#ff8000;"><?php echo $obj->ip;?></h1><br><br>
        <h2>About this IP Address</h2>
        <br>
        <div class="row">
        	<div class="col-lg-3"></div>
        	<div class="col-lg-6">
				<table class="table table-hover">
				  <tbody>
				    <tr>
				      <th scope="row">Hostname</th>
				      <td><?php echo $obj->hostname;?><td>
				    </tr>
				    <tr>
				      <th scope="row">City</th>
				      <td><?php echo $obj->city;?></td>
				    </tr>
				    <tr>
				      <th scope="row">Region</th>
				      <td><?php echo $obj->region;?></td>
				    </tr>
				    <tr>
				      <th scope="row">Country</th>
				      <td><?php echo $obj->country;?></td>
				    </tr>
				    <tr>
				      <th scope="row">Location</th>
				      <td><?php echo $obj->loc;?></td>
				    </tr>
				    <tr>
				      <th scope="row">Organization</th>
				      <td><?php echo $obj->org;?></td>
				    </tr>
				    <tr>
				      <th scope="row">Postal</th>
				      <td><?php echo $obj->postal;?></td>
				    </tr>				
				  </tbody>
				</table>
        	</div>
			<div class="col-lg-3"></div>
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