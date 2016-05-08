<?php

/**
 * Core install migration
 * Класс миграций для модуля Core
 *
 * @category CoreMigration
 * @package core.modules.user.install.migrations
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @link     http://websum.uz
 **/
class m000000_000000_core_base extends core\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        $this->createTable(
            '{{core_settings}}',
            [
                'id'            => 'pk',
                'module_id'     => 'varchar(100) NOT NULL',
                'param_name'    => 'varchar(100) NOT NULL',
                'param_value'   => 'varchar(255) NOT NULL',
                'creation_date' => 'datetime NOT NULL',
                'change_date'   => 'datetime NOT NULL',
                'user_id'       => 'integer DEFAULT NULL',
                'type'          => "integer NOT NULL DEFAULT '1'",
            ],
            $this->getOptions()
        );

        //ix
        $this->createIndex(
            "ux_{{core_settings}}_module_id_param_name",
            '{{core_settings}}',
            "module_id,param_name",
            true
        );
        $this->createIndex("ix_{{core_settings}}_module_id", '{{core_settings}}', "module_id", false);
        $this->createIndex("ix_{{core_settings}}_param_name", '{{core_settings}}', "param_name", false);

        //fk
        $this->addForeignKey(
            "fk_{{core_settings}}_user_id",
            '{{core_settings}}',
            'user_id',
            '{{user_user}}',
            'id',
            'SET NULL',
            'NO ACTION'
        );

    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{core_settings}}');
    }
}
