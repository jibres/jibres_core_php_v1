<?php
namespace lib\app\pagebuilder\line;


class design
{
	public static function route()
	{
		$child = \dash\url::child();

		$subchild = \dash\url::subchild();

		$id   = \dash\request::get('id');

		$args = [];

		$data = \lib\app\pagebuilder\line\get::load_element($child, $subchild, $id, $args);

		if($data)
		{
			\dash\data::lineSetting($data);
			\dash\open::get();
			\dash\open::post();
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

		$subchild = \dash\url::subchild();

		if(!is_array(a($lineSetting, 'elements')))
		{
			return;
		}


		foreach ($lineSetting['elements'] as $box => $inside)
		{
			if($subchild)
			{
				if($box !== $subchild)
				{
					continue;
				}
			}

			if(isset($inside['contain']) && is_array($inside['contain']))
			{
				if($box === $subchild)
				{
					foreach ($inside['contain'] as $inside_box => $inside_value)
					{
						self::load($inside_box);
					}
				}
				else
				{
					self::load($box);
				}
			}
			else
			{
				self::load($box);
			}
		}

	}
}
?>