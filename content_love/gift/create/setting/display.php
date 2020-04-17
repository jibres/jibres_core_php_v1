<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Create new gift card"); ?></h2></header>

      <div class="body">

        <label for="dateexpire" ><?php echo T_("Expire date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
        <div class="input">
        <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="dateexpire" value="<?php echo \dash\data::dataRow_dateexpire(); ?>" id="dateexpire" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
        </div>

        <div class="switch1 mB20">
         <input type="checkbox" name="physical" id="physical"  <?php if(\dash\data::dataRow_physical()) { echo 'checked'; } ?> >
         <label for="physical" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
         <label for="physical"><?php echo T_("Physical card?"); ?></label>
        </div>

        <div class="switch1 mB20">
         <input type="checkbox" name="chap" id="chap"  <?php if(\dash\data::dataRow_chap()) { echo 'checked'; } ?> >
         <label for="chap" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
         <label for="chap"><?php echo T_("Are you want to print this gift card?"); ?></label>
        </div>


      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>