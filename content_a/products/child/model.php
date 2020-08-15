<?php
namespace content_a\products\child;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post = \dash\request::post();

		$whole_edit = [];
		foreach ($post as $key => $value)
		{
			if(preg_match("/^whole_(price|buyprice|discount|stock|optionvalue1|optionvalue2|optionvalue3)_(\d+)$/", $key, $split))
			{
				$type = $split[1];
				$my_id = $split[2];

				if(!isset($whole_edit[$my_id]))
				{
					$whole_edit[$my_id] = [];
				}

				if($type === 'stock')
				{
					if(is_numeric($value))
					{
						$whole_edit[$my_id][$type] = $value;
					}
				}
				else
				{
					$whole_edit[$my_id][$type] = $value;
				}

			}
		}

		if($whole_edit)
		{
			\lib\app\product\edit::whole_edit($whole_edit, $id);
		}
		else
		{
			\dash\notif::error(T_("No data founded to edit!"));
			return false;
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>