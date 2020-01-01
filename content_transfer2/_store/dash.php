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

		\content_transfer\say::info('Transfer jibres transactions ...');
		self::transactions();

		\content_transfer\say::info('Transfer jibres user_telegram ...');
		self::user_telegram();

	}


	private static function user_telegram()
	{
		$query =
		"
			INSERT INTO jibres.user_telegram
			(

				`id`,
				`user_id`,
				`chatid`,
				`firstname`,
				`lastname`,
				`username`,
				`language`,
				`status`,
				`lastupdate`,
				`datecreated`


			)
			SELECT
				jibres_transfer.user_telegram.id,
				jibres_transfer.user_telegram.user_id,
				jibres_transfer.user_telegram.chatid,
				jibres_transfer.user_telegram.firstname,
				jibres_transfer.user_telegram.lastname,
				jibres_transfer.user_telegram.username,
				jibres_transfer.user_telegram.language,
				jibres_transfer.user_telegram.status,
				jibres_transfer.user_telegram.lastupdate,
				jibres_transfer.user_telegram.datecreated
			FROM
				jibres_transfer.user_telegram
			WHERE 1
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);


	}




	private static function transactions()
	{
		$query =
		"
			INSERT INTO jibres.transactions
			(
				`id`,
				`user_id`,
				`code`,
				`title`,
				`caller`,
				`type`,
				`unit_id`,
				`amount_request`,
				`amount_end`,
				`plus`,
				`minus`,
				`budget_before`,
				`budget`,
				`status`,
				`condition`,
				`verify`,
				`parent_id`,
				`related_user_id`,
				`related_foreign`,
				`related_id`,
				`payment`,
				`payment_response`,
				`meta`,
				`desc`,
				`datecreated`,
				`datemodified`,
				`invoice_id`,
				`date`,
				`dateverify`,
				`payment_response1`,
				`payment_response2`,
				`payment_response3`,
				`payment_response4`,
				`token`,
				`banktoken`,
				`finalmsg`


			)
			SELECT
				jibres_transfer.transactions.id,
				jibres_transfer.transactions.user_id,
				jibres_transfer.transactions.code,
				jibres_transfer.transactions.title,
				jibres_transfer.transactions.caller,
				jibres_transfer.transactions.type,
				jibres_transfer.transactions.unit_id,
				jibres_transfer.transactions.amount_request,
				jibres_transfer.transactions.amount_end,
				jibres_transfer.transactions.plus,
				jibres_transfer.transactions.minus,
				jibres_transfer.transactions.budget_before,
				jibres_transfer.transactions.budget,
				jibres_transfer.transactions.status,
				jibres_transfer.transactions.condition,
				jibres_transfer.transactions.verify,
				jibres_transfer.transactions.parent_id,
				jibres_transfer.transactions.related_user_id,
				jibres_transfer.transactions.related_foreign,
				jibres_transfer.transactions.related_id,
				jibres_transfer.transactions.payment,
				jibres_transfer.transactions.payment_response,
				jibres_transfer.transactions.meta,
				jibres_transfer.transactions.desc,
				jibres_transfer.transactions.datecreated,
				jibres_transfer.transactions.datemodified,
				jibres_transfer.transactions.invoice_id,
				jibres_transfer.transactions.date,
				jibres_transfer.transactions.dateverify,
				jibres_transfer.transactions.payment_response1,
				jibres_transfer.transactions.payment_response2,
				jibres_transfer.transactions.payment_response3,
				jibres_transfer.transactions.payment_response4,
				jibres_transfer.transactions.token,
				jibres_transfer.transactions.banktoken,
				jibres_transfer.transactions.finalmsg
			FROM
				jibres_transfer.transactions
			WHERE 1
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);


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