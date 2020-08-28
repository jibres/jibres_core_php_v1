<?php
$storeData = \dash\data::store_store_data();
?>
<form method="post" autocomplete="off">

  <div class="avand-md">

    <div class="box">
      <div class="body">



          <div class="switch1">
          <input type="checkbox" name="nosale" id="nosale" <?php if(\dash\get::index($storeData, 'nosale')) { echo 'checked'; } ?>>
          <label for="nosale" data-on="<?php echo T_("Yes"); ?>" data-off="<?php echo T_("No") ?>"></label>
          <label for="nosale"><?php echo T_("Is your business not able to sell goods or services?"); ?></label>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </div>


  </div>
</form>



