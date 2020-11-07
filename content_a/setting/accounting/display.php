
<section class="f" data-option='accounting-setting-unit'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Accounting Currency");?></h3>
      <div class="body">
        <p><?php echo T_("Set your accounting Currency");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
        	<a class="btn master" href="<?php echo \dash\url::that(). '/currency' ?>"><?php echo T_("Set Currency") ?></a>
      </div>
  </div>
</section>



<section class="f" data-option='accounting-setting-doc-number'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Reset accounting document number");?></h3>
      <div class="body">
        <p><?php echo T_("Reset accounting document number");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
          <a class="btn master" href="<?php echo \dash\url::that(). '/resetnumber' ?>"><?php echo T_("Choose accounting year") ?></a>
      </div>
  </div>
</section>




<section class="f" data-option='accounting-setting-defautl-doc'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Default accounting detail");?></h3>
      <div class="body">
        <p><?php echo T_("In some cases, the system automatically issues documents that need a specific title. Set these titles in this section.");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
          <a class="btn master" href="<?php echo \dash\url::that(). '/defaultdetail' ?>"><?php echo T_("Set default accounting detail") ?></a>
      </div>
  </div>
</section>
