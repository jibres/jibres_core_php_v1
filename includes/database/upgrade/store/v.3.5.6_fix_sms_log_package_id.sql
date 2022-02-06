ALTER TABLE jibres_XXXXXXX.sms_log DROP `mobiles`;
ALTER TABLE jibres_XXXXXXX.sms_log CHANGE `status` `status` enum('register', 'pending','sending','expired', 'lowbalance', 'unknown', 'send', 'sended','delivered','queue','failed','undelivered','cancel','block','other') NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.sms_log ADD `template` varchar(100) NULL DEFAULT NULL;
