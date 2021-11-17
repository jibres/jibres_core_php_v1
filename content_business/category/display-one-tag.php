<div class="avand category">
    <div class="box">
      <div class="pad">
        <a href="<?php echo \dash\url::kingdom(). '/category'; ?>"><?php echo T_("Categories") ?></a>
        <?php if(\dash\data::dataRow_parent() && is_array(\dash\data::dataRow_parent())) {?>
          <?php foreach (\dash\data::dataRow_parent() as $key => $value) { echo ' / '; ?>
          <a href="<?php echo a($value, 'url') ?>"><?php echo a($value, 'title') ?></a>
        <?php } //endfor ?>
      <?php } //endif ?>
    </div>
  </div>
  <div class="box">
    <div class="body">
      <div class="row">
        <div class="c-10 c-xs-12">
          <h2><?php echo \dash\data::dataRow_title(); ?></h2>
          <div><?php echo \dash\data::dataRow_desc(); ?></div>
        </div>
        <div class="c-2 c-xs-12">
          <img class="w300" src="<?php echo \dash\data::dataRow_file(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
        </div>
      </div>
    </div>
  </div>
  <?php if(\dash\data::dataRow_child() && is_array(\dash\data::dataRow_child())) {?>
    <div class="box">
      <div class="pad">
        <div class="row">
          <?php foreach (\dash\data::dataRow_child() as $key => $value) {?>
            <a  class="c-auto txtC" href="<?php echo a($value, 'url') ?>">
              <div>
                <img class="w-20" src="<?php echo a($value, 'file') ?>" alt="<?php echo a($value, 'title') ?>">
              </div>
              <div class="txtC">
                <?php echo a($value, 'title') ?>
              </div>
            </a>
          <?php } //endif ?>
        </div>
      </div>
    </div>
  <?php } //endif ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <div class="box">
      <div class="pad">
        <div class="txtB mB10"><?php echo T_("Filter") ?></div>
        <form method="get" action="<?php echo \dash\url::that(); ?>">
          <div class="searchBox mB20">
            <div class="input search <?php if(\dash\validate::search_string()) { echo 'apply'; }?>">
              <input type="search" name="q" placeholder='<?php echo T_("Search products"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>"  autocomplete='off' >
              <button class="addon btn-light3 s0"><i class="sf-search"></i></button>
            </div>
          </div>
          <?php HTML_tag_filter(); ?>


        </form>
      </div>
    </div>

  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">
    <?php
    if(\dash\data::productList())
    {
      _____paint(\dash\data::productList());
      \dash\utility\pagination::html();
    }
    ?>

  </div>
</div>
</div>
<?php
function HTML_tag_filter()
{
   if(is_array(\dash\data::tagFilterList()))
  {

    echo '<div class="filterList">';

    $first            = true;
    $myClass          = null;
    $lastGroup        = null;
    $apply_filter_btn = false;

    foreach (\dash\data::tagFilterList() as $key => $value)
    {
      if($lastGroup !== $value['group'])
      {
        echo '<div class="mB5">'. $value['group']. '</div>';
        $lastGroup = $value['group'];
      }


      echo '<a class="btn mB20 mLa5 '. $myClass;

      if(a($value, 'is_active'))
      {
        echo ' primary2';
      }
      else
      {
       echo ' light';
      }
      echo '" href="'. \dash\url::that(). '?'. a($value, 'query_string'). '">'. a($value, 'title'). '</a>';

      $myClass = null;
      $first = false;
    }
    echo '</div>';
  }
}

 function _____paint($__group_products)
  {
    if(!$__group_products || !is_array($__group_products))
    {
      return;
    }

    echo '<div class="row">';

    foreach ($__group_products as $key => $myProduct)
    {
      echo '<div class="c-xs-6 c-sm-4 c-md-3 c-lg-3 c-xl-3">';
      _____create_element_product_2($myProduct);
      echo '</div>';
    }

    echo '</div>';
  }


   function _____create_element_product_2($_item)
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