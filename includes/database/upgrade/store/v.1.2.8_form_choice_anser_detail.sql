ALTER TABLE jibres_XXXXXXX.form_answerdetail ADD `choice_id` bigint(20) UNSIGNED NULL DEFAULT null AFTER `answer`;
ALTER TABLE jibres_XXXXXXX.form_answerdetail ADD CONSTRAINT `form_answerdetail_choice_id` FOREIGN KEY (`choice_id`) REFERENCES `form_choice` (`id`) ON UPDATE CASCADE;
