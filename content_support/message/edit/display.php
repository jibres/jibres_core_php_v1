

<div class="f">
  <div class="cbox">
    <form method="post">
      <label for="content"><?php echo T_("Content"); ?></label>

           <?php if(\dash\permission::check('supportTicketSignature')) {?>

            <textarea class="txt mB10" data-editor id='icontent' name="content"  maxlength='100000' ><?=  str_replace('&', '&amp;', \dash\data::masterTicketDetail_content()); ?></textarea>

          <?php }else{ ?>
            <textarea class="txt mB10" id='icontent' name="content" placeholder='' maxlength='1000' rows="5"><?php echo \dash\data::masterTicketDetail_content(); ?></textarea>

          <?php } //endif ?>


      <button class="btn block mTB10 primary" ><?php echo T_("Save"); ?></button>
      <?php if(\dash\permission::supervisor()) {?>

        <div data-confirm data-data='{"removeMessage": 1, "parent" : "<?php echo \dash\data::masterTicketDetail_parent(); ?>"}' class="floatL btn mTB10 mB10 danger"><?php echo T_("Remove"); ?></div>
      <?php } //endif ?>
    </form>
  </div>
</div>

