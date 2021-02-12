<?php if(\dash\data::customerReview_count()) {?>
 <section class="box reviewComments">
  <header>
    <h2><?php echo T_("User reviews"); ?></h2>
  </header>
  <div class="body">
    <div class="row allReviewSummary">
      <div class="c-auto c-xs-0">
        <div class="ratingAvg"><?php echo \dash\fit::text(\dash\data::customerReview_avg()); ?></div>
        <div class="ratingSummary">
          <div class="starRating compact" data-star='<?php echo \dash\data::customerReview_avg(); ?>' data-gold>
            <i></i><i></i><i></i><i></i><i></i>
          </div>
          <span><?php echo \dash\fit::number(\dash\data::customerReview_count()); ?></span>
        </div>
      </div>
      <div class="c c-xs-12 rating">
        <div class="row">
          <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("5"); ?></span></div>
          <div class="c"><progress value="<?php echo a(\dash\data::customerReview(),'star_5_percent'); ?>" max="100"></progress></div>
          <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(a(\dash\data::customerReview(),'star_5_percent')). ' '. T_("%"); ?></span></div>
        </div>
        <div class="row">
          <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("4"); ?></span></div>
          <div class="c"><progress value="<?php echo a(\dash\data::customerReview(),'star_4_percent'); ?>" max="100"></progress></div>
          <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(a(\dash\data::customerReview(),'star_4_percent')). ' '. T_("%"); ?></span></div>
        </div>
        <div class="row">
          <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("3"); ?></span></div>
          <div class="c"><progress value="<?php echo a(\dash\data::customerReview(),'star_3_percent'); ?>" max="100"></progress></div>
          <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(a(\dash\data::customerReview(),'star_3_percent')). ' '. T_("%"); ?></span></div>
        </div>
        <div class="row">
          <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("2"); ?></span></div>
          <div class="c"><progress value="<?php echo a(\dash\data::customerReview(),'star_2_percent'); ?>" max="100"></progress></div>
          <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(a(\dash\data::customerReview(),'star_2_percent')). ' '. T_("%"); ?></span></div>
        </div>
        <div class="row">
          <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("1"); ?></span></div>
          <div class="c"><progress value="<?php echo a(\dash\data::customerReview(),'star_1_percent'); ?>" max="100"></progress></div>
          <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(a(\dash\data::customerReview(),'star_1_percent')). ' '. T_("%"); ?></span></div>
        </div>
      </div>
    </div>


<?php $commentList = \dash\data::commentList(); if($commentList) { ?>
    <div class="commnetList">
<?php foreach ($commentList as $key => $value){ ?>
     <div class="msg">
      <div class="row align-center">
        <div class="c-auto c-xs-12">
          <img class="customerImg" src="<?php echo a($value, 'avatar'); ?>" alt='<?php echo a($value, 'displayname'); ?>'>
        </div>
        <div class="c c-xs-12">
          <div class="msg minimal row align-center">
            <div class="c-auto c-xs-12">
              <div class="starRating" data-star='<?php echo $value['star']; ?>'>
                <i></i><i></i><i></i><i></i><i></i>
              </div>
            </div>
            <div class="c"><?php echo a($value, 'displayname'); ?></div>
            <div class="c-auto ltr txtRa"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
          </div>
          <p><?php echo $value['content']; ?></p>
        </div>
      </div>
     </div>
<?php   } // end for ?>
    </div>
<?php } // end if ?>
  </div>
</section>
<?php } //endif ?>
