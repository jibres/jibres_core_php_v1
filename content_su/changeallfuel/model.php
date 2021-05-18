<?php
namespace content_su\changeallfuel;

class model
{
	public static function post()
	{
		\dash\code::time_limit(0);

		$old_fuel = 'jibres101';
		$all_store = \lib\db\store\get::all_store_fuel_detail();

		foreach ($all_store as $key => $value)
		{
			if(isset($value['fuel']))
			{
				if($value['fuel'] === $old_fuel)
				{
					\lib\app\store\changefuel::request($value['id'], '501');

					\lib\app\store\changefuel::run();

					\dash\db\mysql\tools\connection::close();
				}
			}
		}

	}
}
?>