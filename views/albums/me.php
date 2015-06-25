<div class="container">
    <h1>My albums</h1>
    <a href="/albums/create">Create new album</a>
    <?php
        $albumsCount = count($this->albums);
        for($i = 0; $i < $albumsCount; $i += MAX_ALBUMS_PER_ROW):
    ?>
        <div class="row">
    <?php
        $columnsCount = $albumsCount - $i < MAX_ALBUMS_PER_ROW ? $albumsCount: MAX_ALBUMS_PER_ROW + $i;

        for($j = $i; $j < $columnsCount; $j++):
            $album = $this->albums[$j];
    ?>
            <div class="col-md-2">
                <a href="/albums/show-album/<?= $album['id']?>">
                    <img src="http://placehold.it/200&text=<?= $j + 1 ?>" />
                    <?php if($album['name']): ?>
                        <h2><?= htmlspecialchars($album['name']) ?></h2>
                    <?php endif; ?>
                    <p>Author: <em><?=  htmlspecialchars($album['author']) ?></em></p>
                    <time><?= htmlspecialchars($album['date_created']) ?></time>
                </a>
            </div>
    <?php endfor; ?>
        </div>
    <?php endfor; ?>
    <?php if($this->totalPages > 1): ?>
        <ul class="pagination">
        <?php if(($this->page - 1) >= 1): ?>
            <li>
                <a href="/albums/me/<?= $this->page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>
        <?php for($page = 1; $page <= $this->totalPages; $page++): ?>
            <li>
                <a href="/albums/me/<?= $page ?>"><?= $page ?></a>
            </li>
        <?php endfor; ?>
        <?php if(($this->page + 1) <= $this->totalPages): ?>
            <li>
                <a href="/albums/me/<?= $this->page + 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>