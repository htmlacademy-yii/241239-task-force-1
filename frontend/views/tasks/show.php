<?php
use yii\helpers\Url;
?>

<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
            <div class="content-view__header">
                <div class="content-view__headline">
                    <h1><?=strip_tags($task->name);?></h1>
                    <span>Размещено в категории
                                    <a href="#" class="link-regular"><?= $task->category->name ?></a>
                                    <?php echo Yii::$app->formatter->asRelativeTime($task->created_at, new DateTime("now")); ?></span>
                </div>
                <b class="new-task__price new-task__price--clean content-view-price"><?=strip_tags($task->price);?><b> ₽</b></b>
                <div class="new-task__icon new-task__icon--<?=$task->category->icon?> content-view-icon"></div>
            </div>
            <div class="content-view__description">
                <h3 class="content-view__h3">Общее описание</h3>
                <p>
                    <?= strip_tags($task->description); ?>
                </p>
            </div>
            <div class="content-view__attach">
                <h3 class="content-view__h3">Вложения</h3>
                <?php foreach ($task->attachments as $item):?>
                    <a href="<?= Url::to($item->url); ?>" class="link-regular"><?= isset($item->name) ? strip_tags($item->name) : 'Без имени';?></a>
                <?php endforeach; ?>
            </div>
            <div class="content-view__location">
                <h3 class="content-view__h3">Расположение</h3>
                <div class="content-view__location-wrapper">
                    <div class="content-view__map">
                        <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                         alt="Москва, Новый арбат, 23 к. 1"></a>
                    </div>
                    <div class="content-view__address">
                        <span class="address__town"><?=isset($task->city->city) ? $task->city->city : "";?></span><br>
                        <span>Новый арбат, 23 к. 1</span>
                        <p>Вход под арку, код домофона 1122</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-view__action-buttons">
            <button class=" button button__big-color response-button open-modal"
                    type="button" data-for="response-form">Откликнуться</button>
            <button class="button button__big-color refusal-button open-modal"
                    type="button" data-for="refuse-form">Отказаться</button>
            <button class="button button__big-color request-button open-modal"
                    type="button" data-for="complete-form">Завершить</button>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отклики <span>(<?=$task->responsesCount?>)</span></h2>
        <div class="content-view__feedback-wrapper">
            <?php foreach ($task->responses as $response): ?>
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                        <a href="#"><img src="/img/man-glasses.jpg" width="55" height="55"></a>
                        <div class="feedback-card__top--name">
                            <p><a href="#" class="link-regular"><?= strip_tags($response->userInfo->name); ?> <?= strip_tags($response->userInfo->surname); ?></a></p>
                            <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                            <b>4.25</b>
                        </div>
                        <span class="new-task__time"><?php echo Yii::$app->formatter->asRelativeTime($response->responsed_at, new DateTime("now")); ?></span>
                    </div>
                    <div class="feedback-card__content">
                        <p>
                            <?= strip_tags($response->comment); ?>
                        </p>
                        <span><?= strip_tags($response->price); ?> ₽</span>
                    </div>
                    <div class="feedback-card__actions">
                        <a class="button__small-color request-button button"
                           type="button">Подтвердить</a>
                        <a class="button__small-color refusal-button button"
                           type="button">Отказать</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
            <h3>Заказчик</h3>
            <div class="profile-mini__top">
                <img src="/img/man-brune.jpg" width="62" height="62" alt="Аватар заказчика">
                <div class="profile-mini__name five-stars__rate">
                    <p><?= strip_tags($task->author->name); ?></p>
                </div>
            </div>
            <p class="info-customer"><span><?= $task->authorInfo->tasksCount; ?> заданий</span><span class="last-"><?php echo Yii::$app->formatter->asRelativeTime($task->authorInfo->created_at, new DateTime("now")); ?> на сайте</span></p>
            <a href="<?= Url::to(['/users/' . $task->authorInfo->id]); ?>" class="link-regular">Смотреть профиль</a>
        </div>
    </div>
    <div id="chat-container">
        <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
        <chat class="connect-desk__chat"></chat>
    </div>
</section>
