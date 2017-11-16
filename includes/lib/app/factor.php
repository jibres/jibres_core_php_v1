<?php
namespace lib\app;
use \lib\utility;
use \lib\debug;

/**
 * Class for factor.
 */
class factor
{

	use \lib\app\factor\add;
	use \lib\app\factor\edit;
	use \lib\app\factor\datalist;
	use \lib\app\factor\get;
	use \lib\app\factor\dashboard;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		$title = null;
		if(\lib\app::isset_request('title'))
		{
			$title = \lib\app::request('title');
			$title = trim($title);
			if(!$title)
			{
				\lib\app::log('api:factor:title:not:set', \lib\user::id(), $log_meta);
				if($_option['debug']) debug::error(T_("Product title can not be null"), 'title');
				return false;
			}

			if(mb_strlen($title) >= 500)
			{
				\lib\app::log('api:factor:title:max:lenght', \lib\user::id(), $log_meta);
				if($_option['debug']) debug::error(T_("Product title must be less than 500 character"), 'title');
				return false;
			}
		}


		$args                    = [];
		$args['title']           = $title;

		return $args;
	}


	/**
	 * ready data of factor to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
					if(isset($value))
					{
						$result[$key] = \lib\utility\shortURL::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}
}
?>