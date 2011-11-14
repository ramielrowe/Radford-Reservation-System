<?php

	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_users");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_equipment");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_blackouts");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_error_log");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_log");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_messages");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_reservations");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_users");
	doQuery("TRUNCATE TABLE ".getConfigVar('db_prefix')."_warnings");

?>