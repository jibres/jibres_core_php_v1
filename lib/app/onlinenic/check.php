<?php
namespace lib\app\onlinenic;


class check
{

	public static function check($_domain, $_type = null)
	{
		$domain = \dash\validate::domain($_domain);

		// $result = \lib\onlinenic\api::check_domain($domain, $_type);

		$result =
		[
				'code' =>  1000,
				'msg'  =>  'Command completed successfully.',
				'data' =>
			    [
					'domain'  =>  'xjibres.com',
					'avail'   => 1,
					'premium' =>  false,
					'op'      =>  '1',
					'prices'  =>
			      [
						1  =>  8.59,
						2  =>  17.18,
						3  =>  25.77,
						4  =>  34.36,
						5  =>  42.95,
						6  =>  51.54,
						7  =>  60.13,
						8  =>  68.72,
						9  =>  77.31,
						10 =>  85.9,
			      ],
			    ],
		];

		if(!isset($result['data']))
		{
			return false;
		}

		$result = $result['data'];

		if(!is_array($result))
		{
			\dash\log::oops('response');
			return false;
		}

		if(array_key_exists('avail', $result))
		{
			$result['available'] = $result['avail'];
		}

		return $result;


	}


}
?>