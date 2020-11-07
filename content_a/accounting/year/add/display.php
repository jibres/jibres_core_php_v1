


<form method="post" autocomplete="off">
  <div class="avand-md">
    <div class="box">
      <header><h2></h2></header>
      <div class="body">

        <label for="title"><?php echo T_("Title") ?></label>
        <div class="input">
          <input type="text" name="title" id="title" value="<?php echo \dash\data::dataRow_title() ?>" required>
        </div>

        <div class="row">
          <div class="c-sm-6">
            <label for="date" ><?php echo T_("Start Date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
            <div class="input">
              <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="startdate" id="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_startdate())); ?>" autocomplete='off' <?php if(\dash\data::editMode() || \dash\data::dataRow_startdate())  {echo 'disabled';}else{echo 'required';}?>>
            </div>
            <?php if(\dash\data::dataRow_startdate() && !\dash\data::editMode()) {?>
              <input type="hidden" name="startdate" value="<?php echo \dash\data::dataRow_startdate() ?>">
            <?php } //endif ?>
          </div>
          <div class="c-sm-6">
            <label for="date" ><?php echo T_("End Date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
            <div class="input">
              <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="enddate" id="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_enddate())); ?>" autocomplete='off' <?php if(\dash\data::editMode())  {echo 'disabled';}else{echo 'required';}?>>
            </div>
          </div>
        </div>



      </div>
      <?php if(\dash\data::editMode()) {?>
        <footer class="f">
          <div class="cauto">
            <div data-confirm data-data='{"remove": "remove"}' class="btn linkDel"><?php echo T_("Remove") ?></div>
          </div>
          <div class="c"></div>
          <div class="cauto">
            <button class="btn success"><?php echo T_("Edit") ?></button>
          </div>

        </footer>
      <?php }else{ ?>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Add") ?></button>
        </footer>
      <?php } //endif ?>
    </div>
  </div>
</form>


