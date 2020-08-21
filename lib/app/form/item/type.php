<?php
namespace lib\app\form\item;


class type
{

	public static function get_keys()
	{
		$type = self::list();
		$keys = array_keys($type);
		return $keys;
	}


	public static function get($_key)
	{
		$type = self::list();
		if(isset($type[$_key]))
		{
			return $type[$_key];
		}
		return [];
	}


	public static function list()
	{

		$type             = [];

		$type['short_answer'] =
		[
			'key'         => 'short_answer',
			'title'       => T_("Short answer"),
			'placeholder' => true,
			'maxlen'      => true,
			'default_load' =>
			[
				'placeholder' => T_("Type here ..."),
				'maxlen'      => 500,
			],
		];


		$type['descriptive_answer'] =
		[
			'key'         => 'descriptive_answer',
			'title'       => T_('Descriptive answer'),
			'placeholder' => true,
			'maxlen'      => true,
			'default_load' =>
			[
				'maxlen'     => 10000,
			],
		];



		$type['descriptive_after_short_answer'] =
		[
			'key'         => 'descriptive_after_short_answer',
			'title'       => T_('Descriptive answer after short answer'),
			'placeholder' => true,
			'maxlen'      => true,
			'maxlen2'      => true,
			'default_load' =>
			[
				'maxlen'     => 100,
				'maxlen2'     => 10000,
			],
		];





		$type['numeric'] =
		[
			'key'          => 'numeric',
			'title'        => T_('Numberic'),
			'placeholder'  => true,
			'min'          => true,
			'max'          => true,
			'default_load' =>
			[
				'min'     => 0,
				'max'     => 999999999999,
			],
		];



		$type['single_choice'] =
		[
			'key'          => 'single_choice',
			'title'        => T_('Single choice'),
			'choice'       => true,
			'choiceinline' => true,
			'random'       => true,
			'default_load' =>
			[
				'choiceinline' => true,
			],
		];


		$type['multiple_choice'] =
		[
			'key'          => 'multiple_choice',
			'title'        => T_('Multiple choice'),
			'choice'       => true,
			'random'       => true,
			'min'          => true,
			'max'          => true,
			'placeholder'  => true,
			'default_load' =>
			[
				'min'        => 1,
				'placeholder' => T_("You can choose as many as you want"),
			],
		];


		$type['dropdown'] =
		[
			'key'          => 'dropdown',
			'title'        => T_('Dropdown'),
			'placeholder'  => true,
			'choice'       => true,
			'random'       => true,
			'default_load' =>
			[
				'placeholder' => T_("Please choose one item"),
			],
		];


		$type['date'] =
		[
			'key'          => 'date',
			'placeholder'  => true,
			'title'        => T_('Date'),
			'default_load' =>
			[

			],
		];

		$type['birthdate'] =
		[
			'key'          => 'birthdate',
			'placeholder'  => true,
			'title'        => T_('Birthdate'),
			'default_load' =>
			[

			],
		];



		$type['country'] =
		[
			'key'          => 'country',
			'placeholder'  => true,
			'title'        => T_('Country'),
			'default_load' =>
			[

			],
		];

		$type['province'] =
		[
			'key'          => 'province',
			'placeholder'  => true,
			'title'        => T_('Province'),
			'default_load' =>
			[

			],
		];

		$type['city'] =
		[
			'key'          => 'city',
			'placeholder'  => true,
			'title'        => T_('City'),
			'default_load' =>
			[

			],
		];


		$type['gender'] =
		[
			'key'          => 'gender',
			'placeholder'  => true,
			'title'        => T_('Gender'),
			'default_load' =>
			[

			],
		];




		$type['time'] =
		[
			'key'          => 'time',
			'placeholder'  => true,
			'title'        => T_('Time'),
			'default_load' =>
			[
				'placeholder' => T_("Choose time"),
			],
		];


		$type['tel'] =
		[
			'key'          => 'tel',
			'placeholder'  => true,
			'title'        => T_('Phone'),
			'default_load' =>
			[
				'placeholder' => T_("Phone number"),
			],
		];



		$type['file'] =
		[
			'key'          => 'file',
			'placeholder'  => true,
			'title'        => T_('Upload'),
			'default_load' =>
			[

			],
		];


		$type['nationalcode'] =
		[
			'key'          => 'nationalcode',
			'placeholder'  => true,
			'check_unique' => true,
			'title'        => T_('Nationalcode'),
			'default_load' =>
			[
				'placeholder' => T_("Enter nationalcode"),
			],
		];


		$type['mobile'] =
		[
			'key'          => 'mobile',
			'title'        => T_('Mobile'),
			'placeholder'  => true,
			'check_unique'  => true,
			'default_load' =>
			[
				'placeholder' => T_("Enter mobile"),
			],
		];


		$type['email'] =
		[
			'key'          => 'email',
			'placeholder'  => true,
			'title'        => T_('Email'),
			'check_unique'  => true,
			'default_load' =>
			[
				'placeholder' => T_("abc@youdomain.com"),
			],
		];


		$type['website'] =
		[
			'key'          => 'website',
			'placeholder'  => true,
			'title'        => T_('Website'),
			'default_load' =>
			[
				'placeholder' => T_("http://"),
			],
		];

		$type['password'] =
		[
			'key'          => 'password',
			'title'        => T_('Password'),
			'placeholder'  => true,
			'default_load' =>
			[

			],
		];


		$type['message'] =
		[
			'key'          => 'message',
			'title'        => T_('Message'),
			'default_load' =>
			[

			],
		];




		return $type;
	}


}
?>