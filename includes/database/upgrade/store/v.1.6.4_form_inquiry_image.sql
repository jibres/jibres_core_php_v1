ALTER TABLE jibres_XXXXXXX.form ADD `inquiryimage` text NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.form_tag CHANGE `privacy` `privacy` 	enum('public', 'private') NULL DEFAULT 'private';
