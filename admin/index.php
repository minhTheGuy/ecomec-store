<?php
include '../api/session.php';
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
	header("Location: ../login/login.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="./styles/style.css">
	<title>Ecomec Store</title>
</head>

<body>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#exampleModal').modal('show');
			setTimeout(function() {
				$('#exampleModal').modal('hide');
			}, 2000);
		})
	</script>
	<!-- Modal -->

	

	<!-- SIDEBAR -->
	<?php include './components/sidebar.php' ?>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">

		<!-- NAVBAR -->
		<?php include './components/navbar.php' ?>
		<!-- NAVBAR -->

		<?php
		if (isset($_GET['layout'])) {
			switch ($_GET['layout']) {
				case 'dashboard':
					include 'dashboard_page.php';
					break;
				case 'store':
					include 'store_page.php';
					break;
				case 'message':
					include 'message_page.php';
					break;
				case 'team':
					break;
				case 'settings':
					include 'setting_page.php';
					break;
				case 'users':
					include 'userManager.php';
					break;
				default:
					include 'dashboard_page.php';
					break;
			}
		} else if (isset($_GET['action'])) {
			switch ($_GET['action']) {
				case 'logout':
					session_destroy();
					echo "<script>window.location.href = '../login/login.php';</scrip>";
					break;
				case 'edit':
					include 'editProduct_page.php';
					break;
				case 'delete':
					include '../api/store.php';
					$store = new Store();
					$store->deleteProduct($_GET['id']);
					header("Location: ?layout=store");
					break;
				case 'users':
					include 'editUser_page.php';
					break;
				default:
					include 'dashboard_page.php';
					break;
			}
		} else {
			include 'dashboard_page.php';
		}
		?>
	</section>
	<!-- CONTENT -->
	<script src="./scripts/script.js"></script>
</body>

</html>