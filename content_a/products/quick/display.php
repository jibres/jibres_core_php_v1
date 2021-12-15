<?php

$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child = \dash\data::productDataRow_variant_child();
$child_list         = \dash\data::productDataRow_child();

if(!is_array($child_list))
{
	$child_list = [];
}

$html = '';

$html .= '<form class="jPage" id="aProductData" method="post" autocomplete="off" data-autoScroll2="#productGallery">';
{
	$html .= '<div class="row">';
	{
		$html .= '<div class="c-xs-12 c-sm-6 c-md-8 c-xxl-9">';
		{

		    $html .= '<button class="hide" name="submitall" type="submit" value="master">'. T_("Save"). '</button>';
		    $html .= '<input type="hidden" name="havevariantchild" value="'.($have_variant_child ? 1 :  0). '">';

			echo $html;
			$html = '';

			require_once(root. 'content_a/products/edit/block/title.php');
			require_once(root. 'content_a/products/edit/block/price.php');


		}
		$html .= '</div>';

		$html .= '<div class="c-xs-12 c-sm-6 c-md-4 c-xxl-3">';
		{
			echo $html;
			$html = '';
			if($have_variant_child)
			{
			/*  --------------- All detail for inventory hide when the product is parent of other product*/
			}
			else
			{
			  require_once(root. 'content_a/products/edit/block/barcode.php');
			}
		}
		$html .= '</div>';
	}
  	$html .= '</div>';
}
$html .= '</form>';

echo $html;
?>
