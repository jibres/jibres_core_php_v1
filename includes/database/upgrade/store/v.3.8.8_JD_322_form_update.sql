ALTER TABLE jibres_XXXXXXX.form
	CHANGE `privacy` `privacy` enum ('public', 'private', 'protected') NULL DEFAULT NULL;

ALTER TABLE jibres_XXXXXXX.form_answer
	ADD `randomitem` text NULL DEFAULT NULL;

ALTER TABLE jibres_XXXXXXX.form_answer
	ADD `totalscore` int NULL DEFAULT NULL;


