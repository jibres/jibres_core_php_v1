<div class="row">
  <div class="c-sm-5">

<form method="post" autocomplete="off">
  <div class="avand-lg">
    <div class="box">
      <header><h2><?php echo T_("Add new accounting doc") ?></h2></header>
      <div class="body">



        <div class="row">
          <div class="c-sm-6">
            <label for="number"><?php echo T_("Number") ?></label>
            <div class="input">
              <input type="number" min="1" max="999999999999999999" name="number" id="number" required  value="<?php echo \dash\data::dataRow_number() ?>">
            </div>
          </div>
          <div class="c-sm-6">
            <label for="date" ><?php echo T_("Date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
        		<div class="input">
        		<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="date" id="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_date())); ?>" autocomplete='off' required>
        		</div>
          </div>
        </div>



        <label for="desc"><?php echo T_("Description") ?></label>
        <div class="input">
          <input type="text" name="desc" id="desc" value="<?php echo \dash\data::dataRow_desc() ?>">
        </div>



      </div>
      <?php if(\dash\data::editMode()) {?>
      <footer class="f">
        <div class="cauto">
          <div data-confirm data-data='{"remove": "remove"}' class="btn danger"><?php echo T_("Remove") ?></div>
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
<?php require_once('display-docdetail.php'); ?>
  </div>
  <div class="c-sm-7">

<?php require_once('display-list.php'); ?>
  </div>
</div>
