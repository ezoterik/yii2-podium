<?php

/**
 * Podium Module
 * Yii 2 Forum Module
 * @author Paweł Bizley Brzozowski <pawel@positive.codes>
 * @since 0.1
 *
 * @var $this View
 * @var $active string
 */

use bizley\podium\models\User;
use bizley\podium\Podium;
use yii\helpers\Url;
use yii\web\View;

$podiumUser        = User::findMe();
$messageCount      = $podiumUser->getNewMessagesCount();
$subscriptionCount = $podiumUser->getSubscriptionsCount();

$podiumModule = Podium::getInstance();

?>
<ul class="nav nav-pills nav-stacked">
    <li role="presentation" class="<?= $active == 'profile' ? 'active' : '' ?>"><a href="<?= Url::to(['profile/index']) ?>"><?= Yii::t('podium/view', 'My Profile') ?></a></li>
<?php if ($podiumModule->userComponent === true): ?>
    <li role="presentation" class="<?= $active == 'details' ? 'active' : '' ?>"><a href="<?= Url::to(['profile/details']) ?>"><?= Yii::t('podium/view', 'Account Details') ?></a></li>
<?php endif; ?>
    <li role="presentation" class="<?= $active == 'forum' ? 'active' : '' ?>"><a href="<?= Url::to(['profile/forum']) ?>"><?= Yii::t('podium/view', 'Forum Details') ?></a></li>
    <li role="presentation" class="<?= $active == 'messages' ? 'active' : '' ?>"><a href="<?= Url::to(['messages/inbox']) ?>"><?php if ($messageCount): ?><span class="badge pull-right"><?= $messageCount ?></span><?php endif; ?><?= Yii::t('podium/view', 'Messages') ?></a></li>
    <li role="presentation" class="<?= $active == 'subscriptions' ? 'active' : '' ?>"><a href="<?= Url::to(['profile/subscriptions']) ?>"><?php if ($subscriptionCount): ?><span class="badge pull-right"><?= $subscriptionCount ?></span><?php endif; ?><?= Yii::t('podium/view', 'Subscriptions') ?></a></li>
</ul>
