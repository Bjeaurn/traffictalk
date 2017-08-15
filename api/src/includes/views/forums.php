<?php require_once("menu.php"); ?>
<div class="col-md-4">
<h1>Forums</h1>
</div>
<?php if($data->user->level == 2) {?>
<div class="col-md-4 col-md-offset-4" style="text-align: right; margin-top: 2em;">
    <div class="btn-group" role="group" aria-label="...">
        <a href="forums/add" class="btn btn-success">Add new forum</a>
    </div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php include("forum_boards.php");?>
