ALTER TABLE jibres.sms_log CHANGE `status` `status` enum('pending', 'sending', 'send', 'sended', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL;
ALTER TABLE jibres.sms_log ADD `smscount` smallint DEFAULT NULL AFTER `len`;

UPDATE jibres.sms_log SET sms_log.status = 'sended';

ALTER TABLE jibres.email_log CHANGE `status` `status` enum('pending', 'sending', 'send', 'sended', 'delivered','queue','failed','undelivered','cancel','block','other') DEFAULT NULL;

