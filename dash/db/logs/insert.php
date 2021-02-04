<?php
namespace dash\db\logs;

class insert
{
	public static function send_group($_args, $_group)
	{
		$new_args = $_args;
		unset($new_args['to']);
		$VALUES = [];
		$FIELDS = [];
		foreach ($new_args as $key => $value)
		{
			$FIELDS[] = "`$key`";

			if(is_null($value))
			{
				$VALUES[] = "NULL";
			}
			elseif(is_numeric($value))
			{
				$VALUES[] = $value;
			}
			else
			{
				$VALUES[] = "'$value'";
			}
		}


		$VALUES = implode(',', $VALUES);
		$FIELDS = implode(',', $FIELDS);

		$query = null;

		switch ($_group)
		{
			case 'all_users':
				$query = "SELECT users.id, $VALUES FROM users ";
				break;

			case 'users_have_order':
				$query = "SELECT factors.customer, $VALUES FROM factors WHERE factors.customer IS NOT NULL GROUP BY factors.customer ";
				break;

			case 'users_havenot_order':
				$query = "SELECT users.id, $VALUES FROM users LEFT JOIN factors ON factors.customer = users.id  WHERE factors.customer IS NULL  ";
				break;

			default:
				return false;
				break;
		}

		if($query)
		{
			$run_query = "INSERT INTO logs (logs.to, $FIELDS) $query ";
			$result = \dash\db::query($run_query);
			return $result;
		}
		else
		{
			return false;
		}
	}


}
?>