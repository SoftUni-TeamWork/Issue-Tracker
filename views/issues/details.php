<div>
    <h1><?= htmlspecialchars($this->title) ?></h1>

    <div class="row">
        <div class="col-md-8">
            <div>
                Created at <?= $this->issue['submit_date']; ?>
            </div>

            <div>
                State: <?= $this->issue['state_type'] ?>
            </div>

            <div>
                by: <?= htmlspecialchars($this->issue['username']) ?>
            </div>

            <div><?= htmlspecialchars($this->issue['description']) ?></div>
        </div>
        <?php if ($this->isLoggedIn && strtolower($this->issue['username'] ) == strtolower($_SESSION['username'])): ?>
            <div class="col-md-4">
                <a href="/issues/edit/<?= $this->issue['id'] ?>" class="btn btn-default">Edit</a>
            </div>
        <?php endif; ?>
    </div>
    <hr/>
    <div class="comments">
        <?php foreach ($this->comments as $comment): ?>
            <div class="row">
                <div class="comment col-md-4">
                    <h4><?= htmlspecialchars($comment['username']) ?></h4>
                    <datetime>
                        Added on: <?= $comment['submit_date'] ?>
                    </datetime>
                    <div class="comment-content">
                        <?= htmlspecialchars($comment['content']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if ($this->isLoggedIn): ?>
            <form id="add-comment-form" action="comments/add" method="post">
                <?php include(__DIR__ . '\..\layouts\default\csft-partial.php') ?>
                <div class="form-group">
                    <label for="comment" class="row control-label">Comment: </label>

                    <div class="row">
                        <textarea type="text" class="form-control" id="comment" name="comment"></textarea>
                        <span class="field-validation-valid text-danger"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Add" class="btn btn-default"/>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

<script id="comment-template" type="text/x-handlebars-template">
    <div class="row">
        <div class="comment col-md-4">
            <h4>{{ username }}</h4>
            <datetime>
                Added on: {{ submit_date }}
            </datetime>
            <div class="comment-content">
                {{ comment }}
            </div>
        </div>
    </div>
</script>
<script type="text/javascript" src="http://builds.handlebarsjs.com.s3.amazonaws.com/handlebars-v3.0.3.js"></script>
<script type="text/javascript">
    $('#add-comment-form').on('submit', function (evt) {
        evt.preventDefault();
//        var $csrfName = $(this).find('input[name=CSRFName]'),
//            $csrfToken=$(this).find('input[name=CSRFToken]');

        var $comment = $('#comment');
        var data = {
            comment:  $comment.val(),
            issueId: <?= $this->issue['id'] ?>,
            username: '<?= $_SESSION['username'] ?>'
            /*csrfName: $csrfName.val(),
            csrfToken: $csrfToken.val()*/
        };

        $.ajax({
           url: '/comments/add',
           type: 'POST',
           data: data
        })
        .success(function (data) {
             var source   = $("#comment-template").html();
             var template = Handlebars.compile(source);
             debugger;
             var html = template(data);
             $('.comments').prepend(html);
             $comment.val('');
             console.log("success");
        })
        .fail(function () {
           console.log("error");
        })
    });
</script>