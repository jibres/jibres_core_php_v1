INSERT INTO userstores
(
	`store_id`,
	`user_id`,
	`permission`,
	`firstname`,
	`lastname`,
	`displayname`,
	`mobile`,
	`gender`,
	`staff`,
	`status`
)
SELECT
stores.id,
stores.creator,
'admin',
users.firstname,
users.lastname,
users.displayname,
users.mobile,
users.gender,
1,
'active'
FROM
stores
INNER JOIN users ON users.id = stores.creator
WHERE stores.id NOT IN (SELECT sT.store_id FROM userstores AS `sT`);