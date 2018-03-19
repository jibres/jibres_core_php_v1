<?php
namespace content_a\factor\edit;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Sale invoicing');
		$this->data->page['desc']  = '';
		// $this->data->page['desc']  = T_('Sale your product via Jibres and enjoy using integrated web base platform.');


		if(\lib\request::get('json') === 'true')
		{
			$result = [];
			switch (\lib\request::get('list'))
			{
				case 'customer':
					$meta         = [];
					$meta['type'] = ["IN", "('staff', 'customer', 'supplier') "];
					$resultRaw    = \lib\app\thirdparty::list(\lib\request::get('q'), $meta);

					foreach ($resultRaw as $key => $value)
					{
						if(isset($value['id']))
						{
							$result[$key]['value'] = T_($value['id']);
						}
						if(isset($value['fullname']))
						{
							$result[$key]['title'] = $value['fullname'];
						}
						if(isset($value['mobile']))
						{
							$result[$key]['count'] = $value['mobile'];
						}
						if(isset($value['type']))
						{
							$result[$key]['desc'] = T_($value['type']);
						}
						if(isset($value['code']))
						{
							$result[$key]['desc2'] = T_('code') . ' '. $value['code'];
						}
					}
					break;

				case 'product':
					$meta = [];
					$msg  = T_("Product not found."). ' ';
					if(\lib\request::get('q'))
					{
						$resultRaw    = \lib\app\product::list(\lib\request::get('q'), $meta);

						foreach ($resultRaw as $key => $value)
						{
							$result[$key] = self::getNeededField($value);
						}
					}
					elseif(\lib\request::get('barcode'))
					{
						$result = \lib\app\product::list(null, ['barcode' => \lib\request::get('barcode')]);
						$result = self::getNeededField($result);
						if(!$result)
						{
							$msg .= '<a href="/a/product/edit?barcode='. \lib\request::get('barcode'). '" target="_blank">'. T_('edit as new product'). '</a>';
							$result = null;
						}
					}
					elseif(\lib\request::get('id'))
					{
						$result = \lib\app\product::list(null, ['id' => \lib\request::get('id')]);
						$result = self::getNeededField($result);
						if(!$result)
						{
							$result = null;
						}
					}
					if(!$result)
					{
						// \lib\notif::title($msg);
					}
					break;

				default:
					break;
			}

			if(!$result)
			{
				$result = null;
			}
			else
			{
				$result = json_encode($result, JSON_UNESCAPED_UNICODE);
			}
			\lib\notif::result(["list" => $result]);
			// force show json
			$this->_processor(['force_stop' => true, 'force_json' => true]);
			// \lib\code::exit();

		}

		$meta         = [];

		$this->data->factor_detail = \lib\app\factor::get(['id' => \lib\request::get('id')], $meta);

	}

	private static function getNeededField($_data)
	{
		$result = [];

		if(isset($_data['id']))
		{
			$result['id'] = T_($_data['id']);
			$result['value'] = T_($_data['id']);
		}

		if(isset($_data['title']))
		{
			$result['title'] = $_data['title'];
		}

		if(isset($_data['finalprice']) && $_data['finalprice'])
		{
			$result['count'] = \lib\utility\human::fitNumber($_data['finalprice']);;
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

		if(isset($_data['discount']))
		{
			$result['discount'] = $_data['discount'];
		}

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
}
?>
