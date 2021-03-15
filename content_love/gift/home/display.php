
<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div id="chartdivcmsticket" class="box chart x310 s0" data-abc='crm/tickets'>
      <div class="hide">
        <div id="charttitleunit"><?php echo T_("Count") ?></div>
        <div id="charttickettitle"><?php echo T_("Ticket") ?></div>
        <div id="chartmessagetitle"><?php echo T_("Message") ?></div>

        <div id="charttitle"><?php echo T_("Thicket and message in last years") ?></div>
        <div id="chartcategory"><?php echo a($dashboardDetail, 'chart', 'category') ?></div>
        <div id="chartdataticket"><?php echo a($dashboardDetail, 'chart', 'dataticket') ?></div>
        <div id="chartdatamessage"><?php echo a($dashboardDetail, 'chart', 'datamessage') ?></div>
      </div>
    </div>

  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
     <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/all">
          <i class="sf-gift"></i>
          <div class="key"><?php echo T_('All gift card');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'all')); ?></div>
          <div class="go search"></div>
        </a>
      </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/create">
          <i class="sf-asterisk"></i>
          <div class="key"><?php echo T_('Generate new gift card');?></div>
          <div class="go plus ok"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/all?status=awaiting">
        <i class="sf-heartbeat fc-hot"></i>
        <div class="key"><?php echo T_('Active card');?></div>
        <div class="value txtB"><?php echo \dash\fit::number(a($dashboardDetail, 'active')); ?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/all?status=expired">
        <i class="sf-exclamation-circle"></i>
        <div class="key"><?php echo T_('Expired card');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'expired')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/lookup">
        <i class="sf-thumbnails"></i>
        <div class="key"><?php echo T_('Lookup history');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'lookup')); ?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/lookup?verify=no">
        <i class="sf-times-circle"></i>
        <div class="key"><?php echo T_('Lookup failed');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'lookupfaild')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>



   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/usage">
        <i class="sf-wallet-money"></i>
        <div class="key"><?php echo T_('Gift usage');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'usage')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>



  </div>
</div>



<div class="row font-14 mT5">
  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><a class="fc-black" href="<?php echo \dash\url::this(). '/all?sort=datecreated&order=desc' ?>"><?php echo T_("Last usage") ?></a></p>
  <?php if(\dash\data::dashboardDetail_lastticket()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_lastticket() as $key => $value) {?>
        <li>
          <a class="f align-center" href="<?php echo \dash\url::this(). '/view?id='. $value['id'] ?>">
            <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
            <div class="key"><?php echo \dash\fit::mobile(a($value, 'displayname')); ?></div>

            <div class="key"><?php echo T_("Ticket"). ' '. \dash\fit::text($value['id']);  ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
            <div class="go"></div>
          </a>
         </li>
  <?php } //endfor ?>
       </ul>
     </nav>
<?php } else { ?>
  <p class="msg"><?php echo T_("No usage so far"); ?></p>
<?php } //endif ?>
  </div>


  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><a class="fc-black" href="<?php echo \dash\url::this(). '/all?act=y' ?>"><?php echo T_("Last lookup") ?></a></p>
    <?php if(\dash\data::dashboardDetail_activeticket()) {?>
    <nav class="items long">
       <ul>
  <?php foreach (\dash\data::dashboardDetail_activeticket() as $key => $value) { ?>
        <li>
          <a class="f align-center" href="<?php echo \dash\url::this(). '/view?id='. $value['id'] ?>">
            <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
            <div class="key"><?php echo \dash\fit::mobile(a($value, 'displayname')); ?></div>

            <div class="key"><?php echo T_("Ticket"). ' '. \dash\fit::text($value['id']);  ?></div>
            <div class="value"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
            <div class="go"></div>
          </a>
         </li>
  <?php } //endfor ?>
       </ul>
     </nav>
<?php } else { ?>
  <p class="msg"><?php echo T_("No lookup founded"); ?></p>
<?php } //endif ?>

  </div>

</div>
