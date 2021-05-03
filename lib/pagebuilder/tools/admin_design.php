<?php
namespace lib\pagebuilder\tools;


class admin_design
{
	public static function route()
	{
		$data = \lib\pagebuilder\tools\get::load_current_element();


		if($data)
		{
			\dash\data::lineSetting($data);

			\dash\open::get();
			\dash\open::post();

			if(a($data, 'current_module_detail', 'detail', 'allow_upload_file'))
			{
				\dash\allow::file();
			}

			if(a($data, 'current_module_detail', 'detail', 'allow_html'))
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
	private static function load($_folder, $_module, $_filename = 'design')
	{
		if(is_string($_folder) && is_string($_module) && is_string($_filename))
		{
			$file = root. 'lib/pagebuilder/%s/%s/%s.php';

			$tmp_file = sprintf($file, $_folder, $_module, $_filename);

			if(is_file($tmp_file))
			{
				require_once($tmp_file);
			}
			else
			{
				$tmp_file = sprintf($file, $_folder, $_filename, 'design');

				if(is_file($tmp_file))
				{
					require_once($tmp_file);
				}
			}
		}
	}


	public static function draw()
	{
		$lineSetting = \dash\data::lineSetting();

		$child    = \dash\url::dir(3);
		$subchild = \dash\url::dir(4);

		// load master module
		if(!$child && isset($lineSetting['key']))
		{
			self::load($lineSetting['mode'], $lineSetting['key']);
		}

		if(isset($lineSetting['current_module_detail']['contain']) && is_array($lineSetting['current_module_detail']['contain']))
		{
			foreach ($lineSetting['current_module_detail']['contain'] as $key => $value)
			{
				if(isset($value['detail']['hidden']) && $value['detail']['hidden'])
				{
					// nothing
				}
				else
				{
					self::load($lineSetting['mode'], $lineSetting['key'], $key);
				}
			}
		}
		else
		{
			if(isset($lineSetting['current_module_detail']['current_page']))
			{
				self::load($lineSetting['mode'], $lineSetting['key'], $lineSetting['current_module_detail']['current_page']);
			}
		}
	}
}
?>