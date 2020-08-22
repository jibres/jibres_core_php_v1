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


	public static function get_group()
	{
		$list = self::list();
		$new_list = [];
		foreach ($list as $key => $value)
		{
			if(array_key_exists('group', $value))
			{
				if(!isset($new_list[$value['group']]))
				{
					$new_list[$value['group']] = ['title' => $value['group'], 'list' => []];
				}

				$new_list[$value['group']]['list'][] = $value;
			}
		}

		return $new_list;
	}


	public static function list()
	{

		$type             = [];

		$type['short_answer'] =
		[
			'key'         => 'short_answer',
			'title'       => T_("Short answer"),
			'group'       => T_("Text"),
			'placeholder' => true,
			'maxlen'      => true,
			'default_load' =>
			[
				'placeholder' => T_("Type here ..."),
				'maxlen'      => 200,
			],
		];


		$type['descriptive_answer'] =
		[
			'key'         => 'descriptive_answer',
			'title'       => T_('Descriptive answer'),
			'group'       => T_('Text'),
			'placeholder' => true,
			'maxlen'      => true,
			'default_load' =>
			[
				'maxlen'     => 10000,
			],
		];



		$type['numeric'] =
		[
			'key'          => 'numeric',
			'title'        => T_('Numberic'),
			'group'        => T_('Numberic'),
			'placeholder'  => true,
			'min'          => true,
			'max'          => true,
			'default_load' =>
			[
				'min'     => 0,
				'max'     => 999999999999,
			],
		];


		$type['yes_no'] =
		[
			'key'          => 'yes_no',
			'title'        => T_('Yes-no'),
			'group'        => T_('Boolean'),
			'default_load' =>
			[
			],
		];


		$type['single_choice'] =
		[
			'key'          => 'single_choice',
			'title'        => T_('Single choice'),
			'group'        => T_('Optional choice'),
			'choice'       => true,
			'random'       => true,
			'default_load' =>
			[
			],
		];


		$type['multiple_choice'] =
		[
			'key'          => 'multiple_choice',
			'title'        => T_('Multiple choice'),
			'group'        => T_('Optional choice'),
			'choice'       => true,
			'random'       => true,
			'min'          => true,
			'max'          => true,
			'default_load' =>
			[
				'min'        => 1,
				'placeholder' => T_("You can choose as many as you want"),
			],
		];


		$type['dropdown'] =
		[
			'key'          => 'dropdown',
			'title'        => T_('Dropdown list'),
			'group'        => T_('Optional choice'),
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
			'group'        => T_('Date & time'),
			'default_load' =>
			[

			],
		];

		$type['birthdate'] =
		[
			'key'          => 'birthdate',
			'placeholder'  => true,
			'title'        => T_('Birthdate'),
			'group'        => T_('Date & time'),
			'default_load' =>
			[

			],
		];


		$type['time'] =
		[
			'key'          => 'time',
			'placeholder'  => true,
			'title'        => T_('Time'),
			'group'        => T_('Date & time'),
			'default_load' =>
			[
				'placeholder' => T_("Choose time"),
			],
		];



		$type['country'] =
		[
			'key'          => 'country',
			'placeholder'  => true,
			'title'        => T_('Country'),
			'group'        => T_('Location'),
			'default_load' =>
			[

			],
		];

		$type['province'] =
		[
			'key'          => 'province',
			'placeholder'  => true,
			'title'        => T_('Province'),
			'group'        => T_('Location'),
			'default_load' =>
			[

			],
		];

		$type['city'] =
		[
			'key'          => 'city',
			'placeholder'  => true,
			'title'        => T_('City'),
			'group'        => T_('Location'),
			'default_load' =>
			[

			],
		];

		if(\dash\language::current() === 'fa')
		{
			$type['province_city'] =
			[
				'key'          => 'province_city',
				'placeholder'  => true,
				'title'        => T_('Province-City'),
				'group'        => T_('Location'),
				'default_load' =>
				[

				],
			];
		}


		$type['gender'] =
		[
			'key'          => 'gender',
			'title'        => T_('Gender'),
			'group'        => T_('Signup form'),
			'default_load' =>
			[

			],
		];



		$type['tel'] =
		[
			'key'          => 'tel',
			'placeholder'  => true,
			'title'        => T_('Phone'),
			'group'        => T_('Numberic'),
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
			'group'        => T_('Other'),
			'maxlen'       => true,
			'filetype'     => true,
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
			'group'        => T_('Numberic'),
			'default_load' =>
			[
				'placeholder' => T_("Enter nationalcode"),
			],
		];


		$type['mobile'] =
		[
			'key'          => 'mobile',
			'title'        => T_('Mobile'),
			'group'        => T_('Signup form'),
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
			'group'        => T_('Signup form'),
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
			'group'        => T_('Text'),
			'default_load' =>
			[
				'placeholder' => T_("http://"),
			],
		];

		$type['password'] =
		[
			'key'          => 'password',
			'title'        => T_('Password'),
			'group'        => T_('Text'),
			'placeholder'  => true,
			'default_load' =>
			[

			],
		];


		$type['message'] =
		[
			'key'          => 'message',
			'title'        => T_('Message'),
			'group'        => T_("Other"),
			'color'        => true,
			'default_load' =>
			[

			],
		];



		$type['agree'] =
		[
			'key'          => 'agree',
			'title'        => T_('Agree'),
			'group'        => T_('Boolean'),
			'color'        => true,
			'default_load' =>
			[
			],
		];




		return $type;
	}


}
?>