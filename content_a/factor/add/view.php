<?php
namespace content_a\factor\add;


class view
{
	public static function config()
	{
		\dash\permission::access('aFactorAdd');

		\dash\data::page_title(T_('Sale invoicing'));
		// \dash\data::page_desc(T_('Sale your product via Jibres and enjoy using integrated web base platform.'));
		\dash\data::badge_text(T_('Back to last sales'));
		\dash\data::badge_link(\dash\url::this());


		if(\dash\request::get('json') === 'true')
		{
			$notif_result = [];
			$result = [];
			switch (\dash\request::get('list'))
			{
				case 'customer':
					$meta                        = [];
					$meta['userstores.supplier'] = ["IS", "NULL"];
					$meta['sort_type']           = \dash\request::get('type');
					$resultRaw                   = \lib\app\thirdparty::list(\dash\request::get('q'), $meta);

					foreach ($resultRaw as $key => $value)
					{
						if(isset($value['id']))
						{
							$result[$key]['value'] = T_($value['id']);
						}
						if(isset($value['displayname']))
						{
							$result[$key]['title'] = $value['displayname'];
						}
						if(isset($value['mobile']))
						{
							$result[$key]['count'] = $value['mobile'];
						}

						$desc = null;

						if(isset($value['staff']) && $value['staff'])
						{
							$desc .= T_("Staff");
						}


						if(isset($value['customer']) && $value['customer'])
						{
							$desc .= ' - '. T_("Customer");
						}


						if(isset($value['supplier']) && $value['supplier'])
						{
							$desc .= ' - '. T_("Supplier");
						}

						$result[$key]['desc'] = trim(trim($desc), '-');

						if(isset($value['code']))
						{
							$result[$key]['desc2'] = T_('code') . ' '. $value['code'];
						}
					}
					break;

				case 'product':
					$meta = [];
					$msg  = T_("Product not found."). ' ';
					if(\dash\request::get('q'))
					{
						$resultRaw    = \lib\app\product::list(\dash\request::get('q'), $meta);
						foreach ($resultRaw as $key => $value)
						{
							$result[$key] = self::getNeededField($value);
						}
					}
					elseif(\dash\request::get('barcode'))
					{
						$result = \lib\app\product::list(null, ['barcode' => \dash\request::get('barcode')]);
						$result = self::getNeededField($result);
						if(!$result)
						{
							$msg .= '<a href="/a/product/add?barcode='. \dash\request::get('barcode'). '" target="_blank">'. T_('add as new product'). '</a>';
							$result = null;
						}
					}
					elseif(\dash\request::get('id'))
					{
						$result = \lib\app\product::list(null, ['id' => \dash\request::get('id')]);
						$result = self::getNeededField($result);
						if(!$result)
						{
							$result = null;
						}
					}
					if(!$result)
					{
						$notif_result['message'] = $msg;
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
			$notif_result['list'] = $result;
			\dash\notif::result($notif_result);
			// force show json
			// @check below line
			\dash\code::end();
		}

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
			$result['count'] = \dash\utility\human::fitNumber($_data['finalprice']);;
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

		if(isset($_data['code']))
		{
			$result['desc'] = T_("Code"). ' /'. $_data['code'];
		}

		if(isset($_data['price']))
		{
			$result['desc'] = T_("Price"). ' +'. $_data['price'];
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
