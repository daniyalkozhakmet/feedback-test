<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kozhakmetov Daniyal</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <div class="d-flex align-items-center justify-content-center gap-2 navbar-brand">
            <a href=" <?= ROOT . '/home' ?>" class="pb-2 my-sm-0"><i class="bi bi-house text-primary fs-2"></i></a>
            <?php
            if (!empty($_SESSION['APP']['USER'])) {
            ?>
                <p class="my-2 " role="button">
                    Welcome <span class="text-primary text-uppercase"><?= $_SESSION['APP']['USER']->username ?></span>
                </p>

            <?php } ?>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if (!empty($_SESSION['APP']['USER'])) {
                    if (($_SESSION['APP']['USER']->is_admin) == true) {
                ?>

                        <li class="nav-item">
                            <a href="<?= ROOT . '/admin' ?>" class="nav-link  my-2 my-sm-0"><?= strtoupper($_SESSION['APP']['USER']->username) ?> </a>
                        </li>

                    <?php } ?>

                    <li class="nav-item">
                        <a href="<?= ROOT . '/feedback' ?>" class="nav-link  my-2 my-sm-0">ADD</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= ROOT . '/logout' ?>" class="nav-link  my-2 my-sm-0">LOGOUT</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item active">
                        <a href="<?= ROOT . '/login' ?>" class="nav-link my-2 my-sm-0">LOGIN</a>
                    </li>
                <?php } ?>

            </ul>
        </div>

        </div>
    </nav>