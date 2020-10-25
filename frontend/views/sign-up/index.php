<?php
use frontend\models\Cities;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$config = [
    'id' => 'signup',
    'fieldConfig' => [
        'options' => [
            'tag' => false,
            'template' => "{label}\n{input}\n{hint}\n{error}",
        ],
    ],
    'options' => [
        'class' => 'registration__user-form form-create'
    ]
]

?>

        <section class="registration__user">
            <h1>Регистрация аккаунта</h1>
            <div class="registration-wrapper">

                <?php
                $formSignUp = ActiveForm::begin($config); ?>
                <?= $formSignUp->field($model, 'email')
                    ->textInput([
                    'class' => 'input textarea',
                    'placeholder' => 'kumarm@mail.ru'
                ]);
                ?>
                <span>Введите валидный адрес электронной почты</span>
                <?= $formSignUp->field($model, 'name', [
                    'options' => [
                        'class' => 'custom',
                    ]
                ])->textInput([
                    'class' => 'input textarea',
                    'placeholder' => 'Мамедов Кумар'
                ]);
                ?>
                <span>Введите ваше имя и фамилию</span>
                <?= $formSignUp->field($model, 'city_id', [
                    'options' => ['class' => 'custom']
                ])
                    ->dropDownList(Cities::find()->select(['city', 'id'])->indexBy('id')->column(),
                        [
                            'class' => 'multiple-select input town-select registration-town',
                            'options' => [
                                '1109' => [
                                    'Selected' => true
                                ]
                            ]
                        ])->label('Город проживания'); ?>
                <span>Укажите город, чтобы находить подходящие задачи</span>
                <?= $formSignUp->field($model, 'password', [
                    'options' => ['class' => 'custom',]
                ])->passwordInput([
                    'class' => 'input textarea'
                ]);
                ?>
                <span>Длина пароля от 8 символов</span>
                <?= Html::submitButton('Cоздать аккаунт', [
                    'class' => 'button button__registration'
                ]) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </section>
