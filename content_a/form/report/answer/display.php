

<?php if(\dash\data::noChart()) {?>
  <div class="msg warn txtC txtB fs14"><?php echo T_("Can not drow chart for this item!") ?></div>
<?php }else{ ?>

<?php $myData = \dash\data::reportDetail(); ?>

   <section class="f">
     <div class="c s12 pRa10">
      <a class="stat">
       <h3><?php echo T_("Count all answer");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'count_answer_all'));?></div>
      </a>
     </div>
     <div class="c s6 pRa10">
      <a class="stat">
       <h3><?php echo T_("Answer to this item");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'count_answer_item'));?></div>
      </a>
     </div>
     <div class="c s6">
      <a class="stat">
       <h3><?php echo T_("Count not answer");?></h3>
       <div class="val"><?php echo \dash\fit::stats(\dash\get::index($myData, 'count_not_answer'));?></div>
      </a>
     </div>

     <div class="c s6">
      <a class="stat ltr">
       <h3><?php echo T_("Percent answer");?></h3>
       <div class="val"><?php echo T_("%"); ?> <?php echo \dash\fit::stats(\dash\get::index($myData, 'percent_answer'));?></div>
      </a>
     </div>
    </section>

<div class="msg info2 txtB font-14"><?php echo \dash\data::itemDetail_title() ?></div>


<?php if(\dash\get::index($myData, 'chart_type') === 'pie') {?>

  <?php require_once('display-pie.php'); ?>

<?php }elseif(\dash\get::index($myData, 'chart_type') === 'bar') {?>

  <?php require_once('display-bar.php'); ?>

<?php }elseif(\dash\get::index($myData, 'chart_type') === 'province') {?>

  <?php require_once('display-province.php'); ?>

<?php }else{ ?>

<div class="msg warn txtB font-14">Not ready this chart yet :/</div>

<?php } //endif ?>
<?php } //endif ?>
