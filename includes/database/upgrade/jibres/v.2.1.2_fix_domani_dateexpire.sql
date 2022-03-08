ALTER TABLE jibres_nic.domain CHANGE `dateexpire` `dateexpire` date NULL DEFAULT NULL;



UPDATE jibres_nic.domain SET  domain.status = 'enable' ,
domain.available = 0 , domain.dateexpire = '2027-03-22' ,
 domain.datemodified = '2022-03-08 14:19:28'
 WHERE domain.id = 430 LIMIT 1;
