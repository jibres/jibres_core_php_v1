INSERT INTO jibres_XXXXXXX.setting
(`cat`, `key`, `value`)
SELECT
	'product_setting', 'comment', '1'
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
			settingSelect2.cat = 'product_setting' AND
			settingSelect2.key = 'comment'
		LIMIT 1
	)
LIMIT 1;