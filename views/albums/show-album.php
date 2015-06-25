<h1>Album details</h1>

<div class="container">
    <?php
        $albumsCount = count($this->albums);
        for ($i = 0; $i < $albumsCount; $i += 6):
    ?>
    <div class="row">
        <?php
            $columnsCount = $albumsCount - $i < 6 ? $albumsCount : 6 + $i;

            for ($j = $i; $j < $columnsCount; $j++):
                $album = $this->albums[$j];
        ?>
        <div class="col-md-2">
            <a href="/albums/show-album/<?= $album['id'] ?>">
                <img src="http://placehold.it/200&text=<?= $j + 1 ?>"/>
                <?php if ($album['name']): ?>
                    <h2><?= $album['name'] ?></h2>
                <?php endif; ?>
                <p>Author: <em><?= $album['author'] ?></em></p>
                <time><?= $album['date_created'] ?></time>
            </a>
        </div>
        <?php endfor; ?>
    </div>
    <?php endfor; ?>
</div>