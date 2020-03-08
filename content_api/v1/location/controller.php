<?php
namespace content_api\v1\location;


class controller
{
	public static function routing()
	{
		if(!\dash\request::is('get'))
		{
			\content_api\v1\tools::invalid_method();
		}

		if(!\dash\url::subchild())
		{
			\content_api\v1\tools::stop(404, T_("Need country, province or city? Fix url!"));
		}

		if(count(\dash\url::dir()) > 3)
		{
			\content_api\v1\tools::invalid_url();
		}

		$data = [];
		switch (\dash\url::subchild())
		{
			case 'country':
				$data = \dash\utility\location\countres::$data;
				$new_data = [];
				foreach ($data as $key => $value)
				{
					if(is_array($value) && array_key_exists('name', $value) && array_key_exists('localname', $value))
					{
						$temp         = $value;
						$temp['id']   = $key;
						$temp['text'] = $value['localname'] ? $value['localname'] : $value['name'];
						$temp['flag'] = \dash\url::cdn(). '/img/flags/png100px/'. mb_strtolower($key). '.png';

						if(empty($new_data))
						{
							$new_data[] = ['id' => 0, 'text' => T_("Please choose country"), 'disable' => true];
						}

						$new_data[]   = $temp;
					}
				}
				$data = $new_data;
				break;

			case 'province':
				$country = \dash\request::get('country');
				if($country)
				{
					$data = \dash\utility\location\provinces::$data;
					$new_data = [];
					foreach ($data as $key => $value)
					{
						if(is_array($value) && array_key_exists('country', $value) && array_key_exists('localname', $value))
						{
							if(mb_strtoupper($country) === mb_strtoupper($value['country']))
							{
								$temp         = $value;
								$temp['id']   = $key;
								$temp['text'] = $value['localname'] ? $value['localname'] : $value['name'];

								if(empty($new_data))
								{
									$new_data[] = ['id' => 0, 'text' => T_("Please choose province"), 'disable' => true];
								}

								$new_data[]   = $temp;
							}
						}
					}
					$data = $new_data;
				}
				break;
			case 'city':
				$province = \dash\request::get('province');
				if($province)
				{
					$data = \dash\utility\location\cites::$data;

					$new_data = [];
					foreach ($data as $key => $value)
					{
						if(is_array($value) && array_key_exists('province', $value) && array_key_exists('localname', $value))
						{
							if(mb_strtoupper($province) === mb_strtoupper($value['province']))
							{
								$temp         = $value;
								$temp['id']   = $key;
								$temp['text'] = $value['localname'] ? $value['localname'] : $value['name'];

								if(empty($new_data))
								{
									$new_data[] = ['id' => 0, 'text' => T_("Please choose city"), 'disable' => true];
								}
								$new_data[]   = $temp;
							}
						}
					}
					$data = $new_data;
				}
				break;

			default:
				\content_api\v1\tools::invalid_url();
				break;
		}

		\content_api\v1\tools::say($data);

		// j(\dash\url::all());
	}


}
?>