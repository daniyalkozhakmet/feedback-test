<?php include('components/header.view.php');
$data = $data[0];
?>

<section class="container mt-5">
    <h1>Leave a feedback</h1>
    <p>In order to leave a feed user needs to login </p>
    <form class="d-flex align-items-center my-2" action="<?= ROOT . '/' . 'feedback/search' ?>" method="POST">
        <input class="form-control mr-sm-2" type="search" placeholder="Search by author and email" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 mx-1 my-sm-0" type="submit">Search </button>
    </form>
    <form class="d-flex align-items-center justify-content-between my-2 gap-1" action="<?= ROOT . '/' . 'feedback/search' ?>" method="POST">
        <label for="start">Filter by date: </label>
        <div>
        <input type="date" id="start" name="search_date" value="2023-10-11" min="2018-01-01" max="2023-12-31">
            <button class="btn btn-outline-success my-2 mx-1 my-sm-0" type="submit">Search </button>
        </div>
    </form>
    <?php
    if (is_bool($data)) {
    ?>
        <p class="alert alert-warning">No record found</p>
    <?php
    } elseif (count($data) > 0) {
    ?>
        <div>

            <div class="container">
                <div class="row no-gutters">
                    <?php
                    foreach ($data as $key => $value) {
                    ?>
                        <div class="col-lg-4 g-2">
                            <div class="card">
                                <img class="card-img-top" width=200 height="200" style="object-fit: cover;" src="<?= ROOT . '/' . $value->image ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $value->name ?></h5>
                                    <h5 class="card-title"><?= $value->email ?></h5>
                                    <p class="card-text"><?= substr($value->message, 0, 10) . '...' ?></p>
                                    <a href="<?= ROOT ?>/feedback/single?id=<?= $value->id ?>" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    <?php
    } ?>

</section>


<?php include('components/footer.view.php'); ?>