<?php
namespace content_love\gift\create\price;


class controller
{
	public static function routing()
	{
		\content_love\gift\create\controller::load(false);

		$type = null;

		if(\dash\data::dataRow_giftamount())
		{
			$type = 'amount';
		}
		elseif(\dash\data::dataRow_giftpercent())
		{
			$type = 'percent';
		}
		else
		{
			$type = \dash\validate::enum(\dash\request::get('type'), false, ['enum' => ['amount', 'percent']]);
		}

		if(!$type)
		{
			\dash\redirect::to(\dash\url::that(). '/add');
		}

		\dash\data::myType($type);

	}
}
?>