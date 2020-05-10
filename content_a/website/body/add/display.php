<div class="avand">
<div class="msg info2 fs14"><?php echo T_("Please choose type of new block."); ?></div>

<section class="f" data-option='website-block-slider'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Slider");?></h3>
      <div class="body">
        <p><?php echo T_("Show multiple images in one place to change like a carousel. It's responsive and touchable for mobile users. The last carousel you'll ever need."); ?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that();?>/slider"><?php echo T_("Add Slider") ?></a>
    </div>
  </div>
</section>


<section class="f" data-option='website-block-latestnews'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Latest News");?></h3>
      <div class="body">
        <p><?php echo T_("A block to show latest news for blog."); ?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that();?>/latestbews"><?php echo T_("Add Latest News") ?></a>
    </div>
  </div>
</section>




  <form method="post" autocomplete="off">
    <div class="box">
      <header><h2><?php echo T_("Add new line") ?></h2></header>
      <div class="body">
        <p><?php echo T_("Choose your line type and after add the line you can customize it"); ?></p>
        <div>
          <label><?php echo T_("Line"); ?></label>
          <select name="line" class="select22">
            <option></option>
            <?php foreach (\dash\data::bodyLine() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'key'); ?>"><?php echo \dash\get::index($value, 'title'); ?></option>
            <?php } //endfor ?>
          </select>
        </div>
      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </form>
</div>