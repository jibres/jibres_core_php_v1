<?php
namespace content_a\products\child;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');


		if(\dash\request::post('remove') === 'remove')
		{
			$result = \lib\app\product\remove::product(\dash\request::post('id'));
			return true;
		}


		$post = \dash\request::post();

		$whole_edit = [];
		$new_variants = [];
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

			if(preg_match("/^new_(price|buyprice|discount|stock|optionvalue1|optionvalue2|optionvalue3)$/", $key, $split))
			{
				$type = $split[1];

				if($type === 'stock')
				{
					if(is_numeric($value))
					{
						$new_variants[$type] = $value;
					}
				}
				else
				{
					$new_variants[$type] = isset($value) ? $value : null;
				}

			}
		}

		$ok = false;
		if($whole_edit)
		{
			$ok = true;
			\lib\app\product\edit::whole_edit($whole_edit, $id);
		}

		$new_variants = array_filter($new_variants);

		if($new_variants)
		{
			$ok = true;
			\lib\app\product\variants::add_child($new_variants, $id);
		}

		if(!$ok)
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