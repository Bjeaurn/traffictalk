<?php require_once("menu.php"); ?>
<div class="col-md-12">
    <div class="col-md-8">
            <?php if($data->user) { ?>
            <?php } ?>
            <script>
              <?php if($data->user) {?>var user = <?php echo json_encode($data->user); ?>; <?php }?>
              var chat = <?php echo json_encode($data->chat); ?>;
            </script>
            <chat></chat>
    </div>
    <div class="col-md-4">
        <div>
          <?php if($data->events) {?>
          <h4><a href="events">Events</a></h4>
            <div class="events">
              <table class="table">
                <?php foreach($data->events as $event) {?>
                <tr>
                  <td><a href="events/<?=$event->id?>"><?=$event->name?></a></td>
                  <td class="small" align="right"><span data-toggle="tooltip" data-placement="top" title="<?=$event->startDateTime?>"><?=$event->startText?></span></td>
                </tr>
                <?php }?>
              </table>
              </div>
        <?php } ?>
      </div>
        <div>
            <h4>TeamSpeak</h4>
            <div id="ts3viewer_1093657" style=""> </div>
        </div>
    </div>
</div>
