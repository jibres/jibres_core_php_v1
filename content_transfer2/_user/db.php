<?php
namespace content_transfer\_user;

class db
{
	public static function run()
	{
		\content_transfer\say::info('Transfer users ...');
		self::transfer_user();
	}


	private static function transfer_user()
	{
		$query =
		"
			INSERT INTO jibres.users
			(
			`id`,
			`username`,
			`displayname`,
			`gender`,
			`title`,
			`password`,
			`mobile`,
			`verifymobile`,
			`email`,
			`verifyemail`,
			`status`,
			`avatar`,
			`parent`,
			`permission`,
			`type`,
			`datecreated`,
			`datemodified`,
			`pin`,
			`ref`,
			`twostep`,
			`subscribe`,
			`birthday`,
			`unit_id`,
			`language`,
			`meta`,
			`website`,
			`facebook`,
			`twitter`,
			`instagram`,
			`linkedin`,
			`gmail`,
			`sidebar`,
			`theme`,
			`firstname`,
			`lastname`,
			`bio`,
			`forceremember`,
			`signature`,
			`father`,
			`nationalcode`,
			`nationality`,
			`pasportcode`,
			`pasportdate`,
			`marital`,
			`foreign`,
			`phone`,
			`detail`
			)
			SELECT
				jibres_transfer.users.id,
				jibres_transfer.users.username,
				jibres_transfer.users.displayname,
				jibres_transfer.users.gender,
				jibres_transfer.users.title,
				jibres_transfer.users.password,
				jibres_transfer.users.mobile,
				jibres_transfer.users.verifymobile,
				jibres_transfer.users.email,
				jibres_transfer.users.verifyemail,
				jibres_transfer.users.status,
				jibres_transfer.users.avatar,
				jibres_transfer.users.parent,
				jibres_transfer.users.permission,
				jibres_transfer.users.type,
				jibres_transfer.users.datecreated,
				jibres_transfer.users.datemodified,
				jibres_transfer.users.pin,
				jibres_transfer.users.ref,
				jibres_transfer.users.twostep,
				NULL,
				jibres_transfer.users.birthday,
				jibres_transfer.users.unit_id,
				jibres_transfer.users.language,
				jibres_transfer.users.meta,
				jibres_transfer.users.website,
				jibres_transfer.users.facebook,
				jibres_transfer.users.twitter,
				jibres_transfer.users.instagram,
				jibres_transfer.users.linkedin,
				jibres_transfer.users.gmail,
				jibres_transfer.users.sidebar,
				jibres_transfer.users.theme,
				jibres_transfer.users.firstname,
				jibres_transfer.users.lastname,
				jibres_transfer.users.bio,
				jibres_transfer.users.forceremember,
				jibres_transfer.users.signature,
				jibres_transfer.users.father,
				jibres_transfer.users.nationalcode,
				jibres_transfer.users.nationality,
				jibres_transfer.users.pasportcode,
				jibres_transfer.users.pasportdate,
				jibres_transfer.users.marital,
				jibres_transfer.users.foreign,
				jibres_transfer.users.phone,
				jibres_transfer.users.detail
			FROM
				jibres_transfer.users
			WHERE 1
		";

		$result = \dash\db::query($query,'local', ['database' => 'jibres']);

	}


}
?>