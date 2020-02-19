

<div class="f justify-center">

  <div class="c7 m8 s12">
    <div class="cbox">
      <form method="post">

        <div class="switch1">
         <input type="checkbox" name="active" id="active" <?php if(\dash\data::cronjob()) { echo 'checked';} ?>>
         <label for="active"></label>
         <label for="active"><?php echo T_("Run cronjob for this service"); ?>
         </label>
        </div>

        <button class="btn primary block"><?php echo T_("Save"); ?></button>
    </form>


      <div class="txtRa">
        <a class="btn mT20 danger" target="_blank" href="<?php echo \dash\url::site(); ?>/hook/crontab"><?php echo T_("Manual execute"); ?></a>

      </div>
    </div>
  </div>

</div>




<div class="f justify-center">

  <div class="c7 m8 s12">
    <div class="cbox ltr">


      <h3><code>UNIX crontab</code></h3>
        <?php echo nl2br(\dash\data::unixcrontab()); ?>

    </div>
  </div>

</div>







