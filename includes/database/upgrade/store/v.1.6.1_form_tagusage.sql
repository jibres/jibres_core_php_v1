
ALTER TABLE jibres_XXXXXXX.form_tagusage ADD CONSTRAINT `unique_tag_form_answer` UNIQUE (`form_id`, `form_tag_id`, `answer_id`);
ALTER TABLE jibres_XXXXXXX.form_tagusage ADD INDEX `check_unique_tag_form_answer` (`form_id`, `form_tag_id`, `answer_id`);


ALTER TABLE jibres_XXXXXXX.form ADD `inquiry` BIT(1) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.form ADD `inquirymsg` text NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.form ADD `inquirysetting` text NULL DEFAULT NULL;


