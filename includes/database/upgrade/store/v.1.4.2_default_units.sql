INSERT INTO jibres_XXXXXXX.setting
(`cat`, `key`, `value`)
SELECT
	'store_setting', 'redirect_all_domain_to_master', '1'
FROM
	jibres_XXXXXXX.setting AS `settingSelect`
WHERE
	NOT EXISTS
	(
		SELECT
			*
		FROM
			jibres_XXXXXXX.setting AS `settingSelect2`
		WHERE
			settingSelect2.cat = 'store_setting' AND
			settingSelect2.key = 'redirect_all_domain_to_master'
		LIMIT 1
	)
LIMIT 1;

INSERT INTO jibres_XXXXXXX.setting
(`cat`, `key`, `value`)
SELECT
	'store_setting', 'currency', 'IRT'
FROM
	jibres_XXXXXXX.setting AS `settingSelect`
WHERE
	NOT EXISTS
	(
		SELECT
			*
		FROM
			jibres_XXXXXXX.setting AS `settingSelect2`
		WHERE
			settingSelect2.cat = 'store_setting' AND
			settingSelect2.key = 'currency'
		LIMIT 1
	)
LIMIT 1;


INSERT INTO jibres_XXXXXXX.setting
(`cat`, `key`, `value`)
SELECT
	'store_setting', 'length_unit', 'cm'
FROM
	jibres_XXXXXXX.setting AS `settingSelect`
WHERE
	NOT EXISTS
	(
		SELECT
			*
		FROM
			jibres_XXXXXXX.setting AS `settingSelect2`
		WHERE
			settingSelect2.cat = 'store_setting' AND
			settingSelect2.key = 'length_unit'
		LIMIT 1
	)
LIMIT 1;



INSERT INTO jibres_XXXXXXX.setting
(`cat`, `key`, `value`)
SELECT
	'store_setting', 'mass_unit', 'kg'
FROM
	jibres_XXXXXXX.setting AS `settingSelect`
WHERE
	NOT EXISTS
	(
		SELECT
			*
		FROM
			jibres_XXXXXXX.setting AS `settingSelect2`
		WHERE
			settingSelect2.cat = 'store_setting' AND
			settingSelect2.key = 'mass_unit'
		LIMIT 1
	)
LIMIT 1;

