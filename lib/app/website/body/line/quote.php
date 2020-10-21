<?php
namespace lib\app\website\body\line;

class quote
{

	public static function suggest_new_name()
	{
		$count_quote = \lib\db\setting\get::count_platform_cat_key('website', 'homepage', 'body_line_quote');
		$count_quote = intval($count_quote) + 1;

		return T_("Quote"). ' '. \dash\fit::number($count_quote);
	}


	public static function get($_id)
	{
		$result = \lib\app\website\body\get::line_setting($_id);

		if(isset($result['type']) && $result['type'] === 'quote')
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("This is not a quote"));
			return false;
		}

		if(isset($result['quote']) && is_array($result['quote']))
		{
			$result['quote'] = array_map(['self', 'ready'], $result['quote']);
		}


		return $result;
	}






	public static function default_style($_needle = null)
	{
		$default =
		[
			'ratio' => 'professional',
			'title' => T_("Professional (Default)"),
		];

		if($_needle)
		{
			if(isset($default[$_needle]))
			{
				return $default[$_needle];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $default;
		}
	}


	public static function ready($_data)
	{
		$result = [];

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'image':
					if(isset($value))
					{
						$result[$key] = \lib\filepath::fix($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}



	public static function inline_get($_line_id, $_pretty = true)
	{
		if(!$_line_id || !is_numeric($_line_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$saved_record = \lib\db\setting\get::platform_cat_id('website', 'homepage', $_line_id);

		if(!$saved_record)
		{
			\dash\notif::error(T_("Line detail not found"));
			return false;
		}

		$saved_option = [];

		if(isset($saved_record['value']))
		{
			$saved_option = json_decode($saved_record['value'], true);
		}

		if(!is_array($saved_option))
		{
			$saved_option = [];
		}

		return $saved_option;
	}


	private static function check_validate($_args)
	{
		$condition =
		[
			'image'       => 'bit',
			'displayname' => 'string_50',
			'job'         => 'string_50',
			'text'        => 'string_300',
			'star'        => 'star',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['star'])
		{
			$data['star'] = (5 - intval($data['star'])) + 1;
		}

		return $data;
	}


	// add new quote
	public static function add($_args)
	{
		$data = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		if(!$data['text'])
		{
			\dash\notif::error(T_("Please set the quote"), 'text');
			return false;
		}

		$image_path = null;

		if($data['image'])
		{
			$image_path = \dash\upload\website::upload_image('image');

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		if(!$image_path)
		{
			\dash\notif::error(T_("Please upload an image file"), 'image');
			return false;
		}

		$line_id = \lib\app\website\body\add::line('quote');

		$saved_option = self::inline_get($line_id);

		$saved_option['quote'] = [];

		$saved_option['quote'][] =
		[
			'image'       => $image_path,
			'displayname' => $data['displayname'],
			'text'        => $data['text'],
			'star'        => $data['star'],
			'job'         => $data['job'],
		];


		$saved_option = json_encode($saved_option, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_option, $line_id);

		\dash\notif::ok(T_("Quote added"));

		// retrun id to redirect to this quote
		return ['id' => \dash\coding::encode($line_id)];
	}


	public static function remove($_line_id, $_quote_index)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			return false;
		}
		if(!is_numeric($_quote_index))
		{
			\dash\notif::error(T_("Quote index must be a number"));
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['quote']))
		{
			return false;
		}

		$saved_quote = $saved_value['quote'];


		if(!array_key_exists($_quote_index, $saved_quote))
		{
			\dash\notif::error(T_("Invalid quote index"));
			return false;
		}

		unset($saved_quote[$_quote_index]);

		$saved_quote = array_values($saved_quote);

		$saved_value['quote'] = $saved_quote;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Quote was removed"));

		return true;
	}


	public static function set_sort($_line_id, $_quote_sort)
	{
		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if(!$_quote_sort || !is_array($_quote_sort))
		{
			\dash\notif::error(T_("Invalid sort detail"));
			return false;
		}

		$quote_sort = [];

		foreach ($_quote_sort as $key => $value)
		{
			if(!is_numeric($value))
			{
				\dash\notif::error(T_("Invalid sort index"));
				return false;
			}

			$quote_sort[] = intval($value);
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['quote']))
		{
			\dash\notif::error(T_("Quote detail not found"));
			return false;
		}

		$saved_quote = $saved_value['quote'];

		foreach ($quote_sort as $new_index => $old_index)
		{
			if(!array_key_exists($old_index, $saved_quote))
			{
				\dash\redirect::pwd();
				return false;
			}

			$saved_quote[$old_index]['sort'] = $new_index;
		}


		$sort_column = array_column($saved_quote, 'sort');

		if(count($sort_column) !== count($_quote_sort))
		{
			\dash\redirect::pwd();
			return;
		}

		$my_sorted_list = $saved_quote;

		array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

		$saved_quote = $my_sorted_list;

		$saved_quote = array_values($saved_quote);

		$saved_value['quote'] = $saved_quote;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Sorted"));
		return true;

	}


	public static function edit($_args, $_line_id, $_quote_index = null)
	{
		$data      = self::check_validate($_args);

		if(!$data)
		{
			return false;
		}

		$line_option = \lib\app\website\body\template::get('quote');

		if(!isset($line_option['key']))
		{
			\dash\notif::error(T_("Line detail not found"));
			return false;
		}

		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);

		if(!$line_id)
		{
			return false;
		}

		$saved_value = self::inline_get($line_id);

		if(!$saved_value || !isset($saved_value['quote']))
		{
			return false;
		}

		$saved_quote = $saved_value['quote'];

		$edit_index_mode = false;

		$image_path = null;

		if($data['image'])
		{
			$image_path = \dash\upload\website::upload_image('image');

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}

		if(is_numeric($_quote_index))
		{
			if(!array_key_exists($_quote_index, $saved_quote))
			{
				\dash\notif::error(T_("Quote index not found"));
				return false;
			}

			$edit_index_mode = true;

			if(!$image_path)
			{
				$image_path = isset($saved_quote[$_quote_index]['image']) ? $saved_quote[$_quote_index]['image'] : null;
			}
		}

		if(!$image_path)
		{
			\dash\notif::error(T_("Please upload an image file"), 'image');
			return false;
		}

		if(!$data['text'])
		{
			\dash\notif::error(T_("Please set quote"), 'text');
			return false;
		}


		$ready_to_save =
		[
			'image'  => $image_path,
				'displayname' => $data['displayname'],
			'text'        => $data['text'],
			'star'        => $data['star'],
			'job'         => $data['job'],
		];

		if($edit_index_mode)
		{
			$saved_quote[$_quote_index] = $ready_to_save;
			\dash\notif::ok(T_("Page quote edited"));
		}
		else
		{

			$saved_quote[] = $ready_to_save;

			if(isset($line_option['max_capacity']) && is_numeric($line_option['max_capacity']))
			{
				if(count($saved_quote) > intval($line_option['max_capacity']))
				{
					\dash\notif::error(T_("Maximum capacity of this quote is full"));
					return false;
				}
			}

			\dash\notif::ok(T_("Quote added"));
		}

		$sort_column = array_column($saved_quote, 'sort');

		if(count($sort_column) === count($saved_quote))
		{
			$my_sorted_list = $saved_quote;

			array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

			$saved_quote = $my_sorted_list;
		}

		$saved_quote = array_values($saved_quote);

		$saved_value['quote'] = $saved_quote;

		$saved_value = json_encode($saved_value, JSON_UNESCAPED_UNICODE);

		$save = \lib\db\setting\update::value($saved_value, $line_id);

		\lib\app\website\generator::remove_catch();

		return true;
	}
}
?>