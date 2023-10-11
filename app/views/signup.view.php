<?php include('components/header.view.php'); ?>

<section class="container d-flex justify-content-between align-items-center flex-column">
	<h1>Register </h1>
	<form class="w-75" method="POST" action="<?= ROOT . '/signup' ?>">
		<div class="form-group">
			<label for="exampleInputEmail1">Username</label>
			<input value="<?= old_value('username') ?>" name="username" class="form-control" id="exampleInputUsername1" aria-describedby="emailHelp" placeholder="Enter username">
			<div class="text-danger"> <?= $user->getError('username') ?></div><br>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input value="<?= old_value('email') ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			<div class="text-danger"><?= $user->getError('email') ?></div><br>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input value="<?= old_value('password') ?>" name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			<div class="text-danger"><?= $user->getError('password') ?></div><br>
		</div>
		<div class="d-flex justify-content-between align-items-end">
			<button type="submit" class="btn btn-primary">Register</button>
			<small class="form-text text-muted mx-3">Already have an account? <a href="<?= ROOT . '/login' ?>">Login</a></small>
		</div>
	</form>
</section>


<?php include('components/footer.view.php'); ?>