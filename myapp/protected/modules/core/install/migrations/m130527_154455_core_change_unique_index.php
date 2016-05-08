<?php

/**
 * Core install migration
 * Класс миграций для модуля Core
 *
 * @category CoreMigration
 * @package  core.modules.user.install.migrations
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @link     http://websum.uz
 **/
class m130527_154455_core_change_unique_index extends core\components\DbMigration
{
    /**
     * Функция настройки и создания таблицы:
     *
     * @return null
     **/
    public function safeUp()
    {
        //Delete old unique index:
        $this->dropIndex("ux_{{core_settings}}_module_id_param_name", '{{core_settings}}');

        // Create new unique index:
        $this->createIndex(
            "ux_{{core_settings}}_module_id_param_name_user_id",
            '{{core_settings}}',
            "module_id,param_name,user_id",
            true
        );
    }

    /**
     * Функция удаления таблицы:
     *
     * @return null
     **/
    public function safeDown()
    {
        //Delete old unique index:
        $this->dropIndex("ux_{{core_settings}}_module_id_param_name_user_id", '{{core_settings}}');

        // Create new unique index:
        $this->createIndex(
            "ux_{{core_settings}}_module_id_param_name",
            '{{core_settings}}',
            "module_id,param_name",
            true
        );
    }
}
