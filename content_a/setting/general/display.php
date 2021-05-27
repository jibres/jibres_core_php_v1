
<div class="avand-md">
    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/general/title"><div class="key"><?php echo T_("Store title"); ?></div><div class="go"></div></a></li>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/logo"><div class="key"><?php echo T_("Set logo of your store"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/general/lang"><div class="key"><?php echo T_("Business language"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

    <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::this(); ?>/units"><div class="key"><?php echo T_("Business units"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>


     <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::that(); ?>/nosale"><div class="key"><?php echo T_("No-Shopping Business"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>


        <nav class="items">
      <ul>
        <li><a class="f" href="<?php echo \dash\url::that(); ?>/remove"><div class="key"><?php echo T_("Remove business"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

</div>


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
