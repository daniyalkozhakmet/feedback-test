<?php include('components/header.view.php');
$data = $data[0][0];

?>

<section class="container mt-5">
    <h1>Edit feedback</h1>
    <p class="alert alert-success d-none" id='alert'></p>
    <form method="POST" action="<?=ROOT ?>/admin/update?id=<?= $data->id ?>">
        <div class="form-group my-3">
            <label for="exampleInputEmail1">Name</label>
            <input type="name" value="<?= $data->name ?>" name="name" id='name' class="form-control" placeholder="Enter name" required>

        </div>
        <div class="form-group my-3">
            <label for="exampleInputEmail1">Email</label>
            <input value="<?= $data->email  ?>" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>

        </div>
        <div class="form-group my-3">
            <label for="exampleFormControlTextarea1">Message</label>
            <textarea name="message" id="message" class="form-control" id="exampleFormControlTextarea1" rows="3" required><?= $data->message  ?></textarea>
        </div>
        <div class="form-check my-3">
            <?php if ($data->is_accepted) {
            ?>
                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="true" checked name="is_accepted">
            <?php
            } else { ?>
                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="false" name="is_accepted">
            <?php } ?>

            <label class="form-check-label" for="exampleCheck1">Accept</label>
        </div>
        <button id='submit_btn' class="btn btn-primary">Submit</button>
    </form>
</section>


<?php include('components/footer.view.php'); ?>