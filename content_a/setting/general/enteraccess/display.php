<?php
$storeData = \dash\data::store_store_data();
\dash\data::storeData($storeData);

?>

<section class="f" data-option='cms-comment-defualt'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Allow customer to enter in your business");?></h3>
      <div class="body">
        <p><?php echo T_("If this feature is off no body can enter or signup in your business");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_enterdisallow" value="1">
      <div class="action">
        <div class="switch1">
          <input id="ienterdisallow" type="checkbox" name="enterdisallow" <?php if(\dash\data::storeData_enterdisallow()) {}else{ echo 'checked'; } ?>>
          <label for="ienterdisallow"></label>
        </div>
      </div>
  </form>
</section>


<div data-response='enterdisallow' <?php if(\dash\data::storeData_enterdisallow()) { echo "data-response-hide";} ?>>

<section class="f" data-option='cms-comment-defualt'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Allow customer to signup in your business");?></h3>
      <div class="body">
        <p><?php echo T_("If this feature is off no body can signup in your business");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_entersignupdisallow" value="1">
      <div class="action">
        <div class="switch1">
          <input id="ientersignupdisallow" type="checkbox" name="entersignupdisallow" <?php if(\dash\data::storeData_entersignupdisallow()) {}else{ echo 'checked'; } ?>>
          <label for="ientersignupdisallow"></label>
        </div>
      </div>
  </form>
</section>
</div>
