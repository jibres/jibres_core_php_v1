
<form class="f" method='post' autocomplete="off">
  <div class="c8 s12 pRa10">
    <div class="cbox">
      <div class="msg info"><?php echo \dash\data::dataRow_content(); ?></div>
      <?php if(\dash\data::answerList()) {?>
        <?php foreach (\dash\data::answerList() as $key => $value) {?>
          <div class="msg"><?php echo \dash\get::index($value, 'content'); ?></div>
        <?php } //endfor ?>
      <?php } //endif ?>

      <h4><?php echo T_("New Answer"); ?></h4>
      <textarea class="txt" rows="10" name="answer"></textarea>

      <div class="txtRa">
        <button class="btn primary mT10"><?php echo T_("Submit answer") ?></button>
      </div>
    </div>

  </div>
  <div class="c4 s12">

    <div class="cbox">

     <div class="msg"><?php echo T_("Submitted on"); ?> <b><?php echo \dash\fit::date_human(\dash\data::dataRow_datecreated()); ?></b></div>
     <div class="msg"><?php echo T_("Updated on"); ?> <b><?php echo \dash\fit::date_human(\dash\data::dataRow_datemodified()); ?></b></div>
     <div class="msg">
      <?php echo T_("Current status"); ?> <b> <?php echo T_(ucfirst(\dash\data::dataRow_status())); ?> </b>
     </div>
     <?php if(\dash\data::dataRow_post_id()) {?>

     <div class="msg"><a href="<?php echo \dash\url::kingdom(); ?>/n/<?php echo \dash\data::dataRow_post_id() ?>"><?php echo \dash\data::dataRowPost_title(); ?></a></div>
     <?php } //endif ?>



    </div>


  </div>
</form>

