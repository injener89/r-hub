<?php
/**
 * Виджет для отображения отладочной иформации (потребление памяти, время выполнения, кол-во запросов)
 *
 * @category CoreWidget
 * @package  core.modules.core.widgets
 * @author   Core Team <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.1
 * @link     http://websum.uz
 *
 **/
namespace core\widgets;

use Yii;

class YPerformanceStatistic extends YWidget
{
    public $view = 'stat';

    public function run()
    {
        $dbStat = Yii::app()->db->getStats();
        $memory = round(Yii::getLogger()->memoryUsage / 1024 / 1024, 3);
        $time = round(Yii::getLogger()->executionTime, 3);
        $this->render($this->view, ['dbStat' => $dbStat, 'time' => $time, 'memory' => $memory]);
    }
}
