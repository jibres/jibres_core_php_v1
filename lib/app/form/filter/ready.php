<?php
namespace lib\app\form\filter;


class ready
{

	public static function row($_data, $_choice = [])
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}


	public static function row_where($_data, $_field_title = [])
	{

		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'condition':
					$query_condition = null;
					$condition_title = null;

					switch ($value)
					{
						case 'isnull':
							$query_condition = 'IS NULL';
							$condition_title = T_("Not answer");
							break;

						case 'like':
							$query_condition = 'LIKE';
							$condition_title = T_("Like");
							break;

						case 'isnotnull':
							$query_condition = 'IS NOT NULL';
							$condition_title = T_("Answered");
							break;

						case 'larger':
							$query_condition = '>=';
							$condition_title = T_("Is larger than");
							break;

						case 'less':
							$query_condition = '<=';
							$condition_title = T_("Is less than");
							break;

						case 'equal':
							$query_condition = '=';
							$condition_title = T_("Is equal");
							break;

						case 'notequal':
							$query_condition = '!=';
							$condition_title = T_("Is not equal");
							break;

						default:

							break;
					}
					$result[$key] = $value;
					$result['query_condition'] = $query_condition;
					$result['condition_title'] = $condition_title;
					break;

				case 'field':
					$result[$key] = $value;
					if(isset($_field_title[$value]['title']))
					{
						$result['field_title'] = $_field_title[$value]['title'];
					}

					if(isset($_field_title[$value]['item_id']))
					{
						$result['item_id'] = $_field_title[$value]['item_id'];
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}



}
?>