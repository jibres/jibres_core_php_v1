ALTER TABLE jibres.store_data ADD `branding` timestamp NULL DEFAULT NULL AFTER `lang`;
ALTER TABLE jibres.store_data ADD `instagram` timestamp NULL DEFAULT NULL AFTER `branding`;
ALTER TABLE jibres.store_data ADD `support` timestamp NULL DEFAULT NULL AFTER `instagram`;


