<div class="row">
    <h1>All issues</h1>

    <?php foreach ($this->issues as $issue): ?>
        <div class="col-md-4">
            <a href="/issues/details/<?= $issue['id']?>">
                <h2><?= $issue['title'] ?></h2>
            </a>
            <div>
                <p>
                    Created at <datetime><?= $issue['submit_date']?></datetime>
                </p>
                <p class="text-right">
                    by <?= $issue['username'] ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="row">
    <?php if($this->totalPages > 1): ?>
        <ul class="pagination">
            <?php if(($this->page - 1) >= 1): ?>
                <li>
                    <a href="/issues/all/<?= $this->page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php for($page = 1; $page <= $this->totalPages; $page++): ?>
                <li>
                    <a href="/issues/all/<?= $page ?>"><?= $page ?></a>
                </li>
            <?php endfor; ?>
            <?php if(($this->page + 1) <= $this->totalPages): ?>
                <li>
                    <a href="/issues/all/<?= $this->page + 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>