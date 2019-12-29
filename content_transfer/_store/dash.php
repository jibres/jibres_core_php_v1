<?php
namespace content_transfer\_store;

class dash
{
	public static function run()
	{
		\content_transfer\say::info('Transfer jibres posts ...');
		self::posts();

		\content_transfer\say::info('Transfer jibres terms ...');
		self::terms();

		\content_transfer\say::info('Transfer jibres termusage ...');
		self::termusage();

		\content_transfer\say::info('Transfer jibres ticket ...');
		self::ticket();

		j('end');
	}

	private static function ticket()
	{
		$query =
		"
			INSERT INTO jibres.tickets
			(
				`id`,
				`user_id`,
				`title`,
				`content`,
				`meta`,
				`status`,
				`parent`,
				`type`,
				`ip`,
				`file`,
				`plus`,
				`answertime`,
				`solved`,
				`via`,
				`see`,
				`datemodified`,
				`datecreated`
			)
			SELECT
				jibres_transfer.tickets.id,
				jibres_transfer.tickets.user_id,
				jibres_transfer.tickets.title,
				jibres_transfer.tickets.content,
				jibres_transfer.tickets.meta,
				jibres_transfer.tickets.status,
				jibres_transfer.tickets.parent,
				jibres_transfer.tickets.type,
				jibres_transfer.tickets.ip,
				jibres_transfer.tickets.file,
				jibres_transfer.tickets.plus,
				jibres_transfer.tickets.answertime,
				jibres_transfer.tickets.solved,
				jibres_transfer.tickets.via,
				jibres_transfer.tickets.see,
				jibres_transfer.tickets.datemodified,
				jibres_transfer.tickets.datecreated
			FROM
				jibres_transfer.tickets
			WHERE 1
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);


	}

	private static function termusage()
	{
		if(\dash\db::get("SELECT * FROM termusages", null, true, 'local', ['database' => 'jibres']))
		{
			\content_transfer\say::info('Table termusages is not empty. Transfer of termusages skipped ...');
			return;
		}

		$query =
		"
			INSERT INTO jibres.termusages
			(
				`term_id`,
				`related_id`,
				`related`,
				`order`,
				`status`,
				`datecreated`,
				`datemodified`,
				`type`

			)
			SELECT
				jibres_transfer.termusages.term_id,
				jibres_transfer.termusages.related_id,
				jibres_transfer.termusages.related,
				jibres_transfer.termusages.order,
				jibres_transfer.termusages.status,
				jibres_transfer.termusages.datecreated,
				jibres_transfer.termusages.datemodified,
				jibres_transfer.termusages.type

			FROM
				jibres_transfer.termusages
			WHERE 1
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);


	}

	private static function terms()
	{
		$query =
		"
			INSERT INTO jibres.terms
			(
				`id`,
				`language`,
				`type`,
				`caller`,
				`title`,
				`slug`,
				`url`,
				`desc`,
				`meta`,
				`parent`,
				`user_id`,
				`status`,
				`datecreated`,
				`datemodified`
			)
			SELECT
				jibres_transfer.terms.id,
				jibres_transfer.terms.language,
				jibres_transfer.terms.type,
				jibres_transfer.terms.caller,
				jibres_transfer.terms.title,
				jibres_transfer.terms.slug,
				jibres_transfer.terms.url,
				jibres_transfer.terms.desc,
				jibres_transfer.terms.meta,
				jibres_transfer.terms.parent,
				jibres_transfer.terms.user_id,
				jibres_transfer.terms.status,
				jibres_transfer.terms.datecreated,
				jibres_transfer.terms.datemodified
			FROM
				jibres_transfer.terms
			WHERE 1
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);


	}

	private static function posts()
	{
		$query =
		"
			INSERT INTO jibres.posts
			(
				`id`,
				`language`,
				`title`,
				`seotitle`,
				`slug`,
				`url`,
				`content`,
				`subtitle`,
				`excerpt`,
				`meta`,
				`type`,
				`subtype`,
				`special`,
				`comment`,
				`status`,
				`parent`,
				`user_id`,
				`publishdate`,
				`datemodified`,
				`datecreated`
			)
			SELECT
				jibres_transfer.posts.id,
				jibres_transfer.posts.language,
				jibres_transfer.posts.title,
				jibres_transfer.posts.seotitle,
				jibres_transfer.posts.slug,
				jibres_transfer.posts.url,
				jibres_transfer.posts.content,
				jibres_transfer.posts.subtitle,
				jibres_transfer.posts.excerpt,
				jibres_transfer.posts.meta,
				jibres_transfer.posts.type,
				jibres_transfer.posts.subtype,
				jibres_transfer.posts.special,
				jibres_transfer.posts.comment,
				jibres_transfer.posts.status,
				jibres_transfer.posts.parent,
				jibres_transfer.posts.user_id,
				jibres_transfer.posts.publishdate,
				jibres_transfer.posts.datemodified,
				jibres_transfer.posts.datecreated
			FROM
				jibres_transfer.posts
			WHERE posts.type != 'attachment'
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);


	}
}
?>