ALTER TABLE jibres_XXXXXXX.sms_log CHANGE `status` `status` enum('pending', 'sending', 'send', 'sended', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.sms_log ADD `smscount` smallint DEFAULT NULL AFTER `len`;

UPDATE jibres_XXXXXXX.sms_log SET sms_log.status = 'sended';

ALTER TABLE jibres_XXXXXXX.email_log CHANGE `status` `status` enum('pending', 'sending', 'send', 'sended', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL;

