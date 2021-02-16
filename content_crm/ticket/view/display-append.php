<form method="post" autocomplete="off">
  <?php if($customer_mode){ \dash\csrf::html(false); } ?>
  <div class="box">
    <div class="pad">
      <textarea class="txt" <?php if(!$customer_mode){echo 'name="answer" data-editor="simple"';}else{echo 'name="content"';} ?> rows="4" placeholder='<?php if(!$customer_mode) { echo T_("Answer to ticket"); }else{ echo T_("Write your message");} ?>'></textarea>

      <div class="showAdvanceAnswer" data-kerkere-content='hide'>

          <?php if(!$customer_mode) {?>
          <div class="check1">
            <input type="checkbox" name="sendmessage" id="sendmessage" checked>
            <label for="sendmessage"><?php echo T_("Send notify about your answer to creator of ticket"); ?></label>
          </div>

         <div class="check1">
            <input type="checkbox" name="note" id="inote">
            <label for="inote"><?php echo T_("Add yout message as note."); ?> <small><?php echo T_('Users do not see the notes and only the system administrator sees them') ?></small></label>
          </div>
        <?php } //endif ?>
      </div>
    </div>
    <footer class="f">
      <div class="cauto"><div class="btn secondary outline" data-kerkere='.showAdvanceAnswer'><?php echo T_("Advance") ?></div></div>
      <div class="c"></div>
      <div class="cauto">
        <?php if($customer_mode) {?>
          <button class="btn master"><?php echo T_("Send ticket"); ?></button>
        <?php }else{ ?>
          <button class="btn master"><?php echo T_("Send answer"); ?></button>
        <?php } //endif ?>
      </div>
    </footer>
  </div>
</form>

