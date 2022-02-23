<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="container-fluid">
    <form action="<?= URLROOT; ?>/register" method="POST">
        <div class="p-4 mx-auto shadow rounded" style="width: 100%;max-width: 310px;margin-top:50px">
            <img src="<?= PUBROOT ?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width: 100px;">
            <h3 class="text-center">Create an account</h3>

            <input type="text" name="first_name" placeholder="First name *" class="form-control my-2">
            <?php if ($data['first_nameError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['first_nameError']; ?>
                </div>
            <?php endif; ?>
            <input type="text" name="last_name" placeholder="Last name *" class="form-control my-2">
            <?php if ($data['last_nameError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['last_nameError']; ?>
                </div>
            <?php endif; ?>
            <input type="email" name="email" placeholder="Email *" class="form-control my-2">
            <?php if ($data['emailError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['emailError']; ?>
                </div>
            <?php endif; ?>
            <select class="my-2 form-control" name="gender" required>
                <option value="">Select a gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <input type="number" name="age" placeholder="Age *" class="form-control my-2">
            <?php if ($data['ageError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['ageError']; ?>
                </div>
            <?php endif; ?>

            <input type="password" name="password" placeholder="Password *" class="form-control my-2">
            <?php if ($data['passwordError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['passwordError']; ?>
                </div>
            <?php endif; ?>
            <input type="password" name="confirm_password" placeholder="Retype Password *" class="form-control my-2">
            <?php if ($data['confirm_passwordError']) : ?>
                <div class="alert alert-danger" style="text-align:center;">
                    <?= $data['confirm_passwordError']; ?>
                </div>
            <?php endif; ?>
            <br>
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>