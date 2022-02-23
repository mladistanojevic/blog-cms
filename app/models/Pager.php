<?php

class Pager
{

    public $links;
    public $offset;
    public $page_number;

    public $start;
    public $end;

    public function index($limit)
    {
        $page_number = isset($_GET['page']) ? $_GET['page'] : 1;
        $page_number = $page_number < 1 ? 1 : $page_number;

        $this->start = $page_number - 1;
        if ($this->start < 1) {
            $this->start = 1;
        }
        $this->end = $page_number + 1;
        $this->offset = ($page_number - 1) * $limit;
        $this->page_number = $page_number;

        $currnet_link = URLROOT . '/' . str_replace('url=', '', $_SERVER['QUERY_STRING']);
        $currnet_link = !strstr($currnet_link, "page") ? $currnet_link . '&page=1' : $currnet_link;
        $next_link = preg_replace('/page=[0-9]+/', "page=" . ($page_number + 2), $currnet_link);
        $first_link = preg_replace('/page=[0-9]+/', "page=1", $currnet_link);

        $this->links['current'] = $currnet_link;
        $this->links['next'] = $next_link;
        $this->links['first'] = $first_link;
    }

    public function display()
    {
?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="<?= $this->links['first']; ?>">First</a></li>
                <?php for ($x = $this->start; $x <= $this->end; $x++) : ?>
                    <li class="page-item"><a class="page-link" href="
                    <?= preg_replace('/page=[0-9]+/', 'page=' . $x, $this->links['current']); ?>
                    "><?= $x; ?></a></li>
                <?php endfor; ?>
                <li class="page-item"><a class="page-link" href="<?= $this->links['next']; ?>">Next</a></li>
            </ul>
        </nav>
<?php
    }
}
