<?php
$variantsList = \dash\data::variantsList();

if(\dash\data::productDataRow_first_sale())
{
  require_once('display-firstsale.php');
}
else
{
  if(
      (!\dash\data::productDataRow_variant_child() && !\dash\data::productDataRow_parent() && !\dash\data::productDataRow_variants()) ||
      (!\dash\data::productDataRow_variant_child() && !\dash\data::productDataRow_parent() && \dash\data::productDataRow_variants() && \dash\request::get('makevariants'))
    )
  {
    // the product have no child and have not a child
    // add new
    require_once('display-add-variants.php');
  }
  elseif(!\dash\data::productDataRow_variant_child() && !\dash\data::productDataRow_parent() && \dash\data::productDataRow_variants())
  {
    require_once('display-add-product.php');
  }
  elseif(\dash\data::productDataRow_variant_child())
  {
    require_once('display-add-new-child.php');
  }
  elseif(\dash\data::productDataRow_parent())
  {
    echo '<div class="avand-md"><p class="msg fs14 warn">'. T_("This is child of another product"). '</p></div>';
  }
  else
  {
    echo '<div class="avand-md"><p class="msg fs14 warn">'. T_("Can not add variants to this product!"). '</p></div>';
  }
}
?>

