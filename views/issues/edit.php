<h2><?= htmlspecialchars($this->title) ?></h2>

<form action="/issues/edit/<?= $this->issue['id'] ?>" method="POST" class="form-horizontal" role="form">

    <?php include(__DIR__ . '\..\layouts\default\csft-partial.php') ?>
    <h4>Update issue</h4>
    <hr/>
    <div class="text-danger validation-summary-errors"></div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Title: </label>

        <div class="col-md-10">
            <input type="text" class="form-control" id="title" name="title" value="<?= $this->issue['title']; ?>"/>
            <span class="field-validation-valid text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-md-2 control-label">Description: </label>

        <div class="col-md-10">
            <textarea name="description" id="description" class="form-control" cols="30" rows="5"><?= htmlspecialchars($this->issue['description']) ?></textarea>
            <span class="field-validation-valid text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="State" class="col-md-2 control-label">State: </label>

        <div class="col-md-10">
            <select name="state-id" id="state" class="form-control">
                <?php foreach ($this->issueStates as $issueState) : ?>
                    <option value="<?= $issueState['id'] ?>" <?php if ($issueState['state_type'] == $this->issue['state_type']) {
                        echo 'selected';
                    } ?>><?= $issueState['state_type'] ?></option>
                <?php endforeach; ?>
            </select>
            <span class="field-validation-valid text-danger"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type="submit" class="btn btn-default" value="Edit"/>
        </div>
    </div>
</form>