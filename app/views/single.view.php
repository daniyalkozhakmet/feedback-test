<?php include('components/header.view.php');
$data = $data[0][0];

?>

<section class="container mt-5">
    <h1>Edit feedback</h1>
    <p class="alert alert-success d-none" id='alert'></p>
    <div class="row">
        <div class="col-md-8 col-12 g-2">
            <form>
                <div class="form-group my-3">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="name" value="<?= $data->name ?>" name="name" id='name' class="form-control" placeholder="Enter name" required disabled>

                </div>
                <div class="form-group my-3">
                    <label for="exampleInputEmail1">Email</label>
                    <input value="<?= $data->email  ?>" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" disabled required>

                </div>
                <div class="form-group my-3">
                    <label for="exampleFormControlTextarea1">Message</label>
                    <textarea name="message" id="message" class="form-control" id="exampleFormControlTextarea1" disabled rows="3" required><?= $data->message  ?></textarea>
                </div>
                <a href="<?= ROOT . '/home' ?>" class="btn btn-primary">Back</a>
            </form>
        </div>
        <div class="col-md-4 col-12 g-2 mt-3">
            <img src="<?= ROOT . '/' . $data->image ?>" style="object-fit: cover;width:100%" alt="Image" srcset="">
        </div>
    </div>

</section>


<?php include('components/footer.view.php'); ?>