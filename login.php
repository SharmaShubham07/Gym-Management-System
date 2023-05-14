<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
if (!isset($_SESSION['system'])) {
	// $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	// foreach($system as $k => $v){
	// 	$_SESSION['system'][$k] = $v;
	// }
}
ob_end_flush();
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Gym Management System</title>


	<?php include('./header.php'); ?>
	<?php
    if (isset($_SESSION['login_id']))
	    header("location:index.php?page=home");

    ?>

</head>
<style>
	html {
		width: 100%;
		height: 100%;
	}

	body {
		width: 100%;
		height: calc(100%);
		/*background: #007bff;*/
	}

	main#main {
		width: 100%;
		height: calc(100%);
		background: rgba(25, 42, 94, 0.676);
	}

	#logo,
	#logo img {
		width: 100vw;
		height: 100vh;
	}

	#logo {
		position: absolute;
		z-index: -5;
	}

	#login-right {
		/* position: absolute;
        right: 0; */
		width: 100%;
		height: 100%;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-items: center;
	}

	/*#login-left {
		position: absolute;
		left: 0;
		width: 60%;
		height: calc(100%);
		background: #59b6ec61;
		display: flex;
		align-items: center;
		background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
		background-repeat: no-repeat;
		background-size: cover;
	}*/

	#login-right .card {
		width: 60%;
		margin: auto;
		z-index: 1;
		position: relative;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-direction: column;
		flex-direction: column;
		max-width: 500px;
		/* word-wrap: break-word; */
		background-color: #fff;
		background-clip: border-box;
		border: 1px solid rgba(0, 0, 0, .125);
		border-radius: 0.25rem;
		opacity: 0.9;
	}

	.logo {
		margin: auto;
		font-size: 8rem;
		background: white;
		padding: .5em 0.7em;
		border-radius: 50% 50%;
		color: #000000b3;
		z-index: 10;
	}

	/* div#login-right::before {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		width: calc(100%);
		height: calc(100%);
		background: #000000e0;
	} */
</style>

<body>


	<main id="main">
		<!--<div id="login-left">
			<img src="assets/img/img.jpg" alt="..." width="100%" height="90%">
		</div>-->
		<!-- <div class="row">
		</div> -->
		<div id="logo">
			<img src="https://i.ytimg.com/vi/RQ9p-8OvaGA/maxresdefault.jpg">
		</div>
		<div id="login-right">
			<div class="card col-md-8">
				<div class="card-body">

					<form id="login-form">
						<div class="form-group">
							<label for="username" class="control-label">Username</label>
							<input type="text" id="username" name="username" class="form-control">
						</div>
						<div class="form-group">
							<label for="password" class="control-label">Password</label>
							<input type="password" id="password" name="password" class="form-control">
						</div>
						<center><button class="btn-md btn-block btn-wave col-md-5 btn-primary">Login</button>
						</center>
					</form>
				</div>
			</div>
		</div>


	</main>

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function (e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success: function (resp) {
				if (resp == 1) {
					location.href = 'index.php?page=home';
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>

</html>