<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<h1 class="text-center my-3">Update blog</h1>


<div class="row">
    <div class="col-8 offset-2">
        <form action="<?= URLROOT ?>/posts/update/<?= $data['post']->post_id; ?>" method="POST">
            <select class="my-2 form-control" name="category" required>
                <option value="<?= $data['post']->category ?>"><?= $data['post']->category ?></option>
                <option value="animals">Animals</option>
                <option value="cars">Cars</option>
                <option value="fashion">Fashion</option>
                <option value="food">Food</option>
                <option value="life">Life</option>
                <option value="love">Love</option>
                <option value="sport">Sport</option>
                <option value="other">Other</option>
            </select>
            <input type="text" class="form-control my-2" name="title" value="<?= $data['post']->title; ?>">
            <?php if ($data['titleError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['titleError']; ?>
                </div>
            <?php endif; ?>
            <br>

            <textarea name="body" class="form-control my-2" rows="10"><?= $data['post']->body; ?></textarea>
            <?php if ($data['bodyError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['bodyError']; ?>
                </div>
            <?php endif; ?>
            <br>

            <button class="btn btn-outline-dark btn-lg text-center" type="submit">Update</button>
        </form>
    </div>
</div>
<?php require_once APPROOT . '/views/includes/footer.php'; ?>