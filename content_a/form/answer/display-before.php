<?php if(\dash\data::countNotReviewed()) {?>
   <div class="alert-info text-sm flex align-center mb-2">
     <div class="c font-bold"><?php echo T_("You have :val not reviewed answer", ['val' => \dash\fit::number(\dash\data::countNotReviewed())]) ?></div>
     <div class="cauto"><div class="btn-primary btn-sm" data-confirm data-data='{"mark": "all"}'><?php echo T_("Mark all as review") ?></div></div>
   </div>
<?php } ?>