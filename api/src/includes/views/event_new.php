<?php require_once("menu.php"); ?>
<div class="col-md-6">
  <form method="post">
    <div class="form-group">
      <label class="form-label">Name of event</label>
      <input type="text" name="name" required class="form-control input-lg" placeholder="Name for the event" />
    </div>
    <div class="form-group">
      <label class="form-label">Category</label>
      <input type="text" name="category" class="form-control" placeholder="Category of event (e.g.: Counter-Strike: Global Offensive, ARMA, FPS, MMORPG, fun, etc?)" />
    </div>
    <div class="form-group col-md-6">
      <label class="form-label">Start</label>
      <input type="datetime" name="startDate" value="<?=$data->start?>" required class="form-control" placeholder="Start date/time, in DD-MM-YYYY HH:II" />
    </div>
    <div class="form-group col-md-6">
      <label class="form-label">End</label>
      <input type="datetime" name="endDate" value="<?=$data->start?>" required class="form-control" placeholder="Start date/time, in DD-MM-YYYY HH:II" />
    </div>
    <div class="form-group">
      <label class="form-label">Description (optional)</label>
      <textarea name="description" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success">Add event</button>
    </div>
  </form>
</div>
