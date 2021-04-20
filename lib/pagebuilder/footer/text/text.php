<?php
namespace lib\pagebuilder\footer\text;


class text
{

	public static function input_condition($_args = [])
	{
		$_args['html']    = 'real_html';
		return $_args;
	}




	public static function ready_for_db($_data, $_saved_detail = [])
	{

		$text = [];

		if(array_key_exists('html', $_data))
		{
			$_data['text'] = \dash\request::post_html();
		}
		elseif(a($_saved_detail, 'text'))
		{
			$text['text'] = a($_saved_detail, 'text');
		}

		\lib\pagebuilder\tools\tools::input_exception('text');

		\lib\pagebuilder\tools\tools::need_redirect(\dash\url::pwd(), true);


		unset($_data['html']);

		return $_data;

	}
}
?>