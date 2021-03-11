<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Set code of gift card"); ?></h2></header>

      <div class="body">

        <label for="code"><?php echo T_("Gift code"); ?></label>
        <div class="input ltr">
          <input type="text" name="code" value="<?php echo \dash\data::dataRow_code(); ?>" id="code" maxlength="100" >
        </div>

               <select name="category" id="category" class="select22" data-model='tag' data-placeholder='<?php echo T_("Gift category"); ?>' >
            <option value=""><?php echo T_("Gift category"); ?></option>
          <?php if(\dash\data::dataRow_category()) {?>
            <option value="0"><?php echo T_("Without category"); ?></option>
          <?php } //endif ?>
<?php foreach (\dash\data::giftCategory() as $key => $value) {?>
            <option value="<?php echo $value; ?>" <?php if($value == \dash\data::dataRow_category()) { echo 'selected'; } ?> ><?php echo $value; ?></option>
<?php } //endfor ?>
        </select>

      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>