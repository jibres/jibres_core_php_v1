<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set share telegrma Button");?></h2></header>
      <div class="body">
        <p><?php echo T_("When posting on the Telegram channel, you can put a few buttons below it, each of which is connected to one of your social networks. Here you can set which buttons you want to be under your Telegram post.");?></p>

        <a class="btn link mB20" href="<?php echo \dash\url::this() ?>/social"><?php echo T_("Config Social networks id") ?></a>

          <div class="action f">
          <?php $social = \lib\store::social(); if(!is_array($social)) { $social = []; } ?>
          <?php if(!$social) {?>
            <div class="msg"><?php echo T_("Please set your social network id") ?></div>
          <?php }else{ ?>
              <div class="f">

            <?php foreach ($social as $key => $value) { if($key === 'email') {continue;}?>
              <div class="c6">
                <div class="check1">
                  <input type="checkbox" name="<?php echo $key; ?>" id="myid<?php echo $key; ?>" <?php if(\dash\get::index(\dash\data::telegramSettingSaved(), 'telegrambtn', $key)) { echo 'checked';} ?>>
                  <label for="myid<?php echo $key; ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
                </div>
              </div>
            <?php } //endfor ?>
              </div>
          <?php } //endif ?>


          </div>

      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>
</div>

</form>