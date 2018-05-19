update userstores set userstores.staff = 1 where userstores.type = 'staff';
update userstores set userstores.customer = 1 where userstores.type = 'customer';
update userstores set userstores.supplier = 1 where userstores.type = 'supplier';