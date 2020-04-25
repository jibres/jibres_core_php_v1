<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Gift card message"); ?></h2></header>

      <div class="body">

        <div class="mB20">
          <label for="desc"><?php echo T_("Description"); ?></label>
          <textarea id="desc" name="desc" class="txt" rows="5"><?php echo \dash\data::dataRow_msgsuccess(); ?></textarea>
        </div>

        <label for="msgsuccess"><?php echo T_("Success msg"); ?></label>
        <textarea id="msgsuccess" name="msgsuccess" class="txt" rows="5"><?php echo \dash\data::dataRow_msgsuccess(); ?></textarea>


      </div>

      <footer class="txtRa">
        <button class="btn primary"><?php echo T_("Save & Next"); ?></button>
      </footer>
    </form>
  </div>
</div>