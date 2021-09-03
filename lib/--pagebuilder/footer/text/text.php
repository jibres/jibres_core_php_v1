<?php
namespace lib\pagebuilder\footer\text;


class text
{

	public static function input_condition($_args = [])
	{
		$_args['html']    = 'real_html';
		$_args['settext'] = 'bit';
		return $_args;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{

		$text = [];

		if($_data['settext'])
		{
			$_data['text'] = \dash\request::post_html();

			\lib\pagebuilder\tools\tools::need_redirect(\dash\url::pwd());

			\lib\pagebuilder\tools\tools::input_exception('text');
		}


		unset($_data['html']);
		unset($_data['settext']);

		return $_data;

	}
}
?>