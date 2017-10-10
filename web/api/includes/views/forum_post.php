<?php require_once("menu.php"); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?=$data->post->title?></h3>
        <p><small>By: <a href="profile/<?=$data->post->author->id?>"><?=$data->post->author->name?></a>, on: <?=$data->post->datetime()?>, in <a href="forums/<?=$data->forum->getID()?>"><?=$data->forum->name?></a></small></p>
    </div>
    <div class="panel-body">
    <?=$data->post->body?>
    </div>
</div>
<?php if($data->post->replies) {?>
    <div class="panel panel-default">
    <?php foreach($data->post->replies as $reply) { ?>
        <div class="panel-body" style="border-bottom: 1px solid #cfcfcf;">
            <div class="col-sm-8">
                <?=$reply->body?>
            </div>
            <div class="col-sm-4" style="text-align: right;">
                <small>By <a href="profile/<?=$reply->author->id?>"><?=$reply->author->name?></a>, <?=$reply->datetime()?></small>
            </div>
        </div>
    <?php } ?>
    </div>
<?php } ?>
<div class="panel panel-default">
    <form action="" method="POST">
    <div class="panel-body">
        <textarea name="NewReply" class="form-control" rows="3"></textarea>
    </div>
    <div class="panel-footer">
        <input type="submit" class="btn btn-success btn-xs" value="Reply" name="SaveReply">
    </div>
    </form>
</div>
