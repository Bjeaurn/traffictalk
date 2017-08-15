<?php require_once("menu.php"); ?>
<div class="container">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <p class="lead">Register to <?=__UNIT_NAME?></p>
    </div>
    <?php if($data->error) { ?>
        <?php foreach($data->error as $e) {?>
            <p class="alert alert-danger col-md-6 col-md-offset-2"><?=$e?></p>
    <?php }
    } ?>
    <form class="form-horizontal col-md-12" method="post">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Display name</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="name" name="name" placeholder="Name">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-8">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <p class="help-block">Password needs to be more than 6 characters and at least contain both letters and numbers.</p>
          </div>
      </div>
      <div class="form-group">
        <label for="inputPassword4" class="col-sm-2 control-label">Confirm password</label>
        <div class="col-sm-8">
          <input type="password" class="form-control" id="password" name="passwordConfirm" placeholder="Confirm password">
        </div>
      </div>
      <div class="form-group">
        <label for="check" class="col-sm-2 control-label"><?=$data->human1?> + <?=$data->human2?></label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="control" name="control" placeholder="Solve me: <?=$data->human1?> + <?=$data->human2?>" />
            <input type="hidden" value="<?=$data->result?>" name="resultCheck" />
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </div>
    </form>
</div>
