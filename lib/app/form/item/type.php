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
		$list     = self::list();
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

		$type = [];

		$type['short_answer'] =
			[
				'key'          => 'short_answer',
				'title'        => T_("Short answer"),
				'chart'        => true,
				'chart_type'   => 'wordcloud',
				'group'        => T_("Text"),
				'placeholder'  => true,
				'maxlen'       => true,
				'default_load' =>
					[
						'placeholder' => T_("Type here ..."),
						'maxlen'      => 200,
					],
			];


		$type['descriptive_answer'] =
			[
				'key'          => 'descriptive_answer',
				'title'        => T_('Descriptive answer'),
				'chart'        => true,
				'chart_type'   => 'wordcloud',
				'group'        => T_('Text'),
				'placeholder'  => true,
				'maxlen'       => true,
				'default_load' =>
					[
						'maxlen' => 10000,
					],
			];


		$type['numeric'] =
			[
				'key'          => 'numeric',
				'title'        => T_('Numberic'),
				'chart'        => true,
				'chart_type'   => 'bar',
				'group'        => T_('Numberic'),
				'placeholder'  => true,
				'min'          => true,
				'max'          => true,
				'default_load' =>
					[
						'min' => 0,
						'max' => 999999999999,
					],
			];

		$type['tel'] =
			[
				'key'          => 'tel',
				'placeholder'  => true,
				'chart'        => false,
				'chart_type'   => null,
				'title'        => T_('Phone'),
				'group'        => T_('Numberic'),
				'default_load' =>
					[
						'placeholder' => T_("Phone number"),
					],
			];

		$type['nationalcode'] =
			[
				'key'          => 'nationalcode',
				'placeholder'  => true,
				'chart'        => false,
				'chart_type'   => null,
				'check_unique' => true,
				'title'        => T_('Nationalcode'),
				'group'        => T_('Numberic'),
				'default_load' =>
					[
						'placeholder' => T_("Enter nationalcode"),
					],
			];


		if(\dash\language::current() === 'fa')
		{
			$type['ircard'] =
				[
					'key'          => 'ircard',
					'title'        => T_('Card Number'),
					'group'        => T_('Numberic'),
					'placeholder'  => true,
					'default_load' =>
						[
						],
				];

			$type['irshaba'] =
				[
					'key'          => 'irshaba',
					'title'        => T_('Shaba Number'),
					'group'        => T_('Numberic'),
					'placeholder'  => true,
					'default_load' =>
						[
						],
				];

		}

		$type['yes_no'] =
			[
				'key'          => 'yes_no',
				'title'        => T_('Yes-no'),
				'chart'        => true,
				'compare'      => true,
				'chart_type'   => 'pie',
				'group'        => T_('Optional choice'),
				'default_load' =>
					[
					],
			];


		$type['single_choice'] =
			[
				'key'          => 'single_choice',
				'title'        => T_('Single choice'),
				'chart'        => true,
				'compare'      => true,
				'chart_type'   => 'pie',
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
				'chart'        => true,
				'chart_type'   => 'pie',
				'group'        => T_('Optional choice'),
				'choice'       => true,
				'random'       => true,
				'min'          => true,
				'max'          => true,
				'default_load' =>
					[
						'min'         => 1,
						'placeholder' => T_("You can choose as many as you want"),
					],
			];


		$type['dropdown'] =
			[
				'key'          => 'dropdown',
				'title'        => T_('Dropdown list'),
				'chart'        => true,
				'compare'      => true,
				'chart_type'   => 'pie',
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
				'chart'        => true,
				'chart_type'   => 'wordcloud',
				'title'        => T_('Date'),
				'group'        => T_('Date & time'),
				'mindate'      => true,
				'maxdate'      => true,
				'default_load' =>
					[

					],
			];


		$type['birthdate'] =
			[
				'key'          => 'birthdate',
				'placeholder'  => true,
				'chart'        => true,
				'chart_type'   => 'pie',
				'title'        => T_('Birthdate'),
				'group'        => T_('Date & time'),
				'mindate'      => true,
				'maxdate'      => true,
				'default_load' =>
					[

					],
			];


		$type['time'] =
			[
				'key'          => 'time',
				'placeholder'  => true,
				'chart'        => true,
				'chart_type'   => 'wordcloud',
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
				'chart'        => true,
				'chart_type'   => 'country',
				'title'        => T_('Country'),
				'group'        => T_('Location'),
				'default_load' =>
					[

					],
			];


		if(\dash\language::current() === 'fa')
		{

			$type['province'] =
				[
					'key'          => 'province',
					'placeholder'  => true,
					'chart'        => true,
					'chart_type'   => 'province',
					'title'        => T_('Province'),
					'group'        => T_('Location'),
					'default_load' =>
						[

						],
				];

			$type['province_city'] =
				[
					'key'          => 'province_city',
					'placeholder'  => true,
					'chart'        => true,
					'chart_type'   => 'province',
					'title'        => T_('Province-City'),
					'group'        => T_('Location'),
					'default_load' =>
						[

						],
				];

		}


		$type['postalcode'] =
			[
				'key'          => 'postalcode',
				'placeholder'  => true,
				'chart'        => false,
				'chart_type'   => null,
				'title'        => T_('Postalcode'),
				'group'        => T_('Location'),
				'default_load' =>
					[

					],
			];


		$type['file'] =
			[
				'key'          => 'file',
				'placeholder'  => true,
				'chart'        => false,
				'chart_type'   => null,
				'title'        => T_('Upload'),
				'group'        => T_('Other'),
				'maxlen'       => true,
				'filetype'     => true,
				'default_load' =>
					[
					],
			];


		$type['mobile'] =
			[
				'key'          => 'mobile',
				'title'        => T_('Mobile'),
				'chart'        => false,
				'chart_type'   => null,
				'group'        => T_('Signup form'),
				'placeholder'  => true,
				'check_unique' => true,
				'send_sms'     => true,
				'signup'       => true,
				'default_load' =>
					[
						'placeholder' => T_("Enter mobile"),
					],
			];


		$type['email'] =
			[
				'key'          => 'email',
				'placeholder'  => true,
				'chart'        => false,
				'chart_type'   => null,
				'title'        => T_('Email'),
				'group'        => T_('Signup form'),
				'check_unique' => true,
				'default_load' =>
					[
						'placeholder' => T_("abc@youdomain.com"),
					],
			];


		$type['displayname'] =
			[
				'key'          => 'displayname',
				'title'        => T_('Full name'),
				'chart'        => true,
				'chart_type'   => 'wordcloud',
				'group'        => T_('Signup form'),
				'placeholder'  => true,
				'default_load' =>
					[
						'placeholder' => T_("Your name"),
					],
			];


		$type['gender'] =
			[
				'key'          => 'gender',
				'title'        => T_('Gender'),
				'chart'        => true,
				'compare'      => true,
				'chart_type'   => 'pie',
				'group'        => T_('Signup form'),
				'default_load' =>
					[

					],
			];


		$type['website'] =
			[
				'key'          => 'website',
				'placeholder'  => true,
				'chart'        => false,
				'chart_type'   => null,
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
				'chart'        => false,
				'chart_type'   => null,
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
				'chart'        => false,
				'chart_type'   => null,
				'group'        => T_("Other"),
				'color'        => true,
				'link'         => true,
				'default_load' =>
					[

					],
			];


		$type['hidden'] =
			[
				'key'          => 'hidden',
				'title'        => T_('Hidden input'),
				'chart'        => false,
				'description'  => false,
				'hiddenable'   => false,
				'require'      => false,
				'chart_type'   => null,
				'group'        => T_("Other"),
				'defaultvalue' => true,
				'default_load' =>
					[

					],
			];


		$type['hiddenurl'] =
			[
				'key'          => 'hiddenurl',
				'title'        => T_('Hidden input from URL'),
				'chart'        => false,
				'description'  => false,
				'require'      => false,
				'hiddenable'   => false,
				'chart_type'   => null,
				'group'        => T_("Other"),
				'urlkey'       => true,
				'whitelist'    => true,
				'defaultvalue' => true,
				'default_load' =>
					[

					],
			];


		$type['agree'] =
			[
				'key'          => 'agree',
				'title'        => T_('Agree'),
				'chart'        => true,
				'compare'      => true,
				'chart_type'   => 'pie',
				'group'        => T_('Other'),
				'color'        => true,
				'default_load' =>
					[
					],
			];


		$type['random'] =
			[
				'key'          => 'random',
				'title'        => T_('Random'),
				'group'        => T_('Other'),
				'require'      => false,
				'length'       => true,
				'lowercase'    => true,
				'uppercase'    => true,
				'default_load' =>
					[

					],
			];


		$type['manual_amount'] =
			[
				'key'          => 'manual_amount',
				'title'        => T_('Manual amount'),
				'chart'        => false,
				'compare'      => false,
				'chart_type'   => 'bar',
				'group'        => T_('Price'),
				'placeholder'  => true,
				'min'          => true,
				'max'          => true,
				'defaultvalue' => true,
				'default_load' =>
					[
					],
			];


		$type['list_amount'] =
			[
				'key'          => 'list_amount',
				'title'        => T_('List amount'),
				'chart'        => false,
				'compare'      => false,
				'chart_type'   => 'bar',
				'group'        => T_('Price'),
				'choice'       => true,
				'is_amount'    => true,
				'default_load' =>
					[
					],
			];

		if(\dash\url::isLocal())
		{
			$type['amount_suggestion'] =
				[
					'key'          => 'amount_suggestion',
					'title'        => T_('Amount suggestion'),
					'chart'        => false,
					'compare'      => false,
					'chart_type'   => 'bar',
					'group'        => T_('Price'),
					'is_amount'    => true,
					'choice'       => true,
					'default_load' =>
						[
						],
				];


			$type['amount_with_coefficient'] =
				[
					'key'          => 'amount_with_coefficient',
					'title'        => T_('The amount with the coefficient'),
					'chart'        => false,
					'compare'      => false,
					'chart_type'   => 'bar',
					'group'        => T_('Price'),
					'is_amount'    => true,
					'choice'       => true,
					'coefficient'  => true,
					'min'          => true,
					'max'          => true,
					'default_load' =>
						[
						],
				];
		}


		$type['hidden_amount'] =
			[
				'key'          => 'hidden_amount',
				'title'        => T_('Hidden amount'),
				'chart'        => false,
				'compare'      => false,
				'chart_type'   => 'bar',
				'group'        => T_('Price'),
				'defaultvalue' => true,
				'default_load' =>
					[
					],
			];


		return $type;
	}


}

?>