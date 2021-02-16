<?php $dashboardDetail = \dash\data::dashboardDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <div id="chartdivcmsticket" class="box chart x350 s0" data-abc='crm/tickets'>
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
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist">
          <i class="sf-heart-o"></i>
          <div class="key"><?php echo T_('All tickets');?></div>
          <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'tickets')); ?></div>
          <div class="go search"></div>
        </a>
      </li>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/add">
          <i class="sf-asterisk"></i>
          <div class="key"><?php echo T_('Add new ticket');?></div>
          <div class="go plus"></div>
        </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?status=awaiting">
        <i class="sf-spin-alt fc-hot"></i>
        <div class="key"><?php echo T_('Awaiting answer');?></div>
        <div class="value txtB"><?php echo \dash\fit::number(a($dashboardDetail, 'awaiting')); ?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?status=close">
        <i class="sf-archive"></i>
        <div class="key"><?php echo T_('Closed tickets');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'close')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>

   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?so=y">
        <i class="sf-check"></i>
        <div class="key"><?php echo T_('Solved tickets');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'solved')); ?></div>
        <div class="go"></div>
       </a>
      </li>
       <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/datalist?so=n">
        <i class="sf-exclamation-triangle"></i>
        <div class="key"><?php echo T_('Unsolved tickets');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'unsolved')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>



   <nav class="items long">
     <ul>
      <li>
       <a class="item f" href="<?php echo \dash\url::this();?>/message">
        <i class="sf-align-left"></i>
        <div class="key"><?php echo T_('All messages');?></div>
        <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'message')); ?></div>
        <div class="go"></div>
       </a>
      </li>
     </ul>
   </nav>


   <nav class="items long">
     <ul>
      <li>
       <a class="item f">
        <i class="sf-clock"></i>
        <div class="key"><?php echo T_('The average time of the first response');?></div>
        <div class="value"><?php echo \dash\utility\human::time(a($dashboardDetail, 'answertime'), true); ?></div>
        <div class="go detail"></div>
       </a>
      </li>
     </ul>
   </nav>




  </div>
</div>



<div class="row font-14 mT5">
  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><a class="fc-black" href="<?php echo \dash\url::this(). '/datalist?sort=datecreated&order=desc' ?>"><?php echo T_("Last tickets") ?></a></p>
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
  <p class="msg"><?php echo T_("No ticket have been received so far"); ?></p>
<?php } //endif ?>
  </div>


  <div class="c-xs-12 c-sm-12 c-md-6">
    <p class="mB5-f font-14"><a class="fc-black" href="<?php echo \dash\url::this(). '/datalist?act=y' ?>"><?php echo T_("Last active tickets") ?></a></p>
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
  <p class="msg"><?php echo T_("No active ticket founded"); ?></p>
<?php } //endif ?>

  </div>

</div>
