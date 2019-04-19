<?php 
require_once 'php_action/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
	header('location: dashboard.php');
}

$errors = array();

if($_POST) {

	$loginid = $_POST['loginid'];
	$password = $_POST['password'];

	if(empty($loginid) || empty($password)) {
		if($loginid == "") {
			$errors[] = "Login-id is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} 
	else {
		$loginid = strtolower($loginid);
		$sql = "SELECT * FROM hosteladmin WHERE loginid = '$loginid'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			// exists
			$mainSql = "SELECT * FROM hosteladmin WHERE loginid = '$loginid' AND password = '$password'";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$login_id = $value['loginid'];
				
				// set session
				$_SESSION['userId'] = 2;
				$_SESSION['hostel'] = $value['hostelname'];
				header('location: dashboard.php');	
			} else{
				
				$errors[] = "Incorrect loginid/password combination";
			} // /else
		} else {		
			$errors[] = "Invalid Login-id!";
		} // /else
	} 
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>IIT BBS Gymkhana</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

	<!-- custom css -->
	<link rel="stylesheet" href="custom/css/custom.css">	

	<!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
	<!-- jquery ui -->  
	<link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
	<script src="assests/jquery-ui/jquery-ui.min.js"></script>

	<!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Welcome Hostel Admin, please sign in</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<label for="loginid" class="col-sm-2 control-label">Login id</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="loginid" name="loginid" placeholder="Enter your login id..." autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password..." autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>