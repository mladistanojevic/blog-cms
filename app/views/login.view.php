<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="container-fluid">
    <form action="<?= URLROOT ?>/login" method="POST">
        <div class="p-4 mx-auto shadow rounded" style="width: 100%;max-width: 310px;margin-top:50px">
            <img src="<?= PUBROOT ?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width: 100px;">
            <h3 class="text-center">Login</h3>
            <input type="email" name="email" placeholder="Email *" class="form-control my-2" autofocus>
            <?php if ($data['emailError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['emailError']; ?>
                </div>
            <?php endif; ?>
            <br>
            <input type="password" name="password" placeholder="Password *" class="form-control my-2">
            <?php if ($data['passwordError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['passwordError']; ?>
                </div>
            <?php endif; ?>
            <br>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="alert alert-primary mt-3" role="alert">
                If you don`t have an account please <a href="<?= URLROOT; ?>/register" class="alert-link">Register here</a>
            </div>
        </div>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>