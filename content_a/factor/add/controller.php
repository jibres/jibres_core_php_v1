<?php
namespace content_a\factor\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('aFactorAdd');



		if(\dash\request::get('json') === 'true')
		{
			$notif_result = [];
			$result       = [];
			switch (\dash\request::get('list'))
			{
				case 'customer':
					$meta                        = [];
					$meta['userstores.supplier'] = ["IS", "NULL"];
					$meta['sort_type']           = \dash\request::get('type');
					$resultRaw                   = \lib\app\thirdparty::list(\dash\request::get('q'), $meta);

					foreach ($resultRaw as $key => $value)
					{
						$name = '<div class="f">';

						if(isset($value['id']))
						{
							$result['result'][$key]['value'] = $value['id'];
						}

						if(isset($value['displayname']))
						{
							$name .='<span class="c"><b>'. $value['displayname'] . '</b></span>';

						}
						if(isset($value['mobile']))
						{
							$name .= '<div class="cauto floatL mL5 ">'.\dash\utility\human::number($value['mobile']). '</div>';

						}

						if(isset($value['staff']) && $value['staff'])
						{
							$name .= '<small title="'. T_("Staff").'" class="cauto floatL mL5 badge success">'. T_("Staff") . '</small>';
						}


						if(isset($value['customer']) && $value['customer'])
						{
							$name .= '<small title="'. T_("Customer").'" class="cauto floatL mL5 badge primary">'. T_("Customer") . '</small>';
						}


						if(isset($value['supplier']) && $value['supplier'])
						{
							$name .= '<small title="'. T_("Supplier").'" class="cauto floatL mL5 badge warn2">'. T_("Supplier") . '</small>';
						}

						// if(isset($value['code']))
						// {
						// 	$name .= '<span class="cauto badge light mRa5"><i class="sf-bookmark"></i> '. T_('Code'). $value['code']. '</span>';
						// }

						$result['result'][$key]['name'] = $name. '</div>';
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
							$result['result'][] = self::getNeededField($value);
						}
					}
					elseif(\dash\request::get('barcode'))
					{
						$result = \lib\app\product::list(null, ['barcode' => \dash\request::get('barcode')]);
						if(!$result)
						{
							$msg .= '<a href="/a/product/add?barcode='. \dash\request::get('barcode'). '" target="_blank">'. T_('add as new product'). '</a>';
							\dash\notif::result(['message' => $msg]);
							\dash\code::end();
						}

						$result = self::getNeededField_barcode($result);
						\dash\notif::result(['list' => json_encode($result, JSON_UNESCAPED_UNICODE)]);
						\dash\code::compile();
						\dash\code::boom();

					}
					elseif(\dash\request::get('id'))
					{
						$result = \lib\app\product::list(null, ['id' => \dash\request::get('id')]);
						$result = self::getNeededField_barcode($result);
						\dash\notif::result(['list' => json_encode($result, JSON_UNESCAPED_UNICODE)]);
						\dash\code::compile();
						\dash\code::boom();
					}
					else
					{
						$result['result'] =
						[
							[
								"name"  => T_("No result founded!"),
								"value" => null,
								// "disabled"  => true
							]
						];
					}
					if(!$result)
					{
						$notif_result['message'] = $msg;
					}
					break;

				default:
					break;
			}

			$result = json_encode($result, JSON_UNESCAPED_UNICODE);
			echo $result;
			\dash\code::boom();
		}

	}

	private static function getNeededField($_data)
	{

		// $myName = '<img class="ui avatar image" src="'.  $value['avatar'] .'">';
		// $myName .= '<span class="pRa10">'. \dash\utility\human::fitNumber($value['code'], false). '</span>';
		// $myName .= '   '. $value['firstname']. ' <b>'. $value['lastname']. '</b> <small class="badge light mLa5">'. $value['father'].'</small>';
		// $myName .= '<span class="description">'. \dash\utility\human::fitNumber($value['nationalcode'], false). '</span>';

		$result   = [];
		$id       = null;
		$name     = null;
		$datalist = [];
		$priceTxt = '<span class="description ltr">';

		if(isset($_data['thumb']))
		{
			$name .= '<img class="avatar image" src="'.  $_data['thumb'] .'"> ';
		}

		if(isset($_data['id']))
		{
			$id = $_data['id'];
			$datalist['id'] = $_data['id'];
		}

		if(isset($_data['title']))
		{
			$datalist['title'] = $_data['title'];
			$name .= '<span class="pRa10">'. $_data['title']. '</span>';
		}

		if(isset($_data['barcode']))
		{
			$datalist['barcode'] = $_data['barcode'];
			$name .= '<span class="badge light mRa5"><i class="sf-thumbnails"></i> '. T_('Barcode'). '</span>';
		}

		if(isset($_data['barcode2']))
		{
			$datalist['barcode2'] = $_data['barcode2'];
			$name .= '<span class="badge light mRa5"><i class="sf-check"></i> '. T_('Iran barcode'). '</span>';
		}

		if(isset($_data['code']))
		{
			$datalist['desc'] = T_("Code"). ' +'. $_data['code'];
			$name .= '<span class="badge light mRa5"><i class="sf-bookmark"></i> '. T_('Code'). $_data['code']. '</span>';
		}

		if(isset($_data['finalprice']) && $_data['finalprice'])
		{
			$datalist['finalprice'] = $_data['finalprice'];
			$priceTxt .= '<span class="txtB">'. \dash\utility\human::fitNumber($datalist['finalprice']). '</span>';
		}
		if(isset($_data['price']))
		{
			$datalist['price'] = $_data['price'];
			if(floatval($datalist['price']) !== floatval($datalist['finalprice']))
			{
				$priceTxt .= ' <span class="badge light mLR10"><i class="sf-bolt"></i> '. \dash\utility\human::fitNumber($datalist['price']);
			}
		}

		if(isset($_data['discount']))
		{
			$datalist['discount'] = $_data['discount'];
			$priceTxt .= ' - '. \dash\utility\human::fitNumber($datalist['discount']). '</span>';
		}


		// add price to name of item
		$name   .= $priceTxt. '</span>';
		$result =
		[
			// on list
			'name'     => $name,
			// after select
			// 'text'     => $name,
			// value for backend
			'value'    => $id,
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
			$result['id'] = T_($_data['id']);
			$result['value'] = T_($_data['id']);
		}

		if(isset($_data['title']))
		{
			$result['title'] = $_data['title'];
		}

		if(isset($_data['finalprice']) && $_data['finalprice'])
		{
			$result['count'] = \dash\utility\human::fitNumber($_data['finalprice']);
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

		return $result;

	}

}
?>
