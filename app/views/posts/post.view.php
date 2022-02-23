<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="row my-4">
    <div class="col-8 offset-2">
        <div class="card mb-5 shadow-sm">
            <div class="card-body">
                <div class="card-title">
                    <h2><?= @$data['post']->title; ?></h2>
                    <hr>
                    <h5><i>Category: <?= @$data['post']->category ?></i></h5>
                    <p class="created"><i> <?= 'Created at: ' . date('F j h:m', strtotime($data['post']->created_at)); ?></i></p>
                    <?php if (isLogged() && $_SESSION['user_id'] == $data['post']->user_id) : ?>
                        <a class="btn btn-warning btn-sm my-1" href="<?= URLROOT ?>/posts/update/<?= $data['post']->post_id; ?>"><i class="fas fa-edit"></i> Edit</a>
                        <form action="<?= URLROOT ?>/posts/delete/<?= $data['post']->post_id; ?>" method="POST">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
                <hr>
                <div class="card-text">
                    <p>
                        <?= $data['post']->body ?>
                    </p>
                </div>
                <p class="created"><i>Created by: <a class="author" href="<?= URLROOT ?>/users/profile/<?= $data['post']->user_id; ?>"><?= $data['post']->first_name . " " . $data['post']->last_name; ?></a></i></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-8 offset-2">
        <h4>Comments(<?= $data['numberOfComments']; ?>):</h4>
        <hr>
        <?php foreach ($data['comments'] as $comment) : ?>
            <div class="card mb-5 shadow-sm my-4">
                <div class="card-body">
                    <div class="card-text">
                        <p>
                            <?= $comment->comment; ?>
                        </p>
                    </div>
                    <hr>
                    <p class="created"><i>Created by: <a class="author" href="<?= URLROOT ?>/users/profile/<?= $data['post']->user_id; ?>"><?= $comment->first_name . " " . $comment->last_name; ?></a></i></p>
                    <p class="created"><i> <?= 'Created at: ' . date('F j h:m', strtotime($comment->created_at)); ?></i></p>
                </div>
                <?php if ($_SESSION['user_id'] == $comment->user_id) : ?>
                    <div class="card-footer">
                        <form action="<?= URLROOT ?>/posts/deleteComment/<?= $data['post']->post_id ?>/<?= $comment->comment_id; ?>" method="POST">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php if (isLogged()) : ?>
    <div class="row">
        <div class="col-6 offset-3">
            <form action="<?= URLROOT ?>/posts/post/<?= $data['post']->post_id; ?>" method="POST">
                <input type="hidden" name="post_id" value="<?= $data['post']->post_id; ?>">
                <textarea name="comment" rows="5" class="form-control" placeholder="Write a comment..."></textarea>
                <?php if ($data['commentError']) : ?>
                    <div class="alert alert-danger my-2" style="text-align:center;">
                        <?= $data['commentError']; ?>
                    </div>
                <?php endif; ?>
                <button class="btn btn-primary my-2" type="submit">Comment</button>
            </form>
        </div>
    </div>
<?php endif; ?>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>