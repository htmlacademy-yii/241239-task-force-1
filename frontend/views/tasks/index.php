<?php

use frontend\models\Categories;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<section class="new-task">

                <div class="new-task__wrapper">
                    <h1>Новые задания</h1>
                    <?php foreach ($tasks as $task):?>
                        <div class="new-task__card">
                            <div class="new-task__title">
                                <a href="/tasks/<?=$task->id?>" class="link-regular"><h2><?= strip_tags($task->name); ?></h2></a>
                                <a  class="new-task__type link-regular" href="#"><p><?= $task->category->name; ?></p></a>
                            </div>
                            <div class="new-task__icon new-task__icon--<?= $task->category->icon; ?>"></div>
                            <p class="new-task_description">
                                <?= strip_tags($task->description); ?>
                            </p>
                            <b class="new-task__price new-task__price--<?= $task->category->icon; ?>"><?= strip_tags($task->price); ?><b> ₽</b></b>
                            <p class="new-task__place"><?= isset($task->city->city) ? $task->city->city : ""; ?></p>
                            <span class="new-task__time">
                                <?php echo Yii::$app->formatter->asRelativeTime($task->created_at, new DateTime("now")); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="new-task__pagination">
                    <ul class="new-task__pagination-list">
                        <li class="pagination__item"><a href="#"></a></li>
                        <li class="pagination__item pagination__item--current">
                            <a>1</a></li>
                        <li class="pagination__item"><a href="#">2</a></li>
                        <li class="pagination__item"><a href="#">3</a></li>
                        <li class="pagination__item"><a href="#"></a></li>
                    </ul>
                </div>
            </section>
            <section  class="search-task">
                <div class="search-task__wrapper">
                    <?php $form = ActiveForm::begin([
                        'method' => 'get',
                        'options' => [
                            'name' => 'tasks',
                            'class' => 'search-task__form'
                        ]
                    ]);

                    ?>
                    <fieldset class="search-task__categories">
                        <legend>Категории</legend>
                        <?= $form->field($model, 'categories')
                            ->checkboxList(
                                Categories::find()->select(['name', 'id'])->indexBy('id')->column())
                            ->label(false);

                        ?>
                    </fieldset>
                    <fieldset class="search-task__categories">
                        <legend>Дополнительно</legend>
                        <?= $form->field($model, 'no_response', ['options' => ['tag' => false]])->checkbox();
                        ?>

                        <?= $form->field($model, 'remote', ['options' => ['tag' => false]])->checkbox();
                        ?>
                    </fieldset>


                    <?= $form->field($model, 'period', [
                        'options' => ['class' => 'custom', 'tag' => false],
                        'labelOptions' => ['class' => 'search-task__name']
                    ])->dropDownList($model->attributeLabelsPeriod(), ['class' => 'multiple-select input']); ?>

                    <?= $form->field($model, 'search', [
                        'options' => [
                            'class' => 'custom',
                            'tag' => false
                        ],
                        'labelOptions' => [
                            'class' => 'search-task__name',
                        ]
                    ])->input('text', [
                        'class' => 'input-middle input'
                    ]);
                    ?>
                    <?= Html::submitButton('Искать', [
                        'class' => 'button'
                    ]) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </section>
