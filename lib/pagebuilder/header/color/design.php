<?php $lineSetting = \dash\data::lineSetting();  ?>
<?php if(\lib\pagebuilder\tools\tools::in('color')) {?>
  <form method="post" autocomplete="off" id="form1" data-patch>
    <input type="hidden" name="set_color" value="1">
    <div class="avand-sm">
      <div class="box">
        <div class="pad">
          <h4><?php echo T_("Color Template") ?></h4>
          <?php $colorTemplate = \lib\pagebuilder\header\color\color::template(); $templateSelected = false; ?>
          <?php foreach ($colorTemplate as $key => $value) {
            $selected = false;
            if(a($value, 'txt_color') === a($lineSetting, 'background', 'txt_color') && a($value, 'bg_color') === a($lineSetting, 'background', 'bg_color'))
            {
              $selected = true;
              $templateSelected = true;
            }
            ?>
            <div class="txtC" data-ajaxify data-data='{"set_color": 1, "bg_color": "<?php echo a($value, 'bg_color') ?>", "txt_color": "<?php echo a($value, 'txt_color') ?>"}'>
              <div class="pA10" style="background-color: <?php echo a($value, 'bg_color'); ?>; color: <?php echo a($value, 'txt_color') ?>;">
                <div class="row">
                  <div class="c-auto">
                    <?php if($selected) {?>
                      <i class="sf-check fc-green"></i>
                    <?php } //endif ?>
                  </div>
                  <div class="c">
                    <span class="txtB"><?php echo a($value, 'title') ?></span>
                  </div>
                </div>
              </div>
            </div>
          <?php } //endif ?>
          <h4 class="mT20" data-kerkere='.showMore' data-kerkere-icon><?php echo T_("Custome Color") ?></h4>
          <div class="showMore" <?php if($templateSelected){ echo 'data-kerkere-content="hide"';} ?>>
             <div class="row">
              <div class="c-xs-6 c-sm-6">
                <label for="bg_color"><?php echo T_("Background Color") ?></label>
                <div class="input w100">
                  <input type="color" name="bg_color" id="bg_color" value="<?php echo a($lineSetting, 'background', 'bg_color'); ?>">
                </div>
              </div>
              <div class="c-xs-6 c-sm-6">
                <label for="txt_color"><?php echo T_("Text Color") ?></label>
                <div class="input w100">
                  <input type="color" name="txt_color" id="txt_color" value="<?php echo a($lineSetting, 'background', 'txt_color'); ?>">
                </div>
              </div>
           </div>
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