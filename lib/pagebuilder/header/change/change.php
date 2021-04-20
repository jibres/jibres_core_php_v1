<?php
namespace lib\pagebuilder\header\change;


class change
{




	public static function input_condition($_args = [])
	{
		$_args['line'] = 'string_100';
		$_args['key']  = 'string_100';
		$_args['type'] = 'string_100';

		return $_args;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$change = [];

		// if(array_key_exists('key', $_data))
		// {
		// 	$change['header_key'] = $_data['key'];
		// }
		// elseif(a($_saved_detail, 'detail', 'header_key'))
		// {
		// 	$change['header_key'] = a($_saved_detail, 'detail', 'header_key');
		// }



		// \lib\pagebuilder\tools\tools::input_exception('detail');

		$_data['type'] = $_data['key'];

		\lib\pagebuilder\tools\tools::input_exception('type');

		\lib\pagebuilder\tools\tools::need_redirect(\dash\url::this(). '/'. $_data['key']. \dash\request::full_get());


		unset($_data['line']);
		unset($_data['key']);


		return $_data;

	}
}
?>