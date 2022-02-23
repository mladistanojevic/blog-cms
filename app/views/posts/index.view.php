<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<h1 class="text-center my-3">All blogs</h1>
<div class="row my-5">
    <div class="col-4 offset-4 text-center">
        <?php if (isLogged()) : ?>
            <a class="btn btn-outline-dark btn-lg text-center" href="<?= URLROOT ?>/posts/create">Write a blog</a>
        <?php endif; ?>
    </div>
</div>
<?php foreach ($data['posts'] as $post) : ?>
    <div class="row">
        <div class="col-8 offset-2">
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
                    <p class="created">Created by: <a class="author" href="<?= URLROOT ?>/users/profile/<?= $post->user_id; ?>"><?= $post->first_name . " " . $post->last_name; ?> <b>Email:</b> <?= $post->email; ?></a></p>
                    <a href="<?= URLROOT ?>/posts/post/<?= $post->post_id; ?>" class="btn btn-outline-primary rounded-0 float-end">Read More</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php $data['pager']->display();  ?>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>