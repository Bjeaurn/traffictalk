<?php require_once("menu.php"); ?>
<?php if($data->forums) {?>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Posts</th>
        </tr>
    <?php foreach($data->forums as $forum) {?>
        <tr>
            <td><a href="forums/<?=$forum->getID()?>"><?=$forum->name?></a> <?php if($forum->description) {?><br /><small><?=$forum->description?></small><?php } ?></td>
            <td align="center"><?=$forum->posts?></td>
        </tr>
    <?php } ?>
    </table>
<?php } ?>
