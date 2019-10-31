<?php
namespace lib\app\store;


class polls
{
	public static function all()
	{
		return
		[
			'placeholder' => T_("Please choose one item1"),
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
		return
		[
			'id'    => __FUNCTION__ ,
			'title' => T_('Why you are here in Jibres?'),
			'items' =>
			[
				1 => T_("I'm not selling products yet"),
				2 => T_("I sell with a different system"),
				3 => T_("I'm hust playing around"),
				4 => T_("I'm selling, just not online"),
			]

		];
	}


	public static function Q2()
	{
		return
		[
			'id'    => __FUNCTION__ ,
			'title' => T_('Are you already selling?'),
			'items' =>
			[
				1 => T_("aa"),
				2 => T_("bb"),
				3 => T_("cc"),
				4 => T_("dd"),
			]

		];
	}


	public static function Q3()
	{
		return
		[
			'id'    => __FUNCTION__ ,
			'title' => T_('Are you setting up an online store for client?'),
			'items' =>
			[
				1 => T_("Yes, I'm developing a store for a clinet"),
				2 => T_("No, I'm an owner of bussiness"),
			]

		];
	}

}
?>