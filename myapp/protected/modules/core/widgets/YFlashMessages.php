<?php
/**
 * Виджет для отображения flash-сообщений
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

class YFlashMessages extends YWidget
{
    const SUCCESS_MESSAGE = 'success';
    const INFO_MESSAGE = 'info';
    const WARNING_MESSAGE = 'warning';
    const ERROR_MESSAGE = 'error';

    public $options = [];

    public $view = 'flashmessages';

    public function run()
    {
        $this->render($this->view, ['options' => $this->options]);
    }
}
