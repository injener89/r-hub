<?php
class CoreAjaxWidgetComponent extends CApplicationComponent
{
    public $widgets = [
        'login-form'=>'application.modules.user.widgets.LoginWidget',
    ];
    public $_widget = false;
    public $isAjax = false;
    public $layout;

    public function init()
    {
        $this->isAjax = $this->isAjaxRequest();
        parent::init();
    }
    public function run($object)
    {
        $this->layout = $object->layout;
        $this->widgetInt($object);
    }
    public function widgetInt($object){
        if($this->isAjax){
            $this->layout = null;
            $object->widget($this->_widget); 
        }
    }
    protected function isAjaxRequest(){
        if(Yii::app()->request->isAjaxRequest){
            foreach ($this->widgets as $key =>$value)
            {
                if(Yii::app()->getRequest()->getParam('ajax') && Yii::app()->getRequest()->getParam('ajax') == $key){
                    $this->_widget = $value;
                    $res =  true;
                    break;
                } else {
                    $res = false;  
                }
            }
            return $res;
        }
    }
}