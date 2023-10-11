<?php include('components/header.view.php'); ?>

<section class="container mt-5">
    <h1 class="my-3">Change. Accept. Reject feedbacks</h1>
    <?php
    if (is_bool($data[0])) {
    ?>
        <div class="alert alert-info my-3">
            <h2>No feedback to show</h2>
        </div>

    <?php
    } else {
        $data=$data;
        include('components/feedbackTable.view.php'); 
    }
    ?>
</section>


<?php include('components/footer.view.php'); ?>