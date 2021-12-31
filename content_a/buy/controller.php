<?php
namespace content_a\buy;


class controller extends \content_a\sale\controller
{

	public static function routing()
	{
		parent::routing();

		self::detect_next_prev();
	}


	private static function detect_next_prev()
	{
		if(\dash\url::dir(3))
		{
			return;
		}

		$subchild = \dash\url::subchild();
		$subchild = \dash\validate::factor_id($subchild, false);

		if(!$subchild)
		{
			return null;
		}

		$args =
		[
			'module'     => \dash\url::module(),
			'child'      => \dash\request::get('c'),
			'order_type' => 'buy',
		];

		$new_url = \dash\url::this();

		if(\dash\url::child() === 'next')
		{
			$new_url = \lib\app\order\next_prev::next($subchild, $args);
		}
		elseif(\dash\url::child() === 'prev')
		{
			$new_url = \lib\app\order\next_prev::prev($subchild, $args);
		}

		if($new_url)
		{
			\dash\redirect::to($new_url);
		}

	}
}
?>
