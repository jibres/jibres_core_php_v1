INSERT INTO jibres.useremail

(`user_id`, `email`, `status`)

SELECT
	jibres.users.id,
	jibres.users.email,
	'enable'
FROM
	jibres.users
WHERE
	jibres.users.email IS NOT NULL AND
	NOT EXISTS
	(
		SELECT jibres.useremail.email FROM jibres.useremail WHERE useremail.email = jibres.users.email
	);
