<?php
namespace lib\app\product;


class ready
{

	public static function row($_data, $_option = [])
	{
		$default_option =
		[
			'load_gallery' => false,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$result = [];

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
					$result['id'] = $value;
					break;

				case 'creator':
				case 'cat_id':
				case 'unit_id':
				case 'company_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					break;

				case 'thumb':
					$result[$key] = isset($value) ? \dash\app\file::fix_path($value) : null;
					break;


				case 'gallery':
					$result['gallery'] = $value;
					$result['gallery_array'] = json_decode($value, true);
					if($_option['load_gallery'] && is_array($result['gallery_array']) && $result['gallery_array'])
					{
						$result['gallery_array'] = \lib\app\product\gallery::load_detail($result['gallery_array']);
					}
					break;

				case 'finalprice':
				case 'intrestrate':
				case 'intrestrate_impure':
					$result[$key] = isset($value) ? (float) $value : null;
					break;

				case 'vat':
				case 'infinite':
				case 'oversale':
					if(!$value)
					{
						$value = false;
					}
					else
					{
						$value = true;
					}

					$result[$key] = $value;
					break;

				case 'saleonline':
				case 'saletelegram':
				case 'saleapp':
					if(!$value)
					{
						$value = true;
					}
					else
					{
						$value = false;
					}
					$result[$key] = $value;
					break;

				case 'country':
				case 'city':
				case 'province':
				case 'zipcode':
				case 'name':
				case 'title':
				case 'desc':
				case 'alias':
				case 'status':
				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}
}
?>