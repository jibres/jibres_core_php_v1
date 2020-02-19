
<div class="cbox ltr">
  <?php if(\dash\request::Get('file')) {?>

    <a href="<?php echo \dash\url::this(); ?>" class="block mT10 btn primary outline "><?php echo T_("Back"); ?></a>
    <form method="post">

      <div class="ltr mT50">
        <label for="file" class="ltr xl"><?php echo \dash\data::readFileAddr(); ?></label>
        <textarea class="txt ltr" rows="20" name="fileContent"><?php echo \dash\data::readFile(); ?></textarea>
      </div>
       <button type="submit" class="block mT10 btn danger "><?php echo T_("Save"); ?></button>
    </form>

  <?php }else{ ?>

    <div class="f">
      <a href="<?php echo \dash\url::this(); ?>?file=gitconfig" class="c5 mLa50 mT10 btn primary outline"><code>git config</code></a>

    </div>
  <?php } //endif ?>
</div>
