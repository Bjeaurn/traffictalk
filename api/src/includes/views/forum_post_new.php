<?php require_once("menu.php"); ?>
<form action="" method="POST">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>New post in <?=$data->forum->name?></h3>
    </div>
    <div class="panel-body">
        <label>Title:</label>
        <input type="text" class="form-control" name="PostTitle" />
        <br />
        <label>Message:</label>
        <textarea name="PostBody" rows="6" class="form-control"></textarea>
    </div>
    <div class="panel-footer">
        <input type="submit" value="Create post" class="btn btn-success" />
    </div>
</div>
</form>
