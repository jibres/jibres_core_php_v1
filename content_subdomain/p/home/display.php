<div class="avand productPage">
  <div class="box">
      <div class="row">
        <div class="c-xs-12 c-5">
          <img src="<?php echo \dash\data::dataRow_thumb(); ?>" alt='<?php echo \dash\data::dataRow_title(); ?>'>
        </div>
        <div class="c-xs-12 c-7">
          <h1><?php echo \dash\data::dataRow_title(); ?></h1>
<?php if(\dash\data::dataRow_title2()) { ?>
          <h2 class="ltr"><?php echo \dash\data::dataRow_title2(); ?></h2>
<?php } ?>
          <div class="productReviewShort">
            <div class="starRating compact" data-star='3.2' data-gold>
              <i></i><i></i><i></i><i></i><i></i>
            </div>
            <div><?php echo T_(":val out of 5", ['val' => '3.2']) ?></div>
            <div><?php echo T_(":val Reviews", ['val' => '414']); ?></div>
            <div><?php echo T_(":val Orders", ['val' => '850']); ?></div>
          </div>

          <div class="priceLine">
            <div class="row align-center">
              <div class="c">

                <div>
                  <span><?php echo T_("List Price"); ?></span>
                  <div class="priceShow" data-first>
                    <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                  </div>
                </div>

                <div>
                  <span><?php echo T_("Price"); ?></span>
                  <div class="priceShow" data-final>
                    <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                    <span class="unit"><?php echo \lib\currency::unit(); ?></span>
                  </div>
                </div>

                <div>
                  <span><?php echo T_("You Save"); ?></span>
                  <div class="priceShow" data-discount>
                    <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                  </div>
                </div>

              </div>
              <div class="c-auto">
                <div data-ajaxify data-method='post' data-action='<?php echo \dash\url::here(). '/cart'; ?>'  data-data='{"cart": "add", "product_id" : "<?php echo \dash\data::dataRow_id() ?>", "count": 1}' class="addToCart"><?php echo T_("Add to Cart"); ?></div>
              </div>
            </div>
          </div>

<?php if(\dash\data::dataRow_bullet()) { ?>
          <div class="featureBullets ltr">
            <ul>
              <?php foreach (\dash\data::dataRow_bullet() as $key => $value) {?>
                <li><?php echo \dash\get::index($value, 'text'); ?></li>
              <?php } // endif ?>
            </ul>
          </div>
<?php } ?>


        </div>

      </div>
  </div>

  <?php if(\dash\data::dataRow_desc()) {?><div class="box productDesc"><?php echo \dash\data::dataRow_desc();?></div><?php } //endif ?>
  <div class="box shareBox">
    <nav class="row align-center">
      <div class="c">
        <a href="<?php echo \dash\url::base(). '/p/'. \dash\data::dataRow_id(); ?>"><?php echo T_("Product Code"); ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::dataRow_id()); ?></span></a>
      </div>
      <div class="c-auto share1">
        <a target="_blank" title='<?php echo T_("facebook"); ?>' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo \dash\url::pwd(); ?>" class="facebook">
          <?php echo \dash\face::site(); ?> <?php echo T_("facebook"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("twitter"); ?>' href="https://twitter.com/home?status=<?php echo \dash\url::pwd(); ?>" class="twitter">
          <?php echo \dash\face::site(). ' '. T_("twitter"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("linkedin"); ?>' href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo \dash\url::pwd(); ?>&title=<?php echo urlencode(\dash\face::title()); ?>&summary=<?php echo urlencode(\dash\face::desc()); ?>" class="linkedin">
          <?php echo \dash\face::site(). ' '. T_("linkedin"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("telegram"); ?>' href="https://t.me/share/url?url=<?php echo \dash\url::pwd(); ?>&text=<?php echo urlencode(\dash\face::title()); ?>" class="telegram">
          <?php echo \dash\face::site(). ' '. T_("telegram"); ?>
        </a>

      </div>
    </nav>
  </div>

<?php if(\dash\data::propertyList()) { ?>
  <div class="box productInfo">
<?php foreach (\dash\data::propertyList() as $property => $cat) {?>
      <h3 class="msg info2 mB0-f"><?php echo $cat['title']; ?></h3>
    <table class="tbl1 responsive v5">
<?php foreach ($cat['list'] as $key => $value) {?>
      <tr>
        <th><?php echo $value['key']; ?></th>
        <td><?php echo $value['value']; ?></td>
      </tr>
<?php     } ?>
    </table>
<?php   } ?>
  </div>
<?php } ?>


 <section class="box productReview">
  <h2><?php echo T_("Customer reviews"); ?></h2>

  <div class="row allReviewSummary">
    <div class="c-auto">
      <div class="ratingAvg">4.2</div>
      <div class="ratingSummary">
        <div class="starRating compact" data-star='3.2' data-gold>
          <i></i><i></i><i></i><i></i><i></i>
        </div>
        <span>2840</span>
      </div>
    </div>
    <div class="c rating">
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star">5</span></div>
        <div class="c"><progress value="69" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal">69%</span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star">4</span></div>
        <div class="c"><progress value="13" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal">13%</span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star">3</span></div>
        <div class="c"><progress value="9" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal">9%</span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star">2</span></div>
        <div class="c"><progress value="2" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal">2%</span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star">1</span></div>
        <div class="c"><progress value="7" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal">7%</span></div>
      </div>
    </div>
  </div>


<?php $commentList = \lib\app\product\comment::get_public_list(\dash\data::dataRow_id()); ?>
<?php if($commentList) { ?>
  <div class="commnetList">
<?php foreach ($commentList as $key => $value){ ?>
    <div class="msg">
      <div class="row align-center">
        <div class="c-auto c-xs-12">
          <img class="customerImg" src="<?php echo \dash\get::index($value, 'avatar'); ?>" alt='<?php echo \dash\get::index($value, 'displayname'); ?>'>
        </div>
        <div class="c c-xs-12">
          <div class="msg minimal row padLess">
            <div class="c-auto">
              <div class="starRating" data-star='<?php echo $value['star']; ?>'>
                <i></i><i></i><i></i><i></i><i></i>
              </div>
            </div>
            <div class="c"><?php echo \dash\get::index($value, 'displayname'); ?></div>
            <div class="c-auto ltr txtRa"><?php echo \dash\fit::date($value['datecreated']); ?></div>
          </div>

          <p><?php echo $value['content']; ?></p>
        </div>


      </div>
    </div>
<?php   } // end for ?>
  </div>
<?php } // end if ?>
 </section>

 <section class="box productAddReview">
  <form method="post" data-refresh autocomplete="off" action="<?php echo \dash\url::here(); ?>/comment">
    <h3><?php echo T_("Review this product"); ?></h3>
    <input type="hidden" name="product_id" class="hide" value="<?php echo \dash\data::dataRow_id(); ?>">

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


  <?php if(!\dash\user::id()) { ?>
        <div class="f">
          <div class="c pRa5 mB10">

            <div class="input">
             <label class="addon" for="name"><?php echo T_("Name"); ?></label>
             <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40' value="<?php echo \dash\user::detail('displayname'); ?>">
            </div>

          </div>
          <div class="c mB10">
            <div class="input">
             <label class="addon" for="mobile"><?php echo T_("Mobile"); ?></label>
             <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Mobile"); ?>' maxlength="13" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>' value="<?php echo \dash\user::detail('mobile'); ?>">
            </div>
          </div>

          <input type="text" name="username" class="hide" value="">
        </div>
  <?php } // endif?>
    <div class="input">
      <textarea name="content" class="txt" rows="5" placeholder='<?php echo T_("Write your review about this product..."); ?>'></textarea>
    </div>

    <div class="row">
      <div class="c">
        <button class="btn primary mT20"><?php echo T_("Send"); ?></button>
      </div>

    </div>
  </form>


 </section>
</div>

