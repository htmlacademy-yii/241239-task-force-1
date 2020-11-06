<?php

use frontend\models\Categories;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<section class="create__task">
    <h1>Публикация нового задания</h1>
    <div class="create__task-main">
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'create__task-form form-create', 'id' => 'task-form', 'enctype' => 'multipart/form-data'],
            'action' => '/tasks/create',
            'method' => 'post',
            'enableClientValidation' => false
        ]); ?>
        <?= $form->field($model, 'title',
            ['inputOptions' => ['class' => 'input textarea', 'placeholder' => 'Повесить полку'],
                'options' => ['tag' => false]
            ])->textarea(['rows' => 1]) ?>
        <span>Кратко опишите суть работы</span>
        <?= $form->field($model, 'description',
            ['inputOptions' => ['class' => 'input textarea', 'placeholder' => 'Опишите свою задачу'],
                'options' => ['tag' => false]
            ])->textarea(['rows' => 7]) ?>
        <span>Укажите все пожелания и детали, чтобы исполнителям было проще соориентироваться</span>
        <?= $form->field($model, 'category',
            ['inputOptions' => ['class' => 'multiple-select input multiple-select-big', 'type' => 'hidden'], 'options' => ['tag' => false]])
            ->dropDownList(Categories::find()->select(['name', 'id'])->indexBy('id')->column()); ?>
        <span>Выберите категорию</span>
        <label>Файлы</label>
        <span>Загрузите файлы, которые помогут исполнителю лучше выполнить или оценить работу</span>
        <div class="create__file">
            <span>Добавить новый файл</span>
            <!--                          <input type="file" name="files[]" class="dropzone">-->
        </div>

        <div class="create__price-time">
            <div class="create__price-time--wrapper">
                <?= $form->field($model, 'budget', [
                    'inputOptions' => ['class' => 'input textarea input-money', 'placeholder' => '1000'],
                    'options' => ['tag' => false]
                ])
                    ->textarea(['rows' => 1]) ?>
                <span>Не заполняйте для оценки исполнителем</span>
            </div>
            <div class="create__price-time--wrapper">
                <?= $form->field($model, 'time', [
                    'inputOptions' => ['class' => 'input-middle input input-date', 'placeholder' => '10.11, 15:00'],
                    'options' => ['tag' => false]
                ])->input('date'); ?>
                <span>Укажите крайний срок исполнения</span>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <div class="create__warnings">
            <div class="warning-item warning-item--advice">
                <h2>Правила хорошего описания</h2>
                <h3>Подробности</h3>
                <p>Друзья, не используйте случайный<br>
                    контент – ни наш, ни чей-либо еще. Заполняйте свои
                    макеты, вайрфреймы, мокапы и прототипы реальным
                    содержимым.</p>
                <h3>Файлы</h3>
                <p>Если загружаете фотографии объекта, то убедитесь,
                    что всё в фокусе, а фото показывает объект со всех
                    ракурсов.</p>
            </div>
            <?php if ($model->hasErrors()): ?>
                <div class="warning-item warning-item--error">
                    <h2>Ошибки заполнения формы</h2>
                    <?php $mistakes = $model->getErrorSummary(true); ?>
                    <?php foreach ($mistakes as $mistake): ?>
                        <p><?=$mistake;?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <button form="task-form" class="button" type="submit">Опубликовать</button>
</section>

