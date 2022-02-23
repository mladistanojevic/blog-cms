<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>

<div class="d-flex" id="wrapper">
    <?php require_once APPROOT . '/views/includes/admin_sidebar.php'; ?>
    <!-- Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0">Dashboard</h2>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <div class="row">
            <div class="col-sm-4 col-md-3">
                <?php if ($data['user']->gender == 'female') : ?>
                    <img src="<?= PUBROOT ?>/assets/user_female.jpg" class="d-block mx-auto rounded-circle" style="width: 150px;">
                <?php else : ?>
                    <img src="<?= PUBROOT ?>/assets/user_male.jpg" class="d-block mx-auto rounded-circle" style="width: 150px;">
                <?php endif; ?>
                <h3 class="text-center my-2">Admin: <?= $data['user']->first_name . " " . $data['user']->last_name; ?></h3>
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



    </div>
    <!-- Content end -->
</div>
<!-- /#page-content-wrapper -->

<?php require_once APPROOT . '/views/includes/footer.php'; ?>