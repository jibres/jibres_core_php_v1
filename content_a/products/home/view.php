<?php
namespace content_a\products\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('List of products'));

		$pageDesc = T_('You can search in list of products, add new product and edit existing.');
		// add back to product list link
		$pageDesc .= ' '. '<a href="'. \dash\url::this() .'/summary" data-shortkey="121">'. T_('Products dashboard'). '</a>';
		\dash\data::page_desc($pageDesc);
		\dash\data::page_pictogram('box');


		\dash\data::badge_text(T_('Add new product'));
		\dash\data::badge_link(\dash\url::this(). '/add');

		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
		];

		if(\dash\request::get('barcode'))
		{
			$args['barcode'] = \dash\request::get('barcode');
		}

		if(\dash\request::get('price'))
		{
			$args['price'] = \dash\request::get('price');
		}

		if(\dash\request::get('buyprice'))
		{
			$args['buyprice'] = \dash\request::get('buyprice');
		}

		if(\dash\request::get('cat'))
		{
			$args['cat'] = \dash\request::get('cat');
		}

		if(\dash\request::get('catid'))
		{
			$args['cat_id'] = \dash\coding::decode(\dash\request::get('catid'));
		}

		if(\dash\request::get('discount'))
		{
			$args['discount'] = \dash\request::get('discount');
		}

		if(\dash\request::get('unitid'))
		{
			$args['unit_id'] = \dash\coding::decode(\dash\request::get('unitid'));
		}

		if(\dash\request::get('companyid'))
		{
			$args['company_id'] = \dash\coding::decode(\dash\request::get('companyid'));
		}

		if(\dash\request::get('guaranteeid'))
		{
			$args['guarantee_id'] = \dash\coding::decode(\dash\request::get('guaranteeid'));
		}


		if(\dash\request::get('duplicatetitle')) $args['duplicatetitle'] = true;
		if(\dash\request::get('hbarcode')) $args['hbarcode'] = true;
		if(\dash\request::get('hnotbarcode')) $args['hnotbarcode'] = true;
		if(\dash\request::get('justcode')) $args['justcode'] = true;
		if(\dash\request::get('wcodbarcode')) $args['wcodbarcode'] = true;
		if(\dash\request::get('wbuyprice')) $args['wbuyprice'] = true;
		if(\dash\request::get('wprice')) $args['wprice'] = true;
		if(\dash\request::get('wminstock')) $args['wminstock'] = true;
		if(\dash\request::get('wmaxstock')) $args['wmaxstock'] = true;
		if(\dash\request::get('wdiscount')) $args['wdiscount'] = true;
		if(\dash\request::get('negativeprofit')) $args['negativeprofit'] = true;


		$search_string = \dash\request::get('q');

		if($search_string)
		{
			\dash\data::page_title(T_('Search'). ' '.  $search_string);
		}

		// work with product list
		$myProductList = \lib\app\product::list($search_string, $args);
		\dash\data::dataTable($myProductList);
		// redirect on barcode scan
		if(is_array($myProductList) && count($myProductList) === 1)
		{
			$barcode_is_scaned = false;
			if(isset($myProductList[0]['barcode']) && $myProductList[0]['barcode'] === $search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($myProductList[0]['barcode2']) && $myProductList[0]['barcode2'] === $search_string)
			{
				$barcode_is_scaned = true;
			}

			if(isset($myProductList[0]['id']) && $barcode_is_scaned)
			{
				\dash\redirect::to(\dash\url::this().'/general?id='. $myProductList[0]['id']);
			}
		}

		if(\dash\request::get('json') === 'true')
		{
			if(\dash\request::get('barcode'))
			{
				if(!$myProductList)
				{
					$myProductList = null;
				}
			}

			echo json_encode($myProductList, JSON_UNESCAPED_UNICODE);
			\dash\code::boom();
		}

		if(\dash\request::get('q') && ctype_digit(\dash\request::get('q')) && mb_strlen(\dash\request::get('q')) === 13)
		{
			\dash\data::barcodeScaned('?barcode='. \dash\request::get('q'));
		}

		\dash\data::myFilter(\content_a\filter::current(\lib\app\product::$sort_field, \dash\url::this()));

		if(isset($args['negativeprofit']))
		{
			$args['Negative profit'] = '';
			unset($args['negativeprofit']);
		}

		if(isset($args['cat_id']))
		{
			$args['Category'] = isset($myProductList[0]['cat']) ? $myProductList[0]['cat'] : null;
			unset($args['cat_id']);
		}


		if(isset($args['unit_id']))
		{
			$args['Unit'] = isset($myProductList[0]['unit']) ? $myProductList[0]['unit'] : null;
			unset($args['unit_id']);
		}


		if(isset($args['company_id']))
		{
			$args['Company'] = isset($myProductList[0]['company']) ? $myProductList[0]['company'] : null;
			unset($args['company_id']);
		}

		if(isset($args['guarantee_id']))
		{
			$args['Guarantee'] = isset($myProductList[0]['guarantee']) ? $myProductList[0]['guarantee'] : null;
			unset($args['guarantee_id']);
		}

		\dash\data::filterBox(\content_a\filter::createMsg($args));
	}
}
?>
