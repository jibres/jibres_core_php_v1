<?php
namespace lib\app\store;


class polls
{
	public static function all()
	{
		return
		[
			'placeholder' => T_("Please choose one item"),
			'questions'   =>
			[
				self::Q1(),
				self::Q2(),
				self::Q3(),
			]
		];

	}


	public static function Q1()
	{
		$question =
		[
			'id'    => __FUNCTION__ ,
			'title' => T_('Why you are here in Jibres?'),
			'items' =>
			[
				1 => T_("I'm try to create my own business"),
				2 => T_("I want to extend my business"),
				3 => T_("I'm just playing around 😀"),
				4 => T_("I'm your rival ;)"),
				5 => T_("I'm not satisfied with my current software!"),
			],
		];

		if(a(\dash\session::get('create_business'), 'title'))
		{
			if(strpos(a(\dash\session::get('create_business'), 'title'), 'test') !== false)
			{
				$question['selected'] = 3;
			}

		}
		return $question;
	}


	public static function Q2()
	{
		return
		[
			'id'    => __FUNCTION__ ,
			'title' => T_('Are you already selling?'),
			'items' =>
			[
				1 => T_("No, I'm not selling products yet"),
				2 => T_("Yes, I'm selling in store, just not online"),
				3 => T_("Yes, I sell with a different system"),
			]

		];
	}


	public static function Q3()
	{
		return
		[
			'id'    => __FUNCTION__ ,
			'title' => T_('Are you setting up an online store for yourself?'),
			'items' =>
			[
				1 => T_("Yes, I'm an owner of business"),
				2 => T_("No, I'm developing a store for a client"),
			]

		];
	}

}
?>