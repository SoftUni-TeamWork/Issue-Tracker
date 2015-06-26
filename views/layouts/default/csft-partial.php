<?php $uniqueName = Uuid::generate() ?>
<input type="hidden" name="CSRFName" value="<?= $uniqueName ?>" />
<input type="hidden" name="CSRFToken" value="<?= CsftGuard::generateToken($uniqueName)?>" />