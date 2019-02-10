UPDATE userstores
SET userstores.displayname = CONCAT(userstores.firstname, ' ', userstores.lastname)
WHERE userstores.displayname IS NULL AND (userstores.firstname IS NOT NULL OR userstores.lastname IS NOT NULL);