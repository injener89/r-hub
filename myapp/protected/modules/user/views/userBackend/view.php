<?php
/**
 * @var $model User
 */
$this->breadcrumbs = [
    Yii::t('UserModule.user', 'Users') => ['/user/userBackend/index'],
    $model->sid,
];

$this->pageTitle = Yii::t('UserModule.user', 'Users - show');

$this->menu = [
    [
        'label' => Yii::t('UserModule.user', 'Users'),
        'items' => [
            [
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('UserModule.user', 'Manage users'),
                'url'   => ['/user/userBackend/index']
            ],
            [
                'icon'  => 'fa fa-fw fa-plus-square',
                'label' => Yii::t('UserModule.user', 'Create user'),
                'url'   => ['/user/userBackend/create']
            ],
            ['label' => Yii::t('UserModule.user', 'User') . ' «' . $model->sid . '»'],
            [
                'icon'  => 'fa fa-fw fa-pencil',
                'label' => Yii::t('UserModule.user', 'Edit user'),
                'url'   => [
                    '/user/userBackend/update',
                    'id' => $model->id
                ]
            ],
            [
                'icon'  => 'fa fa-fw fa-eye',
                'label' => Yii::t('UserModule.user', 'Show user'),
                'url'   => [
                    '/user/userBackend/view',
                    'id' => $model->id
                ]
            ],
            [
                'icon'  => 'fa fa-fw fa-lock',
                'label' => Yii::t('UserModule.user', 'Change user password'),
                'url'   => [
                    '/user/userBackend/changepassword',
                    'id' => $model->id
                ]
            ],
            [
                'icon'        => 'fa fa-fw fa-trash-o',
                'label'       => Yii::t('UserModule.user', 'Remove user'),
                'url'         => '#',
                'linkOptions' => [
                    'submit'  => ['/user/userBackend/delete', 'id' => $model->id],
                    'params'  => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
                    'confirm' => Yii::t('UserModule.user', 'Do you really want to remove user?')
                ],
            ],
        ]
    ],
    [
        'label' => Yii::t('UserModule.user', 'Tokens'),
        'items' => [
            [
                'icon'  => 'fa fa-fw fa-list-alt',
                'label' => Yii::t('UserModule.user', 'Token list'),
                'url'   => ['/user/tokensBackend/index']
            ],
        ]
    ],
];
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('UserModule.user', 'Viewing users'); ?><br/>
        <small>&laquo;<?php echo $model->sid; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget(
    'bootstrap.widgets.TbDetailView',
    [
        'data'       => $model,
        'attributes' => [
            'id',
            [
                'name'  => 'full_name',
                'value' => $model->getFullName(),
            ],
            'sid',
            'email',
            'location',
            'birth_date',
            'about',
            [
                'name'  => 'user_type',
                'value' => $model->getUserType(),
            ],
            [
                'name'  => 'status',
                'value' => $model->getStatus(),
            ],
            [
                'name'  => 'access_level',
                'value' => $model->getAccessLevel(),
            ],
            [
                'name'  => 'email_confirm',
                'value' => $model->getEmailConfirmStatus(),
            ],
            'visit_time',
            'create_time',
            'update_time'
        ],
    ]
); ?>
