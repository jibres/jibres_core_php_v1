<form method="post" autocomplete="off">
  <div class="avand-lg">
    <div class="box">
      <header><h2><?php echo T_("Add new accounting coding") ?></h2></header>
      <div class="body">

        <label for="title"><?php echo T_("Title") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="text" name="title" id="title" required value="<?php echo \dash\data::dataRow_title(); ?>">
        </div>


      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </div>
</form>
