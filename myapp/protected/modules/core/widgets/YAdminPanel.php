<?php
/**
 * Виджет админ-панели для фронтальной части сайта
 *
 * @category CoreWidget
 * @package  core.modules.core.widgets
 * @author   Timur <injener89@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.1
 * @link     http://websum.uz
 *
 **/

namespace core\widgets;

use Yii;
use CHtml;

class YAdminPanel extends YWidget
{
    public $view = 'adminpanel';

    public function run()
    {
        $modules = Yii::app()->moduleManager->getModules(true);
       
        foreach ($modules as $item) {
            $item['linkOptions'] = ['title' => $item['label']];
            $item['label'] = CHtml::tag('span', ['class' => 'hidden-sm'], $item['label']);
        }

        $this->render(
            $this->view,
            [
                'modules' => $modules
            ]
        );
    }
}
