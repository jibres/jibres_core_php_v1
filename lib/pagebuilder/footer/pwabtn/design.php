<?php
$lineSetting = \dash\data::lineSetting();

if(!\lib\pagebuilder\tools\tools::in('pwabtn')) {?>

<section class="f" data-option='website-change-pwabtn'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Customize PWA Button");?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::current(). '/pwabtn'. \dash\request::full_get();?>"><?php echo T_("Customize") ?></a>
    </div>
  </div>
</section>

<?php }else{ ?>

<div class="avand-md">
  <form method="post" autocomplete="off">
    <input type="hidden" name="set_pwabtn" value="1">
    <div class="box">
      <div class="pad">
        <?php for ($i=1; $i < 5; $i++) { HTML_pwaLink($i, $lineSetting); } ?>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>

<?php } // endif


function HTML_pwaLink($i, $lineSetting){
  $icon_list =
  [
    'home'            => 'home',
    'th-large'        => 'th-large',
    'shopping-cart'   => 'shopping-cart',
    'user'            => 'user',
    'globe'           => 'globe',
    'gauge'           => 'gauge',
    'question-circle' => 'question-circle',
    'tags'            => 'tags',
    'bars'            => 'bars',
    'book'            => 'book',
    'quote-right'     => 'quote-right',
    'news'            => 'news',
    'pound'           => 'pound',
  ];
  ?>
<div>
  <hr>
  <span class="mT10-f"><?php echo \dash\fit::number($i) ?></span>
  <div class="row">
    <div class="c-xs-12 c-sm-5">
      <label for="pwa_title_<?php echo $i ?>"><?php echo T_("Title"); ?></label>
      <div class="input">
        <input type="text" name="pwa_title_<?php echo $i ?>" value="<?php echo a($lineSetting, 'detail', 'pwabtn', 'title_'. $i) ?>">
      </div>
    </div>
    <div class="c-xs-12 c-sm-5">
      <label for="pwa_url_<?php echo $i ?>"><?php echo T_("Url"); ?></label>
      <div class="input">
        <input type="text" name="pwa_url_<?php echo $i ?>" value="<?php echo a($lineSetting, 'detail', 'pwabtn', 'url_'. $i) ?>">
      </div>
    </div>
    <div class="c-xs-12 c-sm-2">
      <label for="pwa_icon_<?php echo $i ?>"><?php echo T_("Icon"); ?></label>
      <div>
        <select  class="select22" name="pwa_icon_<?php echo $i ?>" id="pwa_icon_<?php echo $i ?>">
          <?php foreach ($icon_list as $key => $value) {?>
          <option value="<?php echo $key ?>" <?php if(a($lineSetting, 'detail', 'pwabtn', 'icon_'. $i) == $key ) {echo 'selected';} ?>><i class="sf-<?php echo $key ?>"></i> <?php echo $value ?></option>
          <?php } //endif ?>
        </select>
      </div>
    </div>
  </div>
</div>


<?php } // endfunction ?>