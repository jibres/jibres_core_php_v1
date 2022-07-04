<?php
namespace lib\app\form\condition;


class check
{
	public static function true_item($_full_item, $_condition, $_answer)
	{
		if(!$_condition || !is_array($_condition))
		{
			return $_full_item;
		}

		foreach ($_condition as $key => $value)
		{
			if($value['operation'] === 'isequal')
			{
				if($value['value'] == a($_answer, $value['if']))
				{
					if(a($value, 'else'))
					{
						$_full_item = self::remove_item_index($_full_item, $value['else']);
					}

					// then need stay
					// remove else
				}
				else
				{
					if(a($value, 'then'))
					{
						$_full_item = self::remove_item_index($_full_item, $value['then']);
					}

					// else need stay
					// remove then
				}
			}
		}

		return $_full_item;
	}


	private static function remove_item_index($_full_item, $_item_id)
	{
		foreach ($_full_item as $key => $value)
		{
			if($value['id'] == $_item_id)
			{
				unset($_full_item[$key]);
				break;
			}
		}

		return $_full_item;
	}
}
?>