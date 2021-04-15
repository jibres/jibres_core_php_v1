<?php
namespace lib\app\pagebuilder\line;


class add
{
	public static function list($_args = [])
	{
		$list = [];

		$list[] = \lib\app\pagebuilder\elements\news::detail();

		return $list;
	}



	public static function add($_element)
	{
		$element = \lib\app\pagebuilder\line\get::check_element($_element);

		if(!$element)
		{
			\dash\notif::error(T_("Invalid detail!"));
			return false;
		}

		$insert                     = [];
		$insert['mode']             = a($element, 'mode');
		$insert['type']             = a($element, 'key');

		$insert['platform']         = 'website';

		$insert['related']          = 'homepage';
		$insert['related_id']       = null;

		$insert['title']            = self::get_suggested_name($element);
		$insert['titlesetting']     = null;
		$insert['background']       = null;
		$insert['avand']            = null;
		$insert['margin']           = null;
		$insert['padding']          = null;
		$insert['radius']           = null;
		$insert['meta']             = null;
		$insert['sort']             = null;
		$insert['status']           = 'draft';
		$insert['ifloginshow']      = null;
		$insert['ifpermissionshow'] = null;

		$insert['puzzle']           = null;
		$insert['infoposition']     = null;
		$insert['detail']           = null;
		$insert['text']             = null;
		$insert['datecreated']      = date("Y-m-d H:i:s");
		$insert['datemodified']     = null;

		$id = \lib\db\pagebuilder\insert::new_record($insert);

		if(!$id)
		{
			\dash\notif::error(T_("No way to save data"));
			return false;
		}

		$add_msg = T_("Data successfully added");

		if(!a($element, 'add_msg'))
		{
			$add_msg = a($element, 'add_msg');
		}

		\dash\notif::ok($add_msg);

		$result        = [];
		$result['id']  = $id;
		$result['url'] = \dash\url::this(). '/'. $insert['type']. '?id='. $id;


		return $result;

	}



	private static function get_suggested_name($_element)
	{
		if(isset($_element['key']) && isset($_element['title']))
		{
			$suggested_name = $_element['title'];

			$count = \lib\db\pagebuilder\get::count_by_type($_element['key']);

			if(is_numeric($count))
			{
				$count = intval($count) + 1;
			}
			else
			{
				$count = 1;
			}
		}
		else
		{
			$suggested_name = T_("New line");
			$count          = \dash\fit::number(rand(1, 99));
		}

		return $suggested_name. ' '. \dash\fit::text($count);
	}

}
?>