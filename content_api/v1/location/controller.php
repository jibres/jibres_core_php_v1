<?php
namespace content_api\v1\location;


class controller
{
	public static function routing()
	{
		if(!\dash\request::is('get'))
		{
			\content_api\v1::invalid_method();
		}

		if(!\dash\url::subchild())
		{
			\content_api\v1::stop(404, T_("Need country, province or city? Fix url!"));
		}

		if(count(\dash\url::dir()) > 3)
		{
			\content_api\v1::invalid_url();
		}

		$data = [];
		switch (\dash\url::subchild())
		{
			case 'country':
				$data = \dash\utility\location\countres::$data;
				$new_data = [];
				foreach ($data as $key => $value)
				{
					$temp         = $value;
					$temp['id']   = $key;
					$temp['text'] = $value['localname'] ? $value['localname'] : $value['name'];
					$temp['flag'] = \dash\url::site(). '/static/img/flags/png100px/'. mb_strtolower($key). '.png';
					$new_data[]   = $temp;
				}
				$data = $new_data;
				break;

			case 'province':
				$country = \dash\request::get('country');
				if($country)
				{
					$data = \dash\utility\location\countres::$data;
				}
				break;
			case 'city':
				break;

			default:
				\content_api\v1::invalid_url();
				break;
		}

		\content_api\v1::say($data);

		// j(\dash\url::all());
	}


}
?>