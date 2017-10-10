<?php require_once("menu.php"); ?>
<div class="col-md-12">
    <div class="col-md-10">
    <h1><?=$data->forum->name?></h1>
    </div>
    <div class="col-md-2" style="text-align: right;">
        <a href="forums/<?=$data->forum->getID()?>/create" class="btn btn-success">Create post</a>
    </div>
</div>
<table class="table table-striped">
    <tr>
        <th>Post</th>
        <th class="col-sm-1">Author</th>
        <th class="col-sm-2">Last</th>
    </tr>
    <?php foreach($data->posts as $post) {?>
        <tr>
            <td><a href="forums/<?=$data->forum->getID()?>/<?=$post->getID()?>"><?=$post->title?></a></td>
            <td align="center"><a href="profile/<?=$post->author->id?>"><?=$post->author->name?></a></td>
            <td align="center"><?=$post->datetime()?></td>
        </tr>
    <?php } ?>
</table>
