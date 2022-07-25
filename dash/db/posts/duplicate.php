<?php
namespace dash\db\posts;


class duplicate
{


	public static function make_duplicate_pagebuilder($_new_id, $_old_id)
	{
		$set = [];

		$get_thumb = \dash\pdo::get("SELECT thumb FROM posts WHERE id = :old_id LIMIT 1", [':old_id' => $_old_id], 'thumb', true);
		if($get_thumb)
		{
			$set['thumb'] = $get_thumb;
		}

		$get_gallery = \dash\pdo::get("SELECT gallery FROM posts WHERE id = :old_id LIMIT 1", [':old_id' => $_old_id], 'gallery', true);
		if($get_gallery)
		{
			$set['gallery'] = $get_gallery;
		}

		if($set)
		{
			$q     = \dash\pdo\prepare_query::generate_set('posts', $set);

			$query = "UPDATE posts  SET $q[set] WHERE posts.id = :new_id LIMIT 1";

			$param = array_merge($q['param'], [':new_id' => $_new_id]);

			\dash\pdo::query($query, $param);
		}

		$pagebuilder_list_query = "SELECT * FROM pagebuilder WHERE pagebuilder.related_id = :related_id AND pagebuilder.related = 'posts' ";

		$pagebuilder_list = \dash\pdo::get($pagebuilder_list_query, [':related_id' => $_old_id]);

		if(!is_array($pagebuilder_list))
		{
			$pagebuilder_list = [];
		}

		foreach ($pagebuilder_list as $key => $pagebuilder)
		{
			$new_pagebuilder_id = self::duplicate_record_from_pagebuilder($pagebuilder['id'], $_new_id);

			if(!$new_pagebuilder_id)
			{
				return false;
			}

			// check have menu

			$have_menu_first_level_query =
			"
				SELECT
					menu.*
				FROM
					menu
				WHERE
					menu.for = :for AND
					menu.for_id = :old_for_id AND
					menu.parent1 IS NULL AND
					menu.parent2 IS NULL AND
					menu.parent3 IS NULL AND
					menu.parent4 IS NULL AND
					menu.parent5 IS NULL
				LIMIT 1
			";

			$have_menu_first_level = \dash\pdo::get($have_menu_first_level_query, [':old_for_id' => $pagebuilder['id'], ':for' => $pagebuilder['section']], null, true);

			if(!is_array($have_menu_first_level))
			{
				$have_menu_first_level = [];
			}

			if($have_menu_first_level)
			{
				$new_menu_first_level_id = self::duplicate_record_from_menu($have_menu_first_level['id'], $new_pagebuilder_id);

				if(!$new_menu_first_level_id)
				{
					return false;
				}

				// check menu child
				// level 1
				$have_menu_level_1_query =
				"
					SELECT
						menu.*
					FROM
						menu
					WHERE
						menu.for = :for AND
						menu.for_id = :old_for_id AND
						menu.parent1 = :old_first_level_id AND
						menu.parent2 IS NULL AND
						menu.parent3 IS NULL AND
						menu.parent4 IS NULL AND
						menu.parent5 IS NULL
				";

				$have_menu_level_1 = \dash\pdo::get($have_menu_level_1_query, [':old_for_id' => $pagebuilder['id'], ':for' => $pagebuilder['section'], ':old_first_level_id' => $have_menu_first_level['id']]);

				if(!is_array($have_menu_level_1))
				{
					$have_menu_level_1 = [];
				}

				if($have_menu_level_1)
				{
					foreach ($have_menu_level_1 as $level_1_menu)
					{
						$new_level_1_id = self::duplicate_record_from_menu_child($level_1_menu['id'], $new_pagebuilder_id, $new_menu_first_level_id);
					}
				}

				// needless to check level 2, 3, 4, 5
				// in sitebuilder only use one level of gallery
			}
		}

		return true;
	}




	private static function duplicate_record_from_menu_child($_old_id, $_new_related_id, $_new_parent_1)
	{
		$now = date("Y-m-d H:i:s");

		$query =
		"
			INSERT INTO menu
			(
				`title`,
				`url`,
				`pointer`,
				`related_id`,
				`socialnetwork`,
				`sort`,
				`target`,
				`parent1`,
				`parent2`,
				`parent3`,
				`parent4`,
				`parent5`,
				`description`,
				`file`,
				`preview`,
				`body`,
				`for`,
				`for_id`,
				`datecreated`,
				`datemodified`
			)
			SELECT
				menu.title,
				menu.url,
				menu.pointer,
				menu.related_id,
				menu.socialnetwork,
				menu.sort,
				menu.target,
				$_new_parent_1,
				menu.parent2,
				menu.parent3,
				menu.parent4,
				menu.parent5,
				menu.description,
				menu.file,
				menu.preview,
				menu.body,
				menu.for,
				$_new_related_id,
				'$now',
				null
			FROM
				`menu`
			WHERE
				menu.id         = $_old_id
			LIMIT 1
		";

		\dash\pdo::query($query, []);

		return \dash\pdo::insert_id();
	}

	private static function duplicate_record_from_menu($_old_id, $_new_related_id)
	{
		$now = date("Y-m-d H:i:s");

		$query =
		"
			INSERT INTO menu
			(
				`title`,
				`url`,
				`pointer`,
				`related_id`,
				`socialnetwork`,
				`sort`,
				`target`,
				`parent1`,
				`parent2`,
				`parent3`,
				`parent4`,
				`parent5`,
				`description`,
				`file`,
				`preview`,
				`body`,
				`for`,
				`for_id`,
				`datecreated`,
				`datemodified`
			)
			SELECT
				menu.title,
				menu.url,
				menu.pointer,
				menu.related_id,
				menu.socialnetwork,
				menu.sort,
				menu.target,
				menu.parent1,
				menu.parent2,
				menu.parent3,
				menu.parent4,
				menu.parent5,
				menu.description,
				menu.file,
				menu.preview,
				menu.body,
				menu.for,
				$_new_related_id,
				'$now',
				null
			FROM
				`menu`
			WHERE
				menu.id         = $_old_id
			LIMIT 1
		";

		\dash\pdo::query($query, []);

		return \dash\pdo::insert_id();
	}


	private static function duplicate_record_from_pagebuilder($_old_id, $_new_related_id)
	{
		$now = date("Y-m-d H:i:s");

		$query =
		"
			INSERT INTO pagebuilder
			(
				`mode`,
				`folder`,
				`section`,
				`model`,
				`preview_key`,
				`related`,
				`related_id`,
				`duplicate`,
				`title`,
				`preview`,
				`body`,
				`titlesetting`,
				`background`,
				`avand`,
				`margin`,
				`padding`,
				`radius`,
				`ratio`,
				`meta`,
				`sort`,
				`sort_preview`,
				`status`,
				`status_preview`,
				`ifloginshow`,
				`ifpermissionshow`,
				`type`,
				`puzzle`,
				`infoposition`,
				`effect`,
				`detail`,
				`text`,
				`text_preview`,
				`datecreated`,
				`datemodified`,
				`device`,
				`mobile`,
				`os`
			)
			SELECT
				pagebuilder.mode,
				pagebuilder.folder,
				pagebuilder.section,
				pagebuilder.model,
				pagebuilder.preview_key,
				pagebuilder.related,
				$_new_related_id,
				pagebuilder.duplicate,
				pagebuilder.title,
				pagebuilder.preview,
				pagebuilder.body,
				pagebuilder.titlesetting,
				pagebuilder.background,
				pagebuilder.avand,
				pagebuilder.margin,
				pagebuilder.padding,
				pagebuilder.radius,
				pagebuilder.ratio,
				pagebuilder.meta,
				pagebuilder.sort,
				pagebuilder.sort_preview,
				pagebuilder.status,
				pagebuilder.status_preview,
				pagebuilder.ifloginshow,
				pagebuilder.ifpermissionshow,
				pagebuilder.type,
				pagebuilder.puzzle,
				pagebuilder.infoposition,
				pagebuilder.effect,
				pagebuilder.detail,
				pagebuilder.text,
				pagebuilder.text_preview,
				'$now', /* date created*/
				NULL, /* date modified*/
				pagebuilder.device,
				pagebuilder.mobile,
				pagebuilder.os
			FROM
				`pagebuilder`
			WHERE
				pagebuilder.id         = $_old_id
			LIMIT 1
		";

		\dash\pdo::query($query, []);

		return \dash\pdo::insert_id();
	}

}
?>
