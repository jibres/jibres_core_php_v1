<?php
namespace dash\app\telegram;


class ready
{
	public static function row($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'creator':
				case 'user_id':
				case 'touser_id':
				case 'post_id':
					if($value)
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;
				case 'id':


				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>