INSERT INTO jibres_nic_log.whois (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'whois';

INSERT INTO jibres_nic_log.contact_check (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'contact_check';

INSERT INTO jibres_nic_log.contact_info (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'contact_info';

INSERT INTO jibres_nic_log.contact_create (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'contact_create';

INSERT INTO jibres_nic_log.contact_update (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'contact_update';

INSERT INTO jibres_nic_log.domain_check (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_check';

INSERT INTO jibres_nic_log.domain_lock (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_lock';

INSERT INTO jibres_nic_log.domain_unlock (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_unlock';

INSERT INTO jibres_nic_log.domain_info (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_info';

INSERT INTO jibres_nic_log.domain_create (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_create';

INSERT INTO jibres_nic_log.domain_update (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_update';

INSERT INTO jibres_nic_log.domain_renew (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_renew';

INSERT INTO jibres_nic_log.domain_delete (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_delete';

INSERT INTO jibres_nic_log.domain_transfer (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'domain_transfer';

INSERT INTO jibres_nic_log.poll_request (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'poll_request';

INSERT INTO jibres_nic_log.poll_acknowledge (`id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result`)
SELECT `id`,`user_id`,`send`,`response`,`datesend`,`dateresponse`,`nic_id`,`server_id`,`client_id`,`result_code`,`request_count`,`result` FROM jibres_nic_log.log WHERE jibres_nic_log.log.type = 'poll_acknowledge';



