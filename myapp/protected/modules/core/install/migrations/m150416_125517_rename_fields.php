<?php

class m150416_125517_rename_fields extends core\components\DbMigration
{
	public function safeUp()
	{
        $this->renameColumn('{{core_settings}}', 'creation_date', 'create_time');
        $this->renameColumn('{{core_settings}}', 'change_date', 'update_time');
	}
}