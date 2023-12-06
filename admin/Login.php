<?php 
  session_start();

  if (!isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="../../admin/dist/css/alt/adminlte.login.css">
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form action="../app/Controller/Login.php?isAdmin=1" method= "post">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		
	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       Đăng nhập</h3>   
	 		</div>

	 	  <div class="mb-3">
		    <label class="form-label">
		           Email</label>
		    <input type="text"
		           name="email"
		           value="" 
		           class="form-control" id="email">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Password</label>
		    <input type="password" 
		           class="form-control"
		           name="password" id="password">
		  </div>
		  <div class="mb-3">
          <button type="submit" 
		          class="btn btn-primary" style="width: 100%;">
		          Đăng nhập</button>
          </div>
		</form>
	 </div>
</body>
<script>
</script>
</html>
<?php
  }else{
  	header("Location: home.php");
   	exit;
  }
 ?>