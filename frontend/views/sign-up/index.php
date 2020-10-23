<?php
use frontend\models\Cities;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<main class="page-main">
    <div class="main-container page-container">
        <section class="registration__user">
            <h1>Регистрация аккаунта</h1>
            <div class="registration-wrapper">

                <?php
                $formSignUp = ActiveForm::begin([
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

                ]); ?>


                <?= $formSignUp->field($model, 'email', [

                ])->textInput([
                    'class' => 'input textarea',
                    'placeholder' => 'kumarm@mail.ru'
                ])->hint('Введите валидный адрес электронной почты', [
                    'tag' => 'span'
                ])
                ?>

                <?= $formSignUp->field($model, 'name', [
                    'options' => [
                        'class' => 'custom',
                    ]
                ])->textInput([
                    'class' => 'input textarea',
                    'placeholder' => 'Мамедов Кумар'
                ])->hint('Введите ваше имя и фамилию', [
                    'tag' => 'span'
                ]);
                ?>
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
                        ])->hint('Укажите город, чтобы находить подходящие задачи', [
                        'tag' => 'span'
                    ])->label('Город проживания'); ?>

                <?= $formSignUp->field($model, 'password', [
                    'options' => [
                        'class' => 'custom',
                    ],
                    'labelOptions' => [
                        'class' => 'input-danger'
                    ]
                ])->passwordInput([
                    'class' => 'input textarea'
                ])->hint('Длина пароля от 8 символов', [
                    'tag' => 'span'
                ]);
                ?>

                <?= Html::submitButton('Cоздать аккаунт', [
                    'class' => 'button button__registration'
                ]) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </section>

    </div>
</main>


