<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Telegram Text");?></h2></header>
      <div class="body">
        <p><?php echo T_("Telegram.me");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">
            <div class="c12 mB5">
              <label for="text"><?php echo T_("Text"); ?></label>
              <textarea name="text" id="text" class="txt" rows="5"><?php echo \dash\data::telegramSettingSaved_text(); ?></textarea>
            </div>
          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>
</div>

</form>