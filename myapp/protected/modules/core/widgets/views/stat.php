<?php
echo '<div class="stat" id="stat">';
if (Yii::app()->db->enableParamLogging == true || Yii::app()->db->enableProfiling == true) {
    echo Yii::t('CoreModule.core', 'requests: {qcount}', ['{qcount}' => $dbStat[0]]);
    echo Yii::t('CoreModule.core', ' time: {qtime}', ['{qtime}' => round($dbStat[1], 3)]);
}
echo "<div>";
echo Yii::t('CoreModule.core', 'memory: {memory}', ['{memory}' => $memory]);
echo Yii::t('CoreModule.core', ' run in: {time}', ['{time}' => $time]);
echo "</div>";
