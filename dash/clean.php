<?php
namespace dash;
/**
 * Class for clean args
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */
class clean
{
	public static function data($_args, $_condition, $_required = [])
	{
		if(!$_args || !is_array($_args))
		{
			\dash\notif::error(T_("Input is required ans must be array!"));
			self::bye();
		}

		if(!$_condition || !is_array($_condition))
		{
			\dash\notif::error(T_("Contidion is required ans must be array!"));
			self::bye();
		}

		if(!is_array($_required))
		{
			\dash\notif::error(T_("Required field is must be array!"));
			self::bye();
		}

		$data = [];

		foreach ($_condition as $field => $validate)
		{
			if(!array_key_exists($field, $_args))
			{
				$data[$field] = null;
				continue;
			}

			$myData = $_args[$field];

			unset($_args[$field]);

			$check = false;

			if(is_string($validate))
			{
				$check = \dash\validate::$validate($myData);
			}
			elseif(is_array($validate))
			{
				if(isset($validate['enum']) && is_array($validate['enum']))
				{
					$check = \dash\validate::enum($myData, $validate['enum']);
				}
				else
				{
					$temp_data = $myData;

					if(is_array($temp_data))
					{
						foreach ($temp_data as $array_key => $array_validate)
						{

						}
					}
					else
					{
						\dash\notif::error(T_("Field :val must be array", ['val' => $field]));
					}
				}
			}
			else
			{
				\dash\notif::error(T_("Required field is must be array!"));
				self::by();
			}


			if($check === false)
			{
				\dash\notif::error(T_("Invalid input :val", ['val' => $field]), ['code' => 1400, 'element' => $field]);
				continue;
			}

			$data[$field] = $check;

		}

		if(count($_args) >= 1)
		{
			\dash\notif::error(T_("Neddless args was received!"));
			self::bye();
		}

		if($_required)
		{
			foreach ($_required as $required_field)
			{
				if(!$data[$required_field])
				{
					\dash\notif::error(T_("Field :val is required", ['val' => $required_field]), ['code' => 1500, 'element' => $required_field]);
				}
			}
		}

		if(!\dash\engine\process::status())
		{
			self::bye();
		}

		return $data;
	}




	private static function bye()
	{
		\dash\header::status(400);
	}
}
?>