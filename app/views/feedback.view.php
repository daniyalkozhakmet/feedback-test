<?php include('components/header.view.php'); ?>

<section class="container mt-5">
    <h1>Leave a feedback</h1>
    <p class="alert alert-success d-none" id='alert'></p>
    <div id="errors"></div>
    <form enctype="multipart/form-data">
        <div class="form-group my-3">
            <label for="exampleInputEmail1">Name</label>
            <input type="name" value="<?= old_value('name') ?>" name="name" id='name' class="form-control" placeholder="Enter name" required>

        </div>
        <div class="form-group my-3">
            <label for="exampleInputEmail">Email</label>
            <input value="<?= old_value('email') ?>" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>

        </div>
        <div class="form-group my-3">
            <label for="exampleFormControlTextarea1">Message</label>
            <textarea value="<?= old_value('message') ?>" name="message" id="message" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <div class="form-group my-3">
            <label for="exampleFormControlFile1">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button id='submit_btn' class="btn btn-primary">Submit</button>
    </form>
</section>
<section class="container my-4">
    <h1>My feedbacks</h1>
    <table class="table table-striped" id='feedback_tb'>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_bool($data[0])) {
            ?>

                <?php
            } else {
                foreach ($data[0] as  $value) {
                ?>
                    <tr>
                        <th><img class="rounded" height="50px" width="auto" src='<?= ROOT . '/' . $value->image  ?>' alt="Image" srcset=""> </th>
                        <td><?= $value->name  ?></td>
                        <td><?= $value->email  ?></td>
              
                        <td><?= substr($value->message, 0, 10)  ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</section>
<script>
    let post_image_added = false;
    let submit_btn = document.querySelector('#submit_btn');
    let alert_p = document.querySelector('#alert')
    let errors = document.querySelector('#errors')
    let feedback_tb = document.querySelector('#feedback_tb')
    submit_btn.addEventListener('click', (e) => {
        submit_post(e);
    })

    function validateFileUpload() {
        let fuData = document.getElementById('image');
        let FileUploadPath = fuData.value;


        //To check if user upload any file
        if (FileUploadPath == '') {
            alert("Please upload an image");
            return false

        } else {
            let Extension = FileUploadPath.substring(
                FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

            //The file uploaded is an image

            if (Extension == "gif" || Extension == "png" || Extension == "bmp" ||
                Extension == "jpeg" || Extension == "jpg") {
                const fileSize = document.querySelector("#image").files[0].size / 1024 / 1024;; // in mB
                console.log(fileSize)
                if (fileSize > 1) {
                    alert('File size exceeds 1 mB');
                    return false
                }
                return true;

            }

            //The file upload is NOT an image
            else {
                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
                return false
            }
        }
    }

    function submit_post(e) {
        e.preventDefault();
        if (validateFileUpload()) {
            var obj = {};

            obj.image = document.querySelector("#image").files[0];
            obj.name = document.querySelector("#name").value;
            obj.email = document.querySelector("#email").value;
            obj.message = document.querySelector("#message").value;
            obj.data_type = "create-feedback";
            send_data(obj);
        };

    }

    function send_data(obj) {

        let myform = new FormData();

        for (key in obj) {
            myform.append(key, obj[key]);
        }

        var ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function(e) {

            if (ajax.readyState == 4 && ajax.status == 200) {
                handle_result(ajax.responseText);
            }
        });


        ajax.open('post', '<?= ROOT ?>/ajax', true);
        //     for (var key of myform.entries()) {
        //     console.log(key[0] + ', ' + key[1]);
        // }
        ajax.send(myform);

    }

    function handle_result(result) {
        console.log(result)
        let obj = JSON.parse(result);
        console.log(obj)
        if (obj.success) {
            while (errors.lastElementChild) {
                errors.removeChild(errors.lastElementChild);
            }
            alert_p.classList.remove('d-none')
            alert_p.textContent = obj.message
            let row = feedback_tb.insertRow(1);
            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);
            let cell3 = row.insertCell(2);
            let cell4 = row.insertCell(3);
            cell1.innerHTML = `<img class="rounded" height="50px" width="auto" src='
            <?= ROOT . '/' ?>${obj.data.image} ' alt="Image" srcset="">`;
            cell2.textContent = obj.data.name;
            cell3.textContent = obj.data.email;
            cell4.textContent = obj.data.message.slice(0, 10);
        } else {
            for (key in obj.message) {
                let alert = document.createElement('div')
                alert.classList.add('alert', 'alert-danger')
                alert.innerText = obj.message[key]
                errors.append(alert)

            }
        }
    }
</script>
<?php $data = $data ?>
<?php include('components/footer.view.php'); ?>