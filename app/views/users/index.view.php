<?php require_once APPROOT . '/views/includes/head.php'; ?>
<?php require_once APPROOT . '/views/includes/nav.php'; ?>
<div class="row my-5">
    <div class="col-6 offset-3">
        <form action="<?= URLROOT ?>/users">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="find" placeholder="Search...*" onkeyup="get_data(this.value);">
            </div>
        </form>
    </div>
</div>
<div class="row my-5">
    <div class="col-8 offset-2">
        <div class="output"></div>
        <table class="table">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user) : ?>
                    <tr>
                        <td><?= $user->first_name; ?></td>
                        <td><?= $user->last_name; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><a href="<?= URLROOT ?>/users/profile/<?= $user->user_id; ?>">View Profile</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once APPROOT . '/views/includes/footer.php'; ?>