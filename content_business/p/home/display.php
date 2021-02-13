<div class="avand productPage">
  <div class="box">
      <div class="row">
        <div class="c-xs-12 c-auto">
          <div class="featureImgBlock">
            <a class="featureImg" data-fancybox='productGallery' href="<?php echo \dash\data::dataRow_thumb(); ?>">
              <img src="<?php echo \dash\data::dataRow_thumb(); ?>" alt='<?php echo \dash\data::dataRow_title(); ?>'>
            </a>
          </div>
<?php $myGallery = a(\dash\data::dataRow(), 'gallery_array');
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
               <?php if ($item['type'] === 'video') { ?>
                <video><source src="<?php echo $item['path']; ?>" type="<?php echo $item['mime']; ?>"></video>
               <?php } else { ?>
                <img src="<?php echo $item['path']; ?>" alt=" <?php echo \dash\data::dataRow_title().' '.$key; ?>">
               <?php } ?>
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
// @TODO @reza @javad
// if have one item in gallery and this item is not image not show this video (for example) in website
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
            <?php if(\dash\data::dataRow_stock() > 0) {?>
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
                  <span class="price"><?php echo \dash\fit::price_old(\dash\data::dataRow_price()); ?></span>
                </div>
                <div class="priceShow ltr" data-discount title='<?php echo T_("You Save"); ?> <?php echo \dash\fit::price_old(round(\dash\data::dataRow_discount())); ?>'>- <?php echo \dash\fit::price_old(\dash\data::dataRow_discountpercent()); ?> %</div>
              </div>
              <?php } //endif ?>
              <div>
                <?php if(\dash\data::dataRow_finalprice()) {?>
                <span><?php echo T_("Price"); ?></span>
                <div class="priceShow" data-final>
                  <span class="price"><?php  echo \dash\fit::price_old(\dash\data::dataRow_finalprice()); ?></span>
                  <span class="unit"><?php echo \lib\store::currency(); ?></span>
                </div>
              <?php } //endif ?>
              </div>

               <?php /* --------------- vARIANT CHILD --------------- */
            $child = \dash\data::dataRow_child();
            if($child && is_array($child)){}else{$child = [];}
            $count_child = 0;foreach ($child as $key => $value) {if(a($value, 'parent')) {$count_child++;}}
            if($child && $count_child > 1)
            {
                echo '<div>';
                 echo '<select class="select22 " data-link>';
                 echo '<option>'. T_("To buy select variants"). '</option>';
              foreach ($child as $key => $value)
              {

                if(!a($value, 'parent'))
                {
                  echo '<option value="'. a($value, 'url').'" >';
                  echo '<span>'. a($value, 'title').'</span></option>';
                }
                else
                {
                  echo '<option value="'. a($value, 'url').'" ';
                  if(\dash\data::dataRow_id() == a($value, 'id'))
                  {
                    echo ' selected ';
                  }
                  echo '>';
                  if(a($value, 'optionname1')){echo  ' '. a($value, 'optionname1'). " ". a($value, 'optionvalue1'); }
                  if(a($value, 'optionname2')){echo  ' '. a($value, 'optionname2'). " ". a($value, 'optionvalue2'); }
                  if(a($value, 'optionname3')){echo  ' '. a($value, 'optionname3'). " ". a($value, 'optionvalue3'); }
                  echo '</option>';
                }

              }
                echo '</select>';
                echo '</div>';
            }
          ?>



              <div>
                <?php if(a(\dash\data::dataRow(), 'allow_shop')) {?>

                  <?php if(\dash\data::productInCart()) {?><div data-option='product-update-cart'><?php } //endif ?>

                  <form method="post" autocomplete="off" id="formaddcart" <?php if(\dash\data::productInCart()){ echo 'data-patch'; } ?> >

                    <input type="hidden" name="product_id" value="<?php echo \dash\data::dataRow_id() ?>">
                      <?php
                        $select_count = a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list');
                        if(is_array($select_count) && count($select_count) === 1 && isset($select_count[0]))
                        {
                          echo '<input type="hidden" name="count" value="'. $select_count[0]. '">';
                        }
                        else{
                       ?>
                    <div class="productQty">
                        <?php if(a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list')) {?>
                      <select class="select22" name="count" data-model="productItem">
                        <?php if(\dash\data::productInCart()) { ?>
                          <?php if(!in_array(\dash\data::productInCartCount(), a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list'))) {?>
                            <option value="<?php echo \dash\data::productInCartCount() ?>" selected><?php echo \dash\fit::number(\dash\data::productInCartCount()); ?></option>
                          <?php } //endif ?>
                          <option value="0" <?php if(\dash\data::productInCartCount() == '0') {echo 'selected';} ?>><?php echo T_("Remove"); ?></option>
                        <?php } //endif ?>
                          <?php foreach (a(\dash\data::dataRow(), 'cart_limit', 'sale_step_list') as $item_count) {?>
                            <option value="<?php echo $item_count ?>" <?php if(\dash\data::productInCartCount() == $item_count) {echo 'selected';} ?>><?php echo \dash\fit::number($item_count); ?></option>
                        <?php } //endfor ?>
                      </select>
                        <?php }elseif(a(\dash\data::dataRow(), 'cart_limit', 'sale_step_input')){ ?>
                          <div class="input">
                            <input type="text" name="count" value="<?php echo \dash\data::productInCartCount() ?>" placeholder="<?php echo T_("Qty") ?>" minlength="0" maxlength="4" data-format='pirce'>
                          </div>
                        <?php } //endif ?>
                    </div>
                      <?php } //endif ?>

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
                      <div class="txtB mTB10"><?php echo a(\dash\data::dataRow(), 'shop_message'); ?></div>
                  <?php } //endif ?>
              </div>

            </div>
<?php if(\dash\data::propertyList()) { ?>
            <div class="c-auto c-xs-12">
              <ul class="featureBullets">
                <?php foreach (\dash\data::propertyList() as $property => $property_detail) {?>
                  <?php foreach ($property_detail['list'] as $cat) {?>
                    <?php if(a($cat, 'outstanding')) {?>
                <li><span><?php echo a($cat, 'key') ?></span> <span class="txtB"><?php echo a($cat, 'value'); ?></span></li>
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
        <a data-copy="<?php echo \dash\url::kingdom(). '/p/'. \dash\data::dataRow_id(); ?>" href="<?php echo \dash\url::kingdom(). '/p/'. \dash\data::dataRow_id(); ?>"><?php echo T_("Product Code"); ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::dataRow_id()); ?></span></a>
      </div>
      <div class="c-auto share1">
        <a target="_blank" title='<?php echo T_("facebook"); ?>' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo \dash\url::pwd(); ?>" class="facebook">
          <?php echo \dash\face::site(); ?> <?php echo T_("facebook"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("twitter"); ?>' href="https://twitter.com/intent/tweet?url=<?php echo urlencode(\dash\url::pwd()); ?>&amp;text=<?php echo urlencode(\dash\face::desc()); ?>" class="twitter">
          <?php echo \dash\face::site(). ' '. T_("twitter"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("linkedin"); ?>' href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo \dash\url::pwd(); ?>&amp;title=<?php echo urlencode(\dash\face::title()); ?>&amp;summary=<?php echo urlencode(\dash\face::desc()); ?>" class="linkedin">
          <?php echo \dash\face::site(). ' '. T_("linkedin"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("telegram"); ?>' href="https://t.me/share/url?url=<?php echo \dash\url::pwd(); ?>&amp;text=<?php echo urlencode(\dash\face::title()); ?>" class="telegram">
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
          <?php if(a($value, 'link')) {?>
            <a href="<?php echo a($value, 'link') ?>"><?php echo $value['value']; ?></a>
          <?php }else{ ?>
            <?php if(a($value, 'bold')) {?>
              <div class="txtB">
            <?php } //endif ?>
              <?php echo $value['value']; ?>
            <?php if(a($value, 'bold')) {?>
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


<?php
if(\dash\data::productSettingSaved_comment())
{
  require_once(core. 'layout/comment/comment-add.php');
} //endif comment is closed
?>

<?php require_once(core. 'layout/comment/comment-list.php'); ?>



<?php if(\dash\data::similarProduct()) {?>
<h2 class="jTitle1"><?php echo T_("Related products") ?></h2>
  <?php \lib\website::product_list(\dash\data::similarProduct()); ?>
<?php } //endif ?>


</div>


</div>

