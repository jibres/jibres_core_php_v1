<?php $lineSetting = \dash\data::lineSetting();  ?>
<?php if(\lib\pagebuilder\tools\tools::in('color')) {?>
  <form method="post" autocomplete="off" id="form1" data-patch>
    <input type="hidden" name="set_color" value="1">
    <div class="avand-sm">
      <div class="box">
        <div class="pad">

          <label for="bg_color"><?php echo T_("Background Color") ?></label>
          <div class="input w100">
            <input type="color" name="bg_color" id="bg_color" value="<?php echo a($lineSetting, 'background', 'bg_color'); ?>">
          </div>


          <label for="txt_color"><?php echo T_("Text Color") ?></label>
          <div class="input w100">
            <input type="color" name="txt_color" id="txt_color" value="<?php echo a($lineSetting, 'background', 'txt_color'); ?>">
          </div>

        </div>
      </div>
    </div>
  </form>
<?php }else{  // url subchild is title ?>
<section class="f" data-option='website-change-color'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Customize Color");?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::current(). '/color'. \dash\request::full_get();?>"><?php echo T_("Customize") ?></a>
    </div>
  </div>
</section>
<?php } //endif ?>