 <section class="box addCommentBox">
  <header>
    <h3><?php echo T_("Write your comment"); ?></h3>
  </header>
  <div class="body">
    <form method="post" data-refresh autocomplete="off" action="<?php echo \dash\url::here(); ?>/comment">
      <input type="hidden" name="post_id" class="hide" value="<?php echo \dash\data::dataRow_id(); ?>">

    <?php if(!\dash\user::id()) { ?>
          <div class="row">
            <div class="c c-xs-12 mB10">

              <div class="input">
               <label class="addon" for="name"><?php echo T_("Name"); ?></label>
               <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40' value="<?php echo \dash\user::detail('displayname'); ?>">
              </div>

            </div>
            <div class="c c-xs-12 mB10">
              <div class="input">
               <label class="addon" for="mobile"><?php echo T_("Mobile"); ?></label>
               <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Mobile"); ?>' maxlength="13" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>' value="<?php echo \dash\user::detail('mobile'); ?>">
              </div>
            </div>

            <input type="text" name="username" class="hide" value="">
          </div>
    <?php } // endif?>
      <div class="input mB10">
       <input type="text" name="title" id="title" placeholder='<?php echo T_("Title"); ?>' maxlength='40' >
      </div>
      <div class="mB10">
        <textarea name="content" class="txt" rows="4" placeholder='<?php echo T_("Write your review about this post..."); ?>'></textarea>
      </div>

      <div class="row align-center">
        <div class="c">
          <div class="starRating">
            <fieldset>
              <input type="radio" name="rating" id="star5" value="5"/>
              <label for="star5" title="<?php echo T_("Outstanding");?>">5 stars</label>
              <input type="radio" name="rating" id="star4" value="4"/>
              <label for="star4" title="<?php echo T_("Very Good");?>">4 stars</label>
              <input type="radio" name="rating" id="star3" value="3"/>
              <label for="star3" title="<?php echo T_("Good");?>">3 stars</label>
              <input type="radio" name="rating" id="star2" value="2"/>
              <label for="star2" title="<?php echo T_("Poor");?>">2 stars</label>
              <input type="radio" name="rating" id="star1" value="1"/>
              <label for="star1" title="<?php echo T_("Very Poor");?>">1 star</label>
            </fieldset>
          </div>
        </div>
        <div class="c-auto os">
          <button class="btn primary"><?php echo T_("Send"); ?></button>
        </div>

      </div>
    </form>
  </div>
 </section>