<?php
namespace lib\app\store;


class mystore
{
	public static function list()
	{
		$user_id = \dash\user::id();
		if(!$user_id)
		{
			return false;
		}

		$store_user = \lib\db\store\store_user::get_my_store($user_id);

		$result             = [];
		$result['staff']    = [];
		$result['customer'] = [];
		$result['supplier'] = [];

		foreach ($store_user as $key => $value)
		{
			$value = \dash\app::ready($value);

			if(isset($value['staff']) && $value['staff'] === 'yes')
			{
				$result['staff'][] = $value;
				continue;
			}

			if(isset($value['customer']) && $value['customer'] === 'yes')
			{
				$result['customer'][] = $value;
				continue;
			}

			if(isset($value['supplier']) && $value['supplier'] === 'yes')
			{
				$result['supplier'][] = $value;
				continue;
			}
		}



		return $result;
	}
}
?>