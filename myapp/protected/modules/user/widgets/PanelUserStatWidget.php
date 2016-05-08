<?php

class PanelUserStatWidget extends \core\widgets\YWidget
{
    public function run()
    {
        $dataProvider = new CActiveDataProvider('User', [
            'sort'       => [
                'defaultOrder' => 'id DESC',
            ],
            'pagination' => [
                'pageSize' => (int)$this->limit,
            ],
        ]);

        $cacheTime = Yii::app()->controller->core->coreCacheTime;

        $this->render(
            'panel-stat',
            [
                'usersCount'    => User::model()->cache($cacheTime)->count(
                        'create_time >= :time AND create_time < NOW()',
                        [':time' => date('Y-m-d H:i:s',time() - 24 * 60 * 60)]
                    ),
                'allUsersCnt'   => User::model()->cache($cacheTime)->count(),
                'registeredCnt' => User::model()->cache($cacheTime)->registered()->count(),
                'dataProvider'  => $dataProvider
            ]
        );
    }
}
