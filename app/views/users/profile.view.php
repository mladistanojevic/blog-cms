<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="container-fluid p-4 shadow mx-auto my-5" style="max-width: 1000px;">

    <div class="row">
        <div class="col-sm-4 col-md-3">
            <?php if ($data['user']->gender == 'female') : ?>
                <img src="<?= PUBROOT ?>/assets/user_female.jpg" class="d-block mx-auto rounded-circle" style="width: 150px;">
            <?php else : ?>
                <img src="<?= PUBROOT ?>/assets/user_male.jpg" class="d-block mx-auto rounded-circle" style="width: 150px;">
            <?php endif; ?>
            <h3 class="text-center my-2"><?= $data['user']->first_name . " " . $data['user']->last_name; ?></h3>
        </div>
        <div class="col-sm-8 col-md-9 bg-light p-2">
            <table class="table table-hover table-striped">
                <tr>
                    <th>First name:</th>
                    <td><?= $data['user']->first_name; ?></td>
                </tr>
                <tr>
                    <th>Last name:</th>
                    <td><?= $data['user']->last_name; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?= $data['user']->email; ?></td>
                </tr>
                <tr>
                    <th>Gender:</th>
                    <td><?= $data['user']->gender; ?></td>
                </tr>
                <tr>
                    <th>Age:</th>
                    <td><?= $data['user']->age; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="jumbotron text-center">
        <h4>Bloger Posts</h4>
    </div>


    <?php foreach ($data['posts'] as $post) : ?>
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card mb-5 shadow-sm">
                    <div class="card-body">
                        <div class="card-title">
                            <h2><?= $post->title ?></h2>
                            <p class="created"> <?= 'Created at: ' . date('F j h:m', strtotime($post->created_at)); ?></p>
                            <?php if (isLogged() && $_SESSION['user_id'] == $post->user_id) : ?>
                                <a class="btn btn-warning btn-sm my-1" href="<?= URLROOT ?>/posts/update/<?= $post->post_id; ?>"><i class="fas fa-edit"></i> Edit</a>
                                <form action="<?= URLROOT ?>/posts/delete/<?= $post->post_id; ?>" method="POST">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <div class="card-text">
                            <p>
                                <?= $post->body ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>