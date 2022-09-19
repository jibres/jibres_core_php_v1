<?php if(\dash\data::countNotReviewed()) {?>
   <div class="alert-secondary text-sm row align-center mb-2">
     <div class="c c-xs-12 font-bold"><?php echo T_("You have :val not reviewed answer", ['val' => \dash\fit::number(\dash\data::countNotReviewed())]) ?></div>
     <div class="c-auto c-xs-12"><div class="btn-outline-secondary btn-sm" data-confirm data-data='{"mark": "all"}'><?php echo T_("Mark all as review") ?></div></div>
   </div>
<?php } ?>