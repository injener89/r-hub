<?php
/**
 * User tokens migration
 * Класс миграций для модуля User:
 *
 * @category CoreMigration
 * @package  core.modules.user.install.migrations
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @link     http://websum.uz
 **/

Yii::import('application.modules.user.models.UserToken');

class m131019_212911_user_tokens extends core\components\DbMigration
{
    public function safeUp()
    {
        $this->createTable(
            '{{user_tokens}}',
            [
                'id'      => 'pk',
                'user_id' => 'integer NOT NULL',
                'token'   => 'varchar(32) NOT NULL',
                'type'    => 'integer NOT NULL',
                'status'  => 'integer DEFAULT NULL',
                'created' => 'datetime NOT NULL',
                'updated' => 'datetime',
                'ip'      => 'string',
            ],
            $this->getOptions()
        );

        $this->createIndex("ix_{{user_tokens}}_user_id", '{{user_tokens}}', "user_id", false);
    }

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{user_tokens}}');
    }
}
