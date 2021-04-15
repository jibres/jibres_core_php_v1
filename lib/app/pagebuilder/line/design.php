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


	public static function draw()
	{
		$lineSetting = \dash\data::lineSetting();

		$subchild = \dash\url::subchild();

		$file = root. 'content_a/pagebuilder/box/%s.php';

		if(is_array(a($lineSetting, 'design_map')))
		{
			foreach ($lineSetting['design_map'] as $box => $inside)
			{
				if($subchild)
				{
					if($box !== $subchild)
					{
						continue;
					}

					if(is_array($inside) && $subchild === $box)
					{
						foreach ($inside as $inside_box => $inside_value)
						{
							$tmp_file = sprintf($file, $inside_box);

							if(is_file($tmp_file))
							{
								require_once($tmp_file);
							}
						}
					}
					else
					{
						if(is_string($box))
						{
							$tmp_file = sprintf($file, $box);

							if(is_file($tmp_file))
							{
								require_once($tmp_file);
							}
						}
					}
				}
				else
				{
					if(is_string($box))
					{
						$tmp_file = sprintf($file, $box);

						if(is_file($tmp_file))
						{
							require_once($tmp_file);
						}
					}
				}

			}
		}

	}
}
?>