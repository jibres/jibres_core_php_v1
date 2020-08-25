<?php
namespace lib\db\form;


class insert
{
	public static function duplicate($_old_id, $_title)
	{
		$date = date("Y-m-d H:i:s");
		$new_form =
		"
			INSERT INTO form
			(
				`id`,
				`user_id`,
				`title`,
				`slug`,
				`lang`,
				`password`,
				`privacy`,
				`status`,
				`redirect`,
				`desc`,
				`setting`,
				`starttime`,
				`endtime`,
				`datecreated`,
				`datemodified`,
				`endmessage`,
				`file`
			)
			SELECT
				NULL,
				form.user_id,
				'$_title',
				form.slug,
				form.lang,
				form.password,
				form.privacy,
				form.status,
				form.redirect,
				form.desc,
				form.setting,
				form.starttime,
				form.endtime,
				'$date',
				NULL,
				form.endmessage,
				form.file
			FROM
				form
			WHERE form.id = $_old_id
			LIMIT 1
		";

		if(\dash\db::query($new_form))
		{
			$new_form_id = \dash\db::insert_id();
			if($new_form_id)
			{
				$new_form_item =
				"
					INSERT INTO form_item
					(
						`form_id`,
						`title`,
						`desc`,
						`require`,
						`type`,
						`file`,
						`maxlen`,
						`sort`,
						`setting`,
						`choice`,
						`status`,
						`datecreated`
					)
					SELECT
						$new_form_id,
						form_item.title,
						form_item.desc,
						form_item.require,
						form_item.type,
						form_item.file,
						form_item.maxlen,
						form_item.sort,
						form_item.setting,
						form_item.choice,
						form_item.status,
						'$date'
					FROM
						form_item
					WHERE form_item.form_id = $_old_id
				";
				\dash\db::query($new_form_item);
				return $new_form_id;
			}
		}

		return false;
	}


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function new_record($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `form` SET $set ";
			if(\dash\db::query($query))
			{
				return \dash\db::insert_id();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

}
?>
