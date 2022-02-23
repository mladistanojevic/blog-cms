<style>
    nav ul li a {
        width: 120px;
        text-align: center;
        border-left: solid thin #eee;
        border-right: solid thin #fff;
    }

    nav ul li a:hover {
        background-color: gray;
        color: white !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?= PUBROOT ?>/assets/logo.png" style="width: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= URLROOT; ?>"><i class="fas fa-home"></i> HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/posts"><i class="fas fa-th"></i> BLOGS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/users"><i class="fas fa-users"></i> BLOGGERS</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['first_name']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <?php if ($_SESSION['role'] == 'user') : ?>
                                <li><a class="dropdown-item" href="<?= URLROOT;  ?>/users/profile/<?= $_SESSION['user_id']; ?>"><i class="fas fa-user-alt"></i> Profile</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['role'] == 'admin') : ?>
                                <li><a class="dropdown-item" href="<?= URLROOT;  ?>/admin/dashboard"><i class="fas fa-user-alt"></i> Dashboard</a></li>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="<?= URLROOT;
                                                                ?>/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="<?= URLROOT ?>/login" class="nav-link"><i class="fas fa-sign-in-alt"></i> LOGIN</a>
                    </li>
                </ul>

            <?php endif; ?>

        </div>
    </div>
</nav>