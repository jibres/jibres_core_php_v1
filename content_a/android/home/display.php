<?php require_once(root. 'content_a/android/setupGuide.php'); ?>

<div class="f">
  <div class="c8 x9 s12">
    <div class="f">
      <div class="c pRa5">
        <a href="" class="stat">
          <h3><?php echo T_("Total Download");?></h3>
          <div class="val"><?php echo \dash\fit::number(5000);?></div>
        </a>
      </div>
      <div class="c pRa5">
        <div class="stat">
          <h3><?php echo T_("Total Install");?></h3>
          <div class="val"><?php echo \dash\fit::number(3600);?></div>
        </div>
      </div>
      <div class="c">
        <div class="stat">
          <h3><?php echo T_("Active Install");?></h3>
          <div class="val"><?php echo \dash\fit::number(1200);?></div>
        </div>
      </div>
    </div>


    <div class="dcard x3 pA0">
     <div id="chartdiv" class="chart" ></div>
    </div>
  </div>

  <div class="c4 x3 s12">
    <a class="mobileFrame" data-apk href="<?php echo \dash\url::this();?>/apk">
      <div class="screen">
        <p><?php echo T_("Click to check your app status"); ?></p>
      </div>
    </a>
  </div>
</div>


