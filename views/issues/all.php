<div class="row">
    <div class="col-md-2 pull-left">
        <ul id="issue-filter" class="nav nav-pills nav-stacked">
            <?php foreach ($this->issueStates as $issueState): ?>
                <li <?php if($_GET['state'] == $issueState['id']) {
                    echo 'class="active"';
                } ?>>
                    <a href="/issues/all?state=<?= $issueState['id'] ?>"><?= $issueState['state_type'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="col-md-10 issue">
        <h2>
            <?php
                if ($_GET['state']) {
                    array_filter($this->issueStates, function($state) {
                        if($state['id'] == $_GET['state']) {
                            echo $state['state_type'] . ' issues';
                        }
                    });
                } else {
                    echo 'All issues';
                }
            ?>
        </h2>
        <?php foreach ($this->issues as $issue): ?>
            <div class="col-md-6">
                <a href="/issues/details/<?= $issue['id'] ?>">
                    <h2><?= htmlspecialchars($issue['title']) ?></h2>
                </a>

                <div>
                    <p>
                        Created at
                        <datetime><?= $issue['submit_date'] ?></datetime>
                    </p>
                    <p>
                        <span class="text-left">
                              State: <?= $issue['state_type'] ?>
                        </span>
                        <span class="text-right pull-right">
                              by <?= htmlspecialchars($issue['username']) ?>
                        </span>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="row text-center">
    <?php if ($_GET['state']) {
        $stateFilter = '?state=' . $_GET['state'];
    } else {
        $stateFilter = '';
    }
    ?>
    <?php if ($this->totalPages > 1): ?>
        <ul class="pagination">
            <?php if (($this->page - 1) >= 1): ?>
                <li>
                    <a href="/issues/all/<?= ($this->page - 1) . $stateFilter ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($page = 1; $page <= $this->totalPages; $page++): ?>
                <li>
                    <a href="/issues/all/<?= $page . $stateFilter ?>"><?= $page ?></a>
                </li>
            <?php endfor; ?>
            <?php if (($this->page + 1) <= $this->totalPages): ?>
                <li>
                    <a href="/issues/all/<?= ($this->page + 1) . $stateFilter ?>" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>