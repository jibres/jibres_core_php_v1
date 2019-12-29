<?php
namespace content_transfer\_store;

class dash
{
	public static function run()
	{
		\content_transfer\say::info('Transfer jibres posts ...');
		self::posts();

		j('end');
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