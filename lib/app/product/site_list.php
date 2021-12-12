<?php
namespace lib\app\product;


class site_list
{
	/**
	 * This function call everywhere need to get product list in dropdown mode
	 * in sale page or buy page
	 */
	public static function dropdown()
	{
		if(\dash\request::get('json') !== 'true')
		{
			return;
		}

		$notif_result = [];
		$result       = [];
		$meta         = [];
		$msg          = T_("Product not found."). ' ';

		$query = \dash\validate::search_string();
		if(!$query)
		{
			$query = \dash\validate::search(\dash\request::get('term'), false);
		}
		if($query)
		{
			$resultRaw    = \lib\app\product\search::list_in_sale($query, $meta);
			foreach ($resultRaw as $key => $value)
			{
				$result['results'][] = self::getNeededField($value);
			}
		}
		elseif(\dash\validate::barcode(\dash\request::get('barcode'), false))
		{
			$result = \lib\app\product\find::barcode(\dash\validate::barcode(\dash\request::get('barcode'), false));
			if(!$result)
			{
				$msg .= '<a href="'. \dash\url::here(). '/products/add';
				if(mb_strlen(\dash\request::get('barcode')) === 5)
				{
					// do nothing
				}
				else
				{
					$msg .= '?barcode='. \dash\request::get('barcode');
				}
				$msg .=  '" target="_blank">'. T_('add as new product'). '</a>';

				\dash\notif::result(['message' => $msg]);
				\dash\code::end();
			}

			$result = self::getNeededField_barcode($result);
			\dash\notif::result(['list' => json_encode($result, JSON_UNESCAPED_UNICODE)]);
			\dash\code::jsonBoom(\dash\notif::get());

		}
		elseif(\dash\validate::id(\dash\request::get('id'), false))
		{
			$result = \lib\app\product\search::list_in_sale(null, ['id' => \dash\validate::id(\dash\request::get('id'), false)]);
			$result = self::getNeededField_barcode($result);
			\dash\notif::result(['list' => json_encode($result, JSON_UNESCAPED_UNICODE)]);
			\dash\code::jsonBoom(\dash\notif::get());
		}
		else
		{
			$result['results'][] = ['text' => T_("No result found!"), 'id' => null, "disabled"  => true];
		}

		if(!$result)
		{
			$notif_result['message'] = $msg;
		}


		if(!$result)
		{
			$result = [];
			$result['results'][] = ['text' => T_("No result found!"), 'id' => null, "disabled"  => true];
		}

		\dash\code::jsonBoom($result);

	}

	private static function getNeededField($_data)
	{

		if(\dash\request::get('mode') === 'text')
		{
			return
			[
				'id'       => a($_data, 'id'),
				'text'     => a($_data, 'title'),
			];
		}

		// $myName = '<img class="ui avatar image" src="'.  $value['avatar'] .'">';
		// $myName .= '<span class="pRa10">'. \dash\fit::number($value['code']). '</span>';
		// $myName .= '   '. $value['firstname']. ' <b>'. $value['lastname']. '</b> <small class="badge light mLa5">'. $value['father'].'</small>';
		// $myName .= '<span class="description">'. \dash\fit::number($value['nationalcode']). '</span>';

		$result   = [];
		$id       = null;
		$html     = '<div class="flex align-center">';
		$datalist = [];
		$priceTxt = '<span class="description ltr">';

		if(isset($_data['thumb']))
		{
			$html .= '<img class="flex-none rounded-lg max-h-7 w-7" src="'.  $_data['thumb'] .'"> ';
		}

		if(isset($_data['id']))
		{
			$id = $_data['id'];
			$datalist['id'] = $_data['id'];
		}

		if(isset($_data['title']))
		{
			$datalist['title'] = $_data['title'];
			$html .= '<span class="mx-1 flex-grow">'. $_data['title']. '</span>';

			if(isset($_data['vat']) && $_data['vat'])
			{
				$html .= '*';
			}

			// if(isset($_data['optionname1']) && isset($_data['optionvalue1']))
			// {
			// 	$html .= '<span class="mx-1">'. $_data['optionname1']. ' '. $_data['optionvalue1']. '</span>';
			// }

			// if(isset($_data['optionname2']) && isset($_data['optionvalue2']))
			// {
			// 	$html .= '<span class="mx-1">'. $_data['optionname2']. ' '. $_data['optionvalue2']. '</span>';
			// }

			// if(isset($_data['optionname3']) && isset($_data['optionvalue3']))
			// {
			// 	$html .= '<span class="mx-1">'. $_data['optionname3']. ' '. $_data['optionvalue3']. '</span>';
			// }
		}

		if(isset($_data['barcode']))
		{
			$datalist['barcode'] = $_data['barcode'];
			$html .= '<span class="mx-1 px-1 rounded-lg bg-blue-100 text-blue-500">'. T_('Barcode'). '</span>';
		}

		if(isset($_data['barcode2']))
		{
			$datalist['barcode2'] = $_data['barcode2'];
			$html .= '<span class="mx-1 px-1 rounded-lg bg-blue-100 text-blue-500">'. T_('Iran barcode'). '</span>';
		}

		if(isset($_data['code']))
		{
			$datalist['desc'] = T_("Code"). ' +'. $_data['code'];
			$html .= '<span class="mx-1 px-1 rounded-lg bg-blue-100 text-blue-600">'. T_('Code'). $_data['code']. '</span>';
		}

		if(isset($_data['finalprice']) && $_data['finalprice'])
		{
			$datalist['finalprice'] = $_data['finalprice'];
			$priceTxt .= '<span class="font-bold">'. \dash\fit::number($datalist['finalprice']). '</span>';
		}

		if(isset($_data['buyprice']))
		{
			$datalist['buyprice'] = floatval($_data['buyprice']);
		}

		if(isset($_data['price']))
		{
			$datalist['price'] = floatval($_data['price']);
			// if(floatval($datalist['price']) !== floatval($datalist['finalprice']))
			// {
			// 	$priceTxt .= ' <span class="badge light mLR10"><i class="sf-bolt"></i> '. \dash\fit::number($datalist['price']);
			// }
		}
		else
		{
			$datalist['price'] = null;
		}

		if(isset($_data['discount']) && $_data['discount'])
		{
			$datalist['discount'] = $_data['discount'];
			$priceTxt .= ' - '. \dash\fit::number($datalist['discount']). '</span>';
		}

		$datalist['stock'] = null;
		if(array_key_exists('stock', $_data))
		{
			$datalist['stock'] = $_data['stock'];
		}


		// add price to name of item
		$html   .= $priceTxt. '</span>';
		$html   .= '</div>';

		$result =
		[
			// select22
			'html'     => $html,
			'id'       => $id,
			// for extra use and remove double query
			'datalist' => $datalist,
		];

		// $all_field_we_have =
		// [
		// 	'title', 'name', 'cat', 'slug', 'company', 'shortcode', 'unit',
		// 	'barcode', 'barcode2', 'code', 'buyprice', 'price', 'discount',
		// 	'discountpercent', 'vat', 'initialbalance', 'minstock', 'maxstock',
		// 	'status', 'sold', 'stock', 'thumb', 'service', 'checkstock',
		// 	'factoronline', 'factorstore', 'carton', 'datecreated', 'datemodified', 'desc',
		// ];

		return $result;
	}


	private static function getNeededField_barcode($_data)
	{
		$result = [];

		if(isset($_data['id']))
		{
			$result['id'] = $_data['id'];
			$result['value'] = $_data['id'];
		}

		if(isset($_data['title']))
		{
			$result['title'] = $_data['title'];
		}

		if(isset($_data['finalprice']) && $_data['finalprice'])
		{
			$result['count'] = \dash\fit::number($_data['finalprice']);
		}

		if(isset($_data['barcode']))
		{
			$result['barcode'] = $_data['barcode'];
		}

		if(isset($_data['barcode2']))
		{
			$result['barcode2'] = $_data['barcode2'];
		}


		if(isset($_data['price']))
		{
			$result['price'] = $_data['price'];
		}

		if(isset($_data['buyprice']))
		{
			$result['buyprice'] = $_data['buyprice'];
		}

		if(isset($_data['discount']))
		{
			$result['discount'] = $_data['discount'];
		}

		if(isset($_data['code']))
		{
			$result['desc'] = T_("Code"). ' /'. $_data['code'];
		}

		if(isset($_data['price']))
		{
			$result['desc'] = T_("Price"). ' +'. $_data['price'];
		}

		// set scale as true if exist
		if(isset($_data['scale']) && $_data['scale'] === true)
		{
			$result['scale'] = true;
		}

		// if scale turn plus off
		if(!isset($_data['quantity']))
		{
			$result['quantity'] = 1;
		}
		else
		{
			$result['quantity'] = $_data['quantity'];
		}

		if(isset($_data['scaleDuplicate']))
		{
			$result['scaleDuplicate'] = $_data['scaleDuplicate'];
		}

		return $result;

	}
}
?>
