
<section class="avand">


    <form method="get" action="<?php echo \dash\url::that(); ?>">
      <div class="searchBox">
        <div class="f">
          <div class="c pRa10">
            <div>
              <div class="input search <?php if(\dash\validate::search_string()) { echo 'apply'; }?>">
                <input type="search" name="q" placeholder='<?php echo T_("Search products"); ?>' id="q" value="<?php echo \dash\validate::search_string(). \dash\request::get('barcode'); ?>" class="barCode" data-default data-pass='submit' autocomplete='off' autofocus>
                <button class="addon btn-light3 s0"><i class="sf-search"></i></button>
              </div>
            </div>
          </div>

          <div class="cauto">
            <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
              <option><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
                <?php
                foreach (\dash\data::sortList() as $key => $value)
                {
                  ?>
                  <option value="<?php echo \dash\url::that(). '?'. a($value, 'query_string'); ?>" <?php if(\dash\request::get('sort') == a($value, 'query')['sort'] && \dash\request::get('order') == a($value, 'query')['order']) { echo 'selected'; }?> ><?php echo a($value, 'title'); ?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
        </div>
      </form>


<?php
if(\dash\data::dataTable())
{

 ___paint(\dash\data::dataTable());
}
?>
<?php \dash\utility\pagination::html(); ?>

<?php if(\dash\data::filterBox()) {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>
</section>

<?php 

   function ___paint($__group_products)
  {
    if(!$__group_products || !is_array($__group_products))
    {
      return;
    }

    echo '<div class="row">';

    foreach ($__group_products as $key => $myProduct)
    {
      echo '<div class="c-xs-6 c-sm-4 c-md-3 c-lg-3 c-xl-3">';
      ___create_element_product_2($myProduct);
      echo '</div>';
    }

    echo '</div>';
  }


   function ___create_element_product_2($_item)
  {
    $id              = a($_item, 'id');
    $title           = a($_item, 'title');
    $image           = a($_item, 'thumb');
    $imageIsDefault  = a($_item, 'thumb_default');


    $price           = \dash\fit::number(a($_item, 'finalprice'));
    $discount        = a($_item, 'discount');
    $discountpercent = a($_item, 'discountpercent');
    $compareAtPrice = a($_item, 'price');
    $compareAtPrice = \dash\fit::number($compareAtPrice);


    $unit            = a($_item, 'unit');
    $allow_shop      = a($_item, 'allow_shop');
    $currency        = \lib\store::currency();

    echo '<a class="jProduct2" href="'. a($_item, 'url'). '">';
    {
      echo '<figure class="overlay"';
      if($imageIsDefault)
      {
        echo ' data-gr="'.rand(1, 20).'"';
      }
      echo ">";
      {
        echo '<img src="'. $image. '" alt="'. $title. '">';

      }
      if($discountpercent)
      {
        echo '<span class="discount">';
        echo '-';
        echo \dash\fit::price_old($discountpercent);
        echo '%';
        echo '</span>';
      }

      if($allow_shop)
      {
        echo '<div class="btnAddCart" rel="nofollow" data-action="'. \dash\url::kingdom(). '/cart" data-ajaxify data-data=\'{"cart": "add", "count": 1, "product_id": "'. $id. '"}\'>+</div>';
      }

      // show price line
      echo '<footer>';
      {
        // show title
        {
          echo '<figcaption>';
          echo $title;
          echo '</figcaption>';
        }

        echo '<div class="f align-center">';
        {
          if($price)
          {
            echo '<span class="unit cauto">';
            echo $currency;
            echo '</span>';

            echo '<span class="price c">';
            echo $price;
            echo '</span>';
          }

          if($discount)
          {
            echo '<del class="compareAtPrice cauto os">';
            echo $compareAtPrice;
            echo '</del>';
          }
        }
        echo '</div>';

      }
      echo '</footer>';

      echo '</figure>';
    }
    echo '</a>';
  }
 ?>




