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

        <div class="row my-5">
            <h3 class="fs-4 mb-3 ms-5">All blogs</h3>
            <div class="col-10 offset-1">
                <table class="table bg-white rounded shadow-sm  table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Writter</th>
                            <th>Writter email</th>
                            <th>Created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['posts'] as $post) : ?>
                            <tr>
                                <th><?= $post->title; ?></th>
                                <td><?= $post->first_name . " " . $post->last_name; ?></td>
                                <td><?= $post->email; ?></td>
                                <td><?= $post->created_at; ?></td>
                                <td>
                                    <form action="<?= URLROOT ?>/admin/delete/<?= $post->post_id; ?>" method="POST">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>



    </div>
    <!-- Content end -->
</div>
<!-- /#page-content-wrapper -->

<?php require_once APPROOT . '/views/includes/footer.php'; ?>