<?php
use yii\helpers\Html;
?>
<section class="content-view">
    <div class="user__card-wrapper">
        <div class="user__card">
            <img src="/img/man-hat.png" width="120" height="120" alt="Аватар пользователя">
            <div class="content-view__headline">
                <h1><?= Html::encode($user->name . ' ' . $user->surname); ?></h1>
                <p>Россия, <?= $user->city->city ?>, <?= $user->date_birth?></p>
                <div class="profile-mini__name five-stars__rate">
                    <?=Yii::$app->customHelper->renderRating($user->rating)?>
                    <b><?= Html::encode($user->rating); ?></b>
                </div>
                <b class="done-task">Выполнил <?= $user->taskExecutorCount ?> заказов</b><b class="done-review">Получил <?= $user->reviewsCount; ?> отзывов</b>
            </div>
            <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
                <span>Был на сайте 25 минут назад</span>
                <a href="#"><b></b></a>
            </div>
        </div>
        <div class="content-view__description">
            <p><?= Html::encode($user->bio); ?></p>
        </div>
        <div class="user__card-general-information">
            <div class="user__card-info">
                <h3 class="content-view__h3">Специализации</h3>
                <div class="link-specialization">
                    <?php foreach ($user->userCategory as $category): ?>
                        <a href="#" class="link-regular"><?=Html::encode($category->name);?></a>
                    <?php endforeach;?>
                </div>
                <h3 class="content-view__h3">Контакты</h3>
                <div class="user__card-link">
                    <a class="user__card-link--tel link-regular" href="#"><?= Html::encode($user->phone)?></a>
                    <a class="user__card-link--email link-regular" href="#"><?= Html::encode($user->user->email); ?></a>
                    <a class="user__card-link--skype link-regular" href="#"><?= Html::encode($user->skype); ?></a>
                </div>
            </div>
            <div class="user__card-photo">
                <h3 class="content-view__h3">Фото работ</h3>
                <?php foreach ($user->photos as $photo): ?>
                    <a href="#"><img src="<?= $photo->url; ?>" width="85" height="86" alt="<?= Html::encode($photo->title); ?>"></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отзывы<span>(<?= $user->reviewsCount; ?>)</span></h2>
        <div class="content-view__feedback-wrapper reviews-wrapper">
            <?php foreach ($user->reviews as $review): ?>
                <div class="feedback-card__reviews">
                    <p class="link-task link">Задание <a href="#" class="link-regular">«<?= Html::encode($review->task->name); ?>»</a></p>
                    <div class="card__review">
                        <a href="#"><img src="/img/man-glasses.jpg" width="55" height="54"></a>
                        <div class="feedback-card__reviews-content">
                            <p class="link-name link"><a href="#" class="link-regular"><?= Html::encode($review->userInfo->name . ' ' . $review->userInfo->surname); ?></a></p>
                            <p class="review-text">
                                <?= Html::encode($review->description); ?>
                            </p>
                        </div>
                        <div class="card__review-rate">
                            <p class="five-rate big-rate"><?= Html::encode($review->rating); ?><span></span></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__chat">

    </div>
</section>
