<?php
namespace lib\app\tax\coding;


class edit
{

	public static function edit($_args, $_id)
	{
		$load = \lib\app\tax\coding\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$args = \lib\app\tax\coding\check::variable($_args);

		if(!$args)
		{
			return false;
		}


		$data = \dash\cleanse::patch_mode($_args, $args);

		if(isset($load['type']) && $load['type'] === 'group')
		{

		}
		else
		{
			unset($data['class']);
		}

		if(isset($load['type']) && $load['type'] === 'total')
		{

		}
		else
		{
			unset($data['topic']);
		}

		if(isset($data['title']) && $data['title'])
		{
			$check_duplicate = [];
			$check_duplicate['title'] = $data['title'];
			$check_duplicate['parent1'] = null;
			$check_duplicate['parent2'] = null;
			$check_duplicate['parent3'] = null;

			if(isset($load['parent1']) && $load['parent1'])
			{
				$check_duplicate['parent1'] = $load['parent1'];
			}


			if(isset($load['parent2']) && $load['parent2'])
			{
				$check_duplicate['parent2'] = $load['parent2'];
			}

			if(isset($load['parent3']) && $load['parent3'])
			{
				$check_duplicate['parent3'] = $load['parent3'];
			}

			$check_duplicate_title = \lib\db\tax_coding\get::check_duplicate_title($check_duplicate);
			if(isset($check_duplicate_title['id']))
			{
				if(floatval($check_duplicate_title['id']) === floatval($load['id']))
				{
					// ok. nothing
				}
				else
				{
					\dash\notif::error(T_("Duplicate title"));
					return false;
				}
			}
		}


		if(empty($data))
		{
			\dash\notif::info(T_("No change in your data"));
		}
		else
		{
			$data['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\tax_coding\update::update($data, $load['id']);

			if(isset($data['class']))
			{
				\lib\db\tax_coding\update::update_class($data['class'], $load['id']);
			}

			if(isset($data['topic']))
			{
				\lib\db\tax_coding\update::update_topic($data['topic'], $load['id']);
			}

			\dash\notif::ok(T_("Accounting coding successfully updated"));
		}

		return true;
	}

}
?>