<?php
$storData           = \dash\data::store_store_data();
$productDataRow     = \dash\data::productDataRow();
$have_variant_child = \dash\data::productDataRow_variant_child();


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

			$force_hide_product_title2 = true;

			require_once(root. 'content_a/products/edit/block/title.php');
			require_once(root. 'content_a/products/edit/block/price.php');



			$html .= '<section class="box">';
			{

				$html .= '<header><h2>'. T_("Inventory"). '</h2></header>';
				$html .= '<div class="body">';
				{

					$html .= '<div data-response="type" data-response-where="product" ';
					if(!$productDataRow || \dash\data::productDataRow_type() === 'product')
					{

					}
					else
					{
						$html .=  'data-response-hide';
					}
					$html .= '>';
					{

						$html .= '<div class="switch1 mB5">';
						{

							$html .= '<input type="checkbox" name="trackquantity" id="itrackquantity" '. ((\dash\data::productDataRow_trackquantity() || (\dash\data::addMode())) ? 'checked' : ''). '>';
							$html .= '<label for="itrackquantity"></label>';
							$html .= '<label for="itrackquantity">'. T_("Track quantity"). '<small></small></label>';
						}
						$html .= '</div>';
						$html .= '<div data-response="itrackquantity" ';
						if(\dash\data::productDataRow_trackquantity() || (\dash\data::addMode()))
						{

						}
						else
						{
							$html .= 'data-response-hide';
						}
						$html .= '>';
						{

							if(!$have_variant_child)
							{
								$html .= '<div class="c s12 pRa10">';
								{

									$html .= '<label for="stock">'. T_("Current Stock Count"). ' <span class="font-bold pRa10">' . \dash\fit::number(\dash\data::productDataRow_stock()). '</span></label>';
									$html .= '<div class="input">';
									{
										$html .= '<input type="tel" name="stock" id="stock" data-format="number" placeholder="'.  T_('Current Stock Count'). ' '. \dash\fit::number(\dash\data::productDataRow_stock()). '" maxlength="7">';
									}
									$html .= '</div>';
								}
								$html .= '</div>';
							}
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</section>';


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
				$quick_mode = true;
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