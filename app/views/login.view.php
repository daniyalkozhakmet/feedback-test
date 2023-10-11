<?php include('components/header.view.php'); ?>

<section class="container d-flex justify-content-between align-items-center flex-column">
	<h1>Login </h1>
	<form class="w-75" method="POST" action="<?= ROOT . '/login' ?>">
		<div class="form-group">
			<label for="exampleInputEmail1">Email or username</label>
			<input value="<?= old_value('email') ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email or username">
			<div class="text-danger"><?= $user->getError('email') ?></div><br>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input value="<?= old_value('password') ?>" name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			<div class="text-danger"><?= $user->getError('password') ?></div><br>
		</div>
		<div class="d-flex justify-content-between align-items-end">
			<button type="submit" class="btn btn-primary">Login</button>
			<small class="form-text text-muted mx-3">Don't you have an account? <a href="<?= ROOT . '/signup' ?>">Register</a></small>
		</div>
	</form>
</section>


<?php include('components/footer.view.php'); ?>