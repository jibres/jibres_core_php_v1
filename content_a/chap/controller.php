<?php
namespace content_a\chap;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\redirect::to(\dash\url::here());
		}
		elseif(\dash\url::child() === null)
		{
			\dash\redirect::to(self::factor_default_print_link(\dash\request::get('id'), \dash\request::get()));
		}

		\dash\permission::access('_group_orders');

		$child = \dash\url::child();
		if(in_array($child, ['receipt', 'fishprint', 'a4', 'a5']))
		{
			\dash\open::get();
		}
	}



	public static function factor_default_print_link($_id, array $_get_args = []) : string
	{
		$url = \dash\url::kingdom(). '/a/chap/';

		switch (\lib\store::detail('factordefaultprint'))
		{
			case 'a4_portrait':
				$_get_args['model'] = 'portrait';
				$url .= 'a4';
				break;

			case 'a4_landscape':
				$_get_args['model'] = 'landscape';
				$url .= 'a4';
				break;

			case 'a5_portrait':
				$_get_args['model'] = 'portrait';
				$url .= 'a5';
				break;

			case 'a5_landscape':
				$_get_args['model'] = 'landscape';
				$url .= 'a5';
				break;

			case 'receipt':
			default:
				$url .= 'receipt';
				break;
		}

		$_get_args['id'] = $_id;

		$url .= '?'. \dash\request::build_query($_get_args);

		return $url;
	}
}
?>
