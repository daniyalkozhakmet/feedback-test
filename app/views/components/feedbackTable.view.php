<section class="container my-4">
    <table class="table table-striped" id='feedback_tb'>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Message</th>
                <th scope="col">Edited by Admin</th>
                <th scope="col">Accepted</th>
                <th scope="col"></th>
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
                        <th><?= $value->id  ?> <img class="rounded" height="50px" width="auto" src='<?= ROOT . '/' . $value->image  ?>' alt="Image" srcset=""> </th>
                        <td><?= $value->name  ?></td>
                        <td><?= $value->email  ?></td>
                        <td><?= substr($value->message, 0, 10) . '...'   ?></td>
                        <td><?php
                            if ($value->is_edited) {
                            ?>
                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                            <?php
                            } else {
                            ?>
                                <i class="bi bi-x-circle text-danger fs-4"></i>
                            <?php

                            }
                            ?>
                        </td>
                        <td><?php
                            if ($value->is_accepted) {
                            ?>
                                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                            <?php
                            } else {
                            ?>
                                <i class="bi bi-x-circle text-danger fs-4"></i>
                            <?php

                            }
                            ?>
                        </td>
                        <td><a href=" <?= ROOT . '/admin/edit?id=' . $value->id  ?>" class="btn btn-outline-warning">Edit</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</section>