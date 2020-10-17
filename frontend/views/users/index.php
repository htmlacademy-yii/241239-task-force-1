<?php
use yii\widgets\ActiveForm;
use frontend\models\Categories;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<section class="user__search">
    <div class="user__search-link">
        <p>Сортировать по:</p>
        <ul class="user__search-list">
            <li class="user__search-item user__search-item--current">
                <a href="#" class="link-regular">Рейтингу</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Числу заказов</a>
            </li>
            <li class="user__search-item">
                <a href="#" class="link-regular">Популярности</a>
            </li>
        </ul>
    </div>

    <?php foreach ($users as $user): ?>
        <div class="content-view__feedback-card user__search-wrapper">
            <div class="feedback-card__top">
                <div class="user__search-icon">
                    <a href="<?= Url::to(['/users/' . $user->id]); ?>"><img src="img/man-glasses.jpg" width="65" height="65"></a>
                    <span><?= $user->countTasks; ?> заданий</span>
                    <span><?= $user->userReviews; ?> отзывов</span>
                </div>
                <div class="feedback-card__top--name user__search-card">
                    <p class="link-name"><a href="<?= Url::to(['/users/' . $user->id]); ?>" class="link-regular"><?= strip_tags($user->userInfos->name . ' ' . $user->userInfos->surname);  ?></a></p>
                    <?=Yii::$app->customHelper->renderRating($user->userInfos->rating)?>
                    <b><?= strip_tags($user->userInfos->rating); ?></b>
                    <p class="user__search-content">
                        <?= strip_tags($user->userInfos->bio); ?>
                    </p>
                </div>
                <span class="new-task__time">Был на сайте <?php echo Yii::$app->formatter->asRelativeTime($user->userInfos->edited_at); ?></span>
            </div>
            <div class="link-specialization user__search-link--bottom">

                <?php foreach ($user->userCategory as $category): ?>
                    <a href="#" class="link-regular"><?php echo $category->name ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

</section>
<section  class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'options' => ['name' => 'users', 'class' => 'search-task__form']
        ]);?>
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
            <?php foreach ($model->moreAttribute as $field => $item): ?>
                <?php echo $form->field($model, $field, ['options' => ['tag' => false]])->checkbox(); ?>
            <?php endforeach; ?>
        </fieldset>
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
