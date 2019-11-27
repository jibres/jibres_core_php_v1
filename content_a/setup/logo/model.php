<?php
namespace content_a\setup\logo;


class model
{
	public static function post()
	{
		if(\dash\request::post('skip') === 'skip')
		{
			// skip this step
		}
		else
		{
			$result = \lib\app\setting\setup::upload_logo(\dash\data::dataRow_logo());
			if($result)
			{
				\lib\store::refresh();
				\dash\notif::direct();
			}
			else
			{
				return false;
			}
		}

		$next_level = \lib\app\setting\setup::logo();
		\dash\redirect::to($next_level);
	}

}
?>
