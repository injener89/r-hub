Генерация Atom-ленты
====================

**Автор**: [Комманда разработчиков Websum](http://websum.uz/contacts?from=docs)

**Версия**: 0.1 (dev)

**Авторское право**:  2009-2013 Websum

**Лицензия**: [BSD](https://github.com/core/core/blob/master/LICENSE)


Для того, чтобы встроить в свой сайт feed-ленту, вам потребуется
добавить к нужному контроллеру следующий код:

<pre><code class="php">
public function actions()
{
    return array(
        'rssfeed' => array(
            'class'        => 'core\components\actions\YFeedAction',
            'data'         => News::model()->published()->findAll(),
            // Параметр title по умолчанию берётся из настроек приложения
            //'title'        => Yii::t('CoreModule.core', 'Site title'),
            // Параметр description по умолчанию берётся из настроек приложения
            //'description'  => Yii::t('CoreModule.core', 'Лента новостей сайта'),
            // Параметр link по умолчанию берётся как Yii::app()->getRequest()->getBaseUrl(true)
            //'link' => Yii::app()->getRequest()->getBaseUrl(true),
            'itemFields'   => array(
                // author_object, если не задан - у
                // item-елемента запросится author_nickname
                'author_object'   => 'user',
                // 'author_nickname' => 'nick_name', 
                'author_nickname' => 'nick_name',
                'content'         => 'full_text',
                'datetime'        => 'creation_date',
                'link'            => '/news/news/show',
                'linkParams'      => array('title' => 'alias'),
                'title'           => 'title',
                'updated'         => 'change_date',
            ),
        ),
    );
}

</code></pre>

Как вы могли заметить, это **пример**.  
Давайте немного обсудим поля:

`'rssfeed' => array(` - id-екшена, который будет подключён к нашему контроллеру 

`'class' => 'application.modules.core.components.actions.FeedAction',` - класс-екшена, который мы подключаем

`'data' => News::model()->published()->findAll(),` - данные, которые мы будем отображать в ленте

`'title' => Yii::t('CoreModule.core', 'Site title'),` - заголовок для нашей ленты

`'description' => Yii::t('CoreModule.core', 'Лента новостей сайта'),` - описание ленты

`'link' => Yii::app()->getRequest()->getBaseUrl(true),` - анкор, например на сайт

`'itemFields' => array(` - здесь мы описываем стандартные поля, для создания ленты

`'author_object' => 'user'` - объект автора, если не задан - у item-елемента запросится author_nickname

`'author_nickname' => 'nick_name',` - параметр для получения автора

`'content' => 'full_text',` - контент для элемента ленты

`'datetime' => 'creation_date',` - время создания ленты

`'link' => '/news/news/show',` - линк на отображение

`'linkParams' => array('title' => 'alias'),` - парметры для формирования абсолютной ссылки

`'title' => 'title',` - заголовок для элемента ленты

`'updated' => 'change_date',` - дата последнего изменения элемента ленты

## Об остальном: ##

Вы также можете ознакомиться с [исходным кодом](https://github.com/core/core/blob/master/protected/modules/core/components/actions/FeedAction.php). 