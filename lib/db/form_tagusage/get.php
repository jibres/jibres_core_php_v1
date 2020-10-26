<?php
namespace lib\db\form_tagusage;


class get
{

	public static function usage_public($_answer_id)
	{
		if(!$_answer_id)
		{
			return false;
		}

		$query =
		"
			SELECT
				form_tag.id AS `form_tag_id`,
				form_tag.title,
				form_tag.slug,
				form_tag.desc,
				form_tag.color
			FROM
				form_tagusage
			INNER JOIN form_tag ON form_tag.id = form_tagusage.form_tag_id
			WHERE
				form_tag.privacy = 'public' AND
				form_tagusage.answer_id = $_answer_id
		";
		$result = \dash\db::get($query);

		return $result;
	}


	public static function usage($_answer_id)
	{
		if(!$_answer_id)
		{
			return false;
		}

		$query =
		"
			SELECT
				form_tag.id AS `form_tag_id`,
				form_tag.title,
				form_tag.slug,
				form_tag.desc


			FROM
				form_tagusage
			INNER JOIN form_tag ON form_tag.id = form_tagusage.form_tag_id
			WHERE
				form_tagusage.answer_id = $_answer_id
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_usage_tag($_tag_id)
	{
		$query  = "SELECT * FROM form_tagusage WHERE form_tagusage.form_tag_id = $_tag_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


		public static function check_product_have_tag($_answer_id, $_tag_id)
	{
		$query  = "SELECT * FROM form_tagusage WHERE form_tagusage.form_tag_id = $_tag_id AND form_tagusage.answer_id = $_answer_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;

	}


}
?>
