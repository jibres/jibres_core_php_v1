ALTER TABLE jibres.apilog ADD `ip_id` BIGINT UNSIGNED NULL;
ALTER TABLE jibres.apilog ADD `agent_id` INT UNSIGNED NULL;

ALTER TABLE jibres.csrf ADD `ip_id` BIGINT UNSIGNED NULL;
ALTER TABLE jibres.csrf ADD `agent_id` INT UNSIGNED NULL;

ALTER TABLE jibres.email_log CHANGE `ip_id` `ip_id` BIGINT UNSIGNED NULL;

ALTER TABLE jibres.files ADD `ip_id` BIGINT UNSIGNED NULL AFTER `ip`;
ALTER TABLE jibres.files ADD `agent_id` INT UNSIGNED NULL;

ALTER TABLE jibres.login CHANGE `ip_id` `ip_id` BIGINT UNSIGNED NULL;
ALTER TABLE jibres.login_ip CHANGE `ip_id` `ip_id` BIGINT UNSIGNED NULL;

ALTER TABLE jibres.logs ADD `ip_id` BIGINT UNSIGNED NULL AFTER `ip`;
ALTER TABLE jibres.logs ADD `agent_id` INT UNSIGNED NULL AFTER `ip_id`;

ALTER TABLE jibres.sms_log CHANGE `ip_id` `ip_id` BIGINT UNSIGNED NULL;

ALTER TABLE jibres.tickets ADD `ip_id` BIGINT UNSIGNED NULL AFTER `ip`;

ALTER TABLE jibres.transactions ADD `ip_id` BIGINT UNSIGNED NULL;
ALTER TABLE jibres.transactions ADD `agent_id` INT UNSIGNED NULL;


ALTER TABLE jibres.giftusage ADD `ip_id` BIGINT UNSIGNED NULL;
ALTER TABLE jibres.giftusage ADD `agent_id` INT UNSIGNED NULL;


ALTER TABLE jibres.store ADD `ip_id` BIGINT UNSIGNED NULL;
ALTER TABLE jibres.store ADD `agent_id` INT UNSIGNED NULL;


ALTER TABLE jibres.store_app ADD `ip_id` BIGINT UNSIGNED NULL;
ALTER TABLE jibres.store_app ADD `agent_id` INT UNSIGNED NULL;
