<div class="avand productPage">
  <div class="box">
      <div class="row">
        <div class="c-xs-12 c-auto">
          <div class="featureImgBlock">
            <a class="featureImg" data-fancybox='productGallery' href="<?php echo \dash\data::dataRow_thumb(); ?>">
              <img src="<?php echo \dash\data::dataRow_thumb(); ?>" alt='<?php echo \dash\data::dataRow_title(); ?>'>
            </a>
          </div>
<?php $myGallery = \dash\get::index(\dash\data::dataRow(), 'gallery_array');
if(!is_array($myGallery))
{
  $myGallery = [];
}
if(count($myGallery) > 1)
{
  echo "<div class='thumbs'>";
  foreach ($myGallery as $key => $item)
  {
    if($key < 5 && isset($item['path']))
    {
?>
              <a href='<?php echo $item['path']; ?>' data-fancybox="productGallery" class="f justify-center align-center thumb">
                <img src="<?php echo $item['path']; ?>" alt=" <?php echo \dash\data::dataRow_title().' '.$key; ?>">
              </a>
<?php
    }
    else
    {
?>
              <a data-fancybox='productGallery' class="hide" href='<?php echo $item['path']; ?>'></a>
<?php
    }
  }
  echo "</div>";
}
?>
        </div>
        <div class="c-xs-12 c">
          <h1><?php echo \dash\data::dataRow_title(); ?></h1>
<?php if(\dash\data::dataRow_title2()) { ?>
          <h2 class="ltr"><?php echo \dash\data::dataRow_title2(); ?></h2>
<?php } ?>
<?php if(\dash\data::dataRow_preparationdatestring()) { ?>
          <time title="<?php echo \dash\fit::date(\dash\data::dataRow_preparationdate()); ?>"><span><?php echo T_("Estimated Delivery on"); ?></span> <?php echo \dash\data::dataRow_preparationdatestring(); ?></time>
<?php } ?>


          <div class="productReviewShort">
            <?php if(\dash\data::customerReview_count()) {?>
            <div class="starRating compact" data-star='<?php echo \dash\data::customerReview_avg(); ?>' data-gold>
              <i></i><i></i><i></i><i></i><i></i>
            </div>
            <div><?php echo T_(":val out of 5", ['val' => \dash\fit::number(\dash\data::customerReview_avg())]) ?></div>
            <div><?php echo T_(":val Reviews", ['val' => \dash\fit::number(\dash\data::customerReview_count())]); ?></div>
            <?php } //endif ?>
            <?php if(\dash\data::dataRow_stock()) {?>
            <div><?php echo T_(":val Stock", ['val' => \dash\fit::number(\dash\data::dataRow_stock())]); ?></div>
          <?php } //endif ?>
          </div>


        <?php //  echo \dash\fit::number(\dash\data::dataRow_stock()); ?>

          <div class="row align-center">
            <div class="c">
              <?php if(\dash\data::dataRow_discount()) {?>
              <div>
                <span><?php echo T_("List Price"); ?></span>
                <div class="priceShow" data-first>
                  <span class="price"><?php echo \dash\fit::price(\dash\data::dataRow_price()); ?></span>
                </div>
                <div class="priceShow ltr" data-discount title='<?php echo T_("You Save"); ?> <?php echo \dash\fit::price(round(\dash\data::dataRow_discount())); ?>'>- <?php echo \dash\fit::price(\dash\data::dataRow_discountpercent()); ?> %</div>
              </div>
              <?php } //endif ?>
              <div>
                <span><?php echo T_("Price"); ?></span>
                <div class="priceShow" data-final>
                  <span class="price"><?php if(\dash\data::dataRow_variant_price()) { echo \dash\data::dataRow_variant_price();  }else{ echo \dash\fit::price(\dash\data::dataRow_finalprice()); }?></span>
                  <span class="unit"><?php echo \lib\store::currency(); ?></span>
                </div>
              </div>

               <?php /* --------------- vARIANT CHILD --------------- */
            $child = \dash\data::dataRow_child();
            if($child && is_array($child)){}else{$child = [];}
            if($child)
            {
                echo '<div>';
                 echo '<select class="select22 " data-link>';
                 echo '<option>'. T_("To buy select variants"). '</option>';
              foreach ($child as $key => $value)
              {

                if(!\dash\get::index($value, 'parent'))
                {
                  echo '<option value="'. \dash\get::index($value, 'url').'" >';
                  echo '<span>'. \dash\get::index($value, 'title').'</span></option>';
                }
                else
                {
                  echo '<option value="'. \dash\get::index($value, 'url').'" ';
                  if(\dash\data::dataRow_id() == \dash\get::index($value, 'id'))
                  {
                    echo ' selected ';
                  }
                  echo '>';
                  if(\dash\get::index($value, 'optionname1')){echo  ' '. \dash\get::index($value, 'optionname1'). " ". \dash\get::index($value, 'optionvalue1'); }
                  if(\dash\get::index($value, 'optionname2')){echo  ' '. \dash\get::index($value, 'optionname2'). " ". \dash\get::index($value, 'optionvalue2'); }
                  if(\dash\get::index($value, 'optionname3')){echo  ' '. \dash\get::index($value, 'optionname3'). " ". \dash\get::index($value, 'optionvalue3'); }
                  echo '</option>';
                }

              }
                echo '</select>';
                echo '</div>';
            }
          ?>



              <div>
                <?php if(\dash\get::index(\dash\data::dataRow(), 'allow_shop')) {?>

                  <?php if(\dash\data::productInCart()) {?><div data-option='product-update-cart'><?php } //endif ?>

                  <form method="post" autocomplete="off" id="formaddcart" <?php if(\dash\data::productInCart()){ echo 'data-patch'; } ?> >

                    <input type="hidden" name="product_id" value="<?php echo \dash\data::dataRow_id() ?>">
                    <div class="productQty">
                      <select class="select22" name="count" data-model="productItem">
                        <?php if(\dash\data::productInCart()) {?>
                          <option value="0" <?php if(\dash\data::productInCartCount() == '0') {echo 'selected';} ?>><?php echo T_("Remove"); ?></option>
                        <?php } //endif ?>
                        <option value="1" <?php if(\dash\data::productInCartCount() == '1') {echo 'selected';} ?>><?php echo \dash\fit::number(1); ?></option>
                        <option value="2" <?php if(\dash\data::productInCartCount() == '2') {echo 'selected';} ?>><?php echo \dash\fit::number(2); ?></option>
                        <option value="3" <?php if(\dash\data::productInCartCount() == '3') {echo 'selected';} ?>><?php echo \dash\fit::number(3); ?></option>
                        <option value="4" <?php if(\dash\data::productInCartCount() == '4') {echo 'selected';} ?>><?php echo \dash\fit::number(4); ?></option>
                        <option value="5" <?php if(\dash\data::productInCartCount() == '5') {echo 'selected';} ?>><?php echo \dash\fit::number(5); ?></option>
                        <option value="6" <?php if(\dash\data::productInCartCount() == '6') {echo 'selected';} ?>><?php echo \dash\fit::number(6); ?></option>
                        <option value="7" <?php if(\dash\data::productInCartCount() == '7') {echo 'selected';} ?>><?php echo \dash\fit::number(7); ?></option>
                        <option value="8" <?php if(\dash\data::productInCartCount() == '8') {echo 'selected';} ?>><?php echo \dash\fit::number(8); ?></option>
                        <option value="9" <?php if(\dash\data::productInCartCount() == '9') {echo 'selected';} ?>><?php echo \dash\fit::number(9); ?></option>
                        <option value="10" <?php if(\dash\data::productInCartCount() == '10') {echo 'selected';} ?>><?php echo \dash\fit::number(10); ?></option>
                      </select>
                    </div>

                  <?php if(\dash\data::productInCart()) {?>
                      <a href="<?php echo \dash\url::kingdom();?>/cart" class="link"><?php echo T_("In cart"); ?></a>
                      <input type="hidden" name="type" value="update_cart">
                   <?php }else{ ?>
                      <input type="hidden" name="cart" value="add">
                      <button type="submit" class="btnBuy" ><?php echo T_("Add to cart"); ?></button>
                    <?php } // endif ?>

                  </form>
                  <?php if(\dash\data::productInCart()) {?></div><?php } //data-option div ?>
                  <?php }else{ // can not shop?>
                      <div class="txtB mTB10"><?php echo \dash\get::index(\dash\data::dataRow(), 'shop_message'); ?></div>
                  <?php } //endif ?>
              </div>

            </div>
<?php if(\dash\data::propertyList()) { ?>
            <div class="c-auto c-xs-12">
              <ul class="featureBullets">
                <?php foreach (\dash\data::propertyList() as $property => $property_detail) {?>
                  <?php foreach ($property_detail['list'] as $cat) {?>
                    <?php if(\dash\get::index($cat, 'outstanding')) {?>
                <li><span><?php echo \dash\get::index($cat, 'key') ?></span> <span class="txtB"><?php echo \dash\get::index($cat, 'value'); ?></span></li>
                    <?php } //endif ?>
                  <?php } // endfor ?>
                <?php } // endfor ?>
              </ul>
            </div>
<?php } // endif ?>
          </div>





<?php if(\dash\data::productSettingSaved_view_text()) {?>
          <p class="msg globalMsg"><?php echo \dash\data::productSettingSaved_view_text(); ?></p>
<?php } //endif ?>

        </div>

      </div>
  </div>

  <?php if(\dash\data::dataRow_desc()) {?><div class="box productDesc"><?php echo \dash\data::dataRow_desc();?></div><?php } //endif ?>
  <div class="box shareBox">
    <nav class="row align-center">
      <div class="c">
        <a href="<?php echo \dash\url::kingdom(). '/p/'. \dash\data::dataRow_id(); ?>"><?php echo T_("Product Code"); ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::dataRow_id()); ?></span></a>
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
    <table class="tbl1 responsive v5">
<?php foreach (\dash\data::propertyList() as $property => $cat) {?>
      <tr class="group">
        <th colspan="2"><?php echo $cat['title']; ?></th>
      </tr>
<?php foreach ($cat['list'] as $key => $value) {?>
      <tr>
        <th><?php echo $value['key']; ?></th>
        <td>
          <?php if(\dash\get::index($value, 'link')) {?>
            <a href="<?php echo \dash\get::index($value, 'link') ?>"><?php echo $value['value']; ?></a>
          <?php }else{ ?>
            <?php if(\dash\get::index($value, 'bold')) {?>
              <div class="txtB">
            <?php } //endif ?>
              <?php echo $value['value']; ?>
            <?php if(\dash\get::index($value, 'bold')) {?>
              </div>
            <?php } //endif ?>
          <?php } //endif ?>
        </td>
      </tr>
<?php     } ?>
<?php   } ?>
    </table>
  </div>
<?php } ?>

<?php if(\dash\data::customerReview_count()) {?>
 <section class="box productReview">
  <h2><?php echo T_("Customer reviews"); ?></h2>

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
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("5"); ?></span></div>
        <div class="c"><progress value="<?php echo \dash\get::index(\dash\data::customerReview(),'star_5_percent'); ?>" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(\dash\get::index(\dash\data::customerReview(),'star_5_percent')). ' '. T_("%"); ?></span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("4"); ?></span></div>
        <div class="c"><progress value="<?php echo \dash\get::index(\dash\data::customerReview(),'star_4_percent'); ?>" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(\dash\get::index(\dash\data::customerReview(),'star_4_percent')). ' '. T_("%"); ?></span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("3"); ?></span></div>
        <div class="c"><progress value="<?php echo \dash\get::index(\dash\data::customerReview(),'star_3_percent'); ?>" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(\dash\get::index(\dash\data::customerReview(),'star_3_percent')). ' '. T_("%"); ?></span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("2"); ?></span></div>
        <div class="c"><progress value="<?php echo \dash\get::index(\dash\data::customerReview(),'star_2_percent'); ?>" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(\dash\get::index(\dash\data::customerReview(),'star_2_percent')). ' '. T_("%"); ?></span></div>
      </div>
      <div class="row padLess">
        <div class="c-auto"><span class="sf-star"><?php echo \dash\fit::text("1"); ?></span></div>
        <div class="c"><progress value="<?php echo \dash\get::index(\dash\data::customerReview(),'star_1_percent'); ?>" max="100"></progress></div>
        <div class="c-auto"><span class="percentVal"><?php echo \dash\fit::text(\dash\get::index(\dash\data::customerReview(),'star_1_percent')). ' '. T_("%"); ?></span></div>
      </div>
    </div>
  </div>


<?php $commentList = \dash\data::commentList(); ?>
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
            <div class="c-auto c-xs-12">
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
<?php } //endif ?>

 <section class="box" id='productAddReview'>
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
        <div class="row padLess">
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
      <textarea name="content" class="txt" rows="5" placeholder='<?php echo T_("Write your review about this product..."); ?>'></textarea>
    </div>

    <div class="row ">
      <div class="c">
        <button class="btn primary"><?php echo T_("Send"); ?></button>
      </div>

    </div>
  </form>


 </section>

<?php if(\dash\data::similarProduct()) {?>
<h2 class="jTitle1"><?php echo T_("Related products") ?></h2>
  <?php \lib\website::product_list(\dash\data::similarProduct()); ?>
<?php } //endif ?>


</div>


</div>

