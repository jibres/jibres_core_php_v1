<?php
namespace lib\app\pagebuilder\line;


class design
{
	public static function route()
	{
		$data = \lib\app\pagebuilder\line\get::load_current_element();

		if($data)
		{
			\dash\data::lineSetting($data);

			\dash\open::get();
			\dash\open::post();

			if(a($data, 'current_page_detail', 'detail', 'allow_upload_file'))
			{
				\dash\allow::file();
			}

			if(a($data, 'current_page_detail', 'detail', 'allow_html'))
			{
				\dash\allow::html();
			}
		}
	}


	/**
	 * Load fine
	 *
	 * @param      <type>  $_filename  The filename
	 */
	private static function load($_filename)
	{
		if(is_string($_filename))
		{
			$file = root. 'content_a/pagebuilder/box/%s.php';

			$tmp_file = sprintf($file, $_filename);

			if(is_file($tmp_file))
			{
				require_once($tmp_file);
			}
		}
	}


	public static function draw()
	{
		$lineSetting = \dash\data::lineSetting();

		$child    = \dash\url::dir(2);
		$subchild = \dash\url::dir(3);

		// load master module
		if(!$child && isset($lineSetting['key']))
		{
			self::load($lineSetting['key']);
		}

		if(isset($lineSetting['current_page_detail']['contain']) && is_array($lineSetting['current_page_detail']['contain']))
		{
			foreach ($lineSetting['current_page_detail']['contain'] as $key => $value)
			{
				if(isset($value['detail']['hidden']) && $value['detail']['hidden'])
				{
					// nothing
				}
				else
				{
					self::load($key);
				}
			}
		}
		else
		{
			if(isset($lineSetting['current_page_detail']['current_page']))
			{
				self::load($lineSetting['current_page_detail']['current_page']);
			}
		}
	}
}
?>