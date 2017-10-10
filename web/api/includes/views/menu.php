<?php if($data->user) {?>
<nav class="navbar navbar-default navbar-static-top">
    <a class="navbar-brand" href="start"><img src="images/logo-32.png" title="<?=__UNIT_NAME?>" /></a>
    <ul class="nav navbar-nav">
        <li><a href="events">Events</a></li>
        <li><a href="forums">Forums</a></li>
    </ul>
    <p class="navbar-text text-right" style="float: none;">Hi <strong><?=$data->user->name?></strong> <a href="logout" class="btn btn-danger btn-xs">Logout</a></p>
</nav>
<?php } else { ?>
<nav class="navbar navbar-default navbar-static-top">
    <a class="navbar-brand" href="start"><img src="images/logo-32.png" title="<?=__UNIT_NAME?>" /></a>
    <p class="navbar-text">You are not logged in. <a href="register">Register now!</a></p>
    <form class="navbar-form" role="login" method="POST">
        <div class="form-group">
            <input name="name" type="text" class="form-control" placeholder="Name / Email">
            <input name="password" type="password" class="form-control" placeholder="Password" />
        </div>
        <button type="submit" class="btn btn-default">Login</button>
    </form>
</nav>
<?php } ?>
