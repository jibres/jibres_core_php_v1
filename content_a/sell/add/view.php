<?php
namespace content_a\sell\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Sale invoicing');
		$this->data->page['desc']  = '';
		// $this->data->page['desc']  = T_('Sell your product via Jibres and enjoy using integrated web base platform.');


		if(\lib\utility::get('q') && \lib\utility::get('json') === 'true')
		{
			$result = [];
			switch (\lib\utility::get('list'))
			{
				case 'customer':
					$meta         = [];
					$meta['type'] = ["IN", "('staff', 'customer', 'supplier') "];
					$resultRaw    = \lib\app\staff::list(\lib\utility::get('q'), $meta);

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
					$meta         = [];
					if(\lib\utility::get('q'))
					{
						$resultRaw    = \lib\app\product::list(\lib\utility::get('q'), $meta);

						foreach ($resultRaw as $key => $value)
						{
							if(isset($value['id']))
							{
								$result[$key]['value'] = T_($value['id']);
							}
							if(isset($value['title']))
							{
								$result[$key]['title'] = $value['title'];
							}
							if(isset($value['finalprice']))
							{
								$result[$key]['count'] = \lib\utility\human::fitNumber($value['finalprice']);;
							}
							if(isset($value['barcode']))
							{
								$result[$key]['barcode'] = $value['barcode'];
							}

							if(isset($value['barcode2']))
							{
								$result[$key]['barcode2'] = $value['barcode2'];
							}

							if(isset($value['price']))
							{
								$result[$key]['price'] = $value['price'];
							}

							if(isset($value['discount']))
							{
								$result[$key]['discount'] = $value['discount'];
							}

							$all_field_we_have =
							[
								'title', 'name', 'cat', 'slug', 'company', 'shortcode', 'unit',
								'barcode', 'barcode2', 'code', 'buyprice', 'price', 'discount',
								'discountpercent', 'vat', 'initialbalance', 'minstock', 'maxstock',
								'status', 'sold', 'stock', 'thumb', 'service', 'checkstock',
								'sellonline', 'sellstore', 'carton', 'datecreated', 'datemodified', 'desc',
							];

							// if(isset($value['cat']))
							// {
							// 	$result[$key]['desc'] = T_($value['cat']);
							// }
							// if(isset($value['name']))
							// {
							// 	$result[$key]['desc2'] = $value['name'];
							// }
						}
					}
					elseif(\lib\utility::get('barcode'))
					{
						$result = \lib\app\product::list(null, ['barcode' => \lib\utility::get('barcode')]);
						if(!$result)
						{
							$result = null;
						}
					}
					elseif(\lib\utility::get('id'))
					{
						$result = \lib\app\product::list(null, ['id' => \lib\utility::get('id')]);
						if(!$result)
						{
							$result = null;
						}
					}
					break;

				default:
					break;
			}


			\lib\debug::msg("list", json_encode($result, JSON_UNESCAPED_UNICODE));
			// force show json
			$this->_processor(['force_stop' => true, 'force_json' => true]);
			// \lib\code::exit();
		}

	}
}
?>
