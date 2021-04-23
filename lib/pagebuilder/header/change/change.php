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
		if(isset($_data['key']) && $_data['key'])
		{
			$_data['type'] = $_data['key'];

			$_data['title'] = \lib\pagebuilder\tools\tools::get_element_title('header', $_data['key']);

			\lib\pagebuilder\tools\tools::input_exception('type');
			\lib\pagebuilder\tools\tools::input_exception('title');

			\lib\pagebuilder\tools\tools::need_redirect(\dash\url::that(). '/'. $_data['key']. \dash\request::full_get());
		}


		unset($_data['line']);
		unset($_data['key']);


		return $_data;

	}
}
?>