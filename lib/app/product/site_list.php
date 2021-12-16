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

				$quick_add_args = [];

				if(mb_strlen(\dash\request::get('barcode')) === 5)
				{
					// do nothing
				}
				else
				{
					$quick_add_args['barcode'] = \dash\request::get('barcode');
				}
				$quick_add_args['iframe'] = 1;

				$quick_add_url = \dash\url::here(). '/products/quick?'. \dash\request::build_query($quick_add_args);
				$msg .= '<br><a href="'. $quick_add_url. '" data-fancybox data-type="iframe" target="_blank" class="font-bold link-primary">'. T_('add as new product'). '</a>';

				\dash\notif::result(['message' => $msg]);
				\dash\code::end();
			}

			$result = self::getNeededField($result, true);
			\dash\notif::result(['list' => json_encode($result, JSON_UNESCAPED_UNICODE)]);
			\dash\code::jsonBoom(\dash\notif::get());

		}
		elseif($id = \dash\validate::id(\dash\request::get('id'), false))
		{
			$result = \lib\app\product\get::get($id);
			if($result)
			{
				$result = self::getNeededField($result, true);
			}
			else
			{
				$result = [];
			}

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

	private static function getNeededField($_data, $_array = false)
	{

		if(\dash\request::get('mode') === 'text')
		{
			return
			[
				'id'       => a($_data, 'id'),
				'text'     => a($_data, 'title'),
			];
		}


		$result   = [];

		$id       = null;

		$html     = '<div class="flex align-center">';

		$priceTxt = '<span class="description ltr">';

		if(isset($_data['thumb']))
		{
			$html .= '<img class="flex-none rounded-lg max-h-7 w-7" src="'.  $_data['thumb'] .'"> ';
		}

		if(isset($_data['id']))
		{
			$id              = $_data['id'];
			$result['id']    = $id;
			$result['value'] = $id;
		}


		if(isset($_data['title']))
		{
			$result['title'] = $_data['title'];

			$html .= '<span class="mx-1 flex-grow">'. $_data['title']. '</span>';

			if(isset($_data['vat']) && $_data['vat'])
			{
				$html .= '*';
			}
		}


		if(isset($_data['finalprice']) && $_data['finalprice'])
		{
			$result['count']      = \dash\fit::number($_data['finalprice']);
			$result['finalprice'] = $_data['finalprice'];
			$priceTxt .= '<span class="font-bold">'. \dash\fit::number($result['finalprice']). '</span>';
		}

		if(isset($_data['barcode']))
		{
			$result['barcode'] = $_data['barcode'];
			$html .= '<span class="mx-1 px-1 rounded-lg bg-blue-100 text-blue-500">'. T_('Barcode'). '</span>';
		}

		if(isset($_data['barcode2']))
		{
			$result['barcode2'] = $_data['barcode2'];
			$html .= '<span class="mx-1 px-1 rounded-lg bg-blue-100 text-blue-500">'. T_('Iran barcode'). '</span>';
		}


		if(isset($_data['price']))
		{
			$result['price'] = floatval($_data['price']);
		}
		else
		{
			$result['price'] = null;

		}

		if(isset($_data['buyprice']))
		{
			$result['buyprice'] = floatval($_data['buyprice']);
		}

		if(isset($_data['discount']))
		{
			$result['discount'] = floatval($_data['discount']);
			$priceTxt .= ' - '. \dash\fit::number($result['discount']). '</span>';
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


		$result['stock'] = null;
		if(array_key_exists('stock', $_data))
		{
			$result['stock'] = $_data['stock'];
		}

		$result['vatIncluded'] = null;
		if(isset($_data['vat']) && $_data['vat'])
		{
			$result['vatIncluded'] = $_data['vat'];
		}

		$result['vat'] = null;
		if(isset($_data['vatprice']))
		{
			$result['vat'] = floatval($_data['vatprice']);
		}

		$result['editlink'] = a($_data, 'edit_iframe');
		$result['isProduct'] = true;


		// add price to name of item
		$html   .= $priceTxt. '</span>';
		$html   .= '</div>';


		if($_array)
		{
			return $result;
		}
		else
		{
			return
			[
				'html'     => $html,
				'id'       => $id,
				// for extra use and remove double query
				'datalist' => $result,
			];
		}

	}

}
?>
