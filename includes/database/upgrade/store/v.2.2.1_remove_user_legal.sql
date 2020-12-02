ALTER TABLE jibres_XXXXXXX.users ADD `accounttype` enum('personal', 'legal') NULL DEFAULT 'personal' AFTER `status`;

ALTER TABLE jibres_XXXXXXX.users ADD `companyname` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.users ADD `companyeconomiccode` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.users ADD `companynationalid` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.users ADD `companyregisternumber` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL;


UPDATE jibres_XXXXXXX.users SET users.companyname           = (SELECT userlegal.companyname FROM jibres_XXXXXXX.userlegal WHERE userlegal.user_id = users.id LIMIT 1);
UPDATE jibres_XXXXXXX.users SET users.companyeconomiccode   = (SELECT userlegal.companyeconomiccode FROM jibres_XXXXXXX.userlegal WHERE userlegal.user_id = users.id LIMIT 1);
UPDATE jibres_XXXXXXX.users SET users.companynationalid     = (SELECT userlegal.companynationalid FROM jibres_XXXXXXX.userlegal WHERE userlegal.user_id = users.id LIMIT 1);
UPDATE jibres_XXXXXXX.users SET users.companyregisternumber = (SELECT userlegal.companyregisternumber FROM jibres_XXXXXXX.userlegal WHERE userlegal.user_id = users.id LIMIT 1);
UPDATE jibres_XXXXXXX.users SET users.nationalcode          = (SELECT userlegal.ceonationalcode FROM jibres_XXXXXXX.userlegal WHERE userlegal.user_id = users.id LIMIT 1);
UPDATE jibres_XXXXXXX.users SET users.website               = (SELECT userlegal.url FROM jibres_XXXXXXX.userlegal WHERE userlegal.user_id = users.id LIMIT 1);

INSERT INTO jibres_XXXXXXX.address
(
  `user_id`,
  `company`,
  `companyname`,
  `country`,
  `province`,
  `city`,
  `address`,
  `address2`,
  `postcode`,
  `phone`,
  `mobile`,
  `fax`,
  `status`,
  `datecreated`
)
SELECT
userlegal.user_id,
1,
userlegal.companyname,
userlegal.country,
userlegal.province,
userlegal.city,
userlegal.address,
userlegal.address2,
userlegal.postcode,
userlegal.phone,
userlegal.mobile,
userlegal.fax,
'enable',
userlegal.datecreated
FROM jibres_XXXXXXX.userlegal;



DROP TABLE jibres_XXXXXXX.userlegal;
