<h1><?= htmlspecialchars($this->title) ?></h1>

<div>
    <p>
        Created at <?= $this->issue['submit_date']; ?>
    </p>

    <p>
        State: <?= $this->issue['state_type'] ?>
    </p>

    <p>
        by: <?= htmlspecialchars($this->issue['username']) ?>
    </p>

    <p><?= htmlspecialchars($this->issue['description']) ?></p>

    <?php if ($this->isLoggedIn && $this->issue['username'] == $this->user): ?>
    <a href="/issues/edit/<?= $this->issue['id'] ?>" class="btn btn-default">Edit</a>
    <?php endif; ?>
</div>