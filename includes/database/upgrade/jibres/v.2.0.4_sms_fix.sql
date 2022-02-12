ALTER TABLE jibres_api_log.sms CHANGE `status` `status` ENUM('register','pending','sending','expired','moneylow','unknown','send','sended','delivered','queue','failed','undelivered','cancel','block','other') CHARACTER SET utf8mb4  NULL DEFAULT NULL;

ALTER TABLE jibres_api_log.sms ADD `sms_sending_id` BIGINT NULL DEFAULT NULL;