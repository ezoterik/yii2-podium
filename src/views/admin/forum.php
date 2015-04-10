<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title                   = Yii::t('podium/view', $model->getIsNewRecord() ? 'New Forum' : 'Edit Forum');
$this->params['breadcrumbs'][] = ['label' => Yii::t('podium/view', 'Administration Dashboard'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('podium/view', 'Forums'), 'url' => ['forums']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('jQuery(\'[data-toggle="popover"]\').popover()', View::POS_READY, 'bootstrap-popover');

echo $this->render('/elements/admin/_navbar', ['active' => 'forums']);
?>

<br>
<div class="row">
    <div class="col-sm-3">
        <?= Html::beginTag('ul', ['class' => 'nav nav-pills nav-stacked']); ?>
        <?= Html::tag('li', Html::a(Yii::t('podium/view', 'Forums List'), ['forums']), ['role' => 'presentation']); ?>
<?php foreach ($forums as $forum): ?>
        <?= Html::tag('li', Html::a(Html::encode($forum->name), ['edit-forum', 'id' => $forum->id]), ['role' => 'presentation', 'class' => $model->id == $forum->id ? 'active' : null]); ?>
<?php endforeach; ?>
        <?= Html::tag('li', Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-plus']) . ' ' . Yii::t('podium/view', 'Create new forum'), ['new-forum']), ['role' => 'presentation', 'class' => $model->getIsNewRecord() ? 'active' : null]); ?>
        <?= Html::endTag('ul'); ?>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-default">
<?php $form = ActiveForm::begin(['id' => 'new-forum-form']); ?>
            <div class="panel-heading">
                <h3 class="panel-title"><?= Yii::t('podium/view', $model->getIsNewRecord() ? 'New Forum' : 'Edit Forum') ?></h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'name')->textInput([
                            'data-container' => 'body',
                            'data-toggle' => 'popover',
                            'data-placement' => 'right',
                            'data-content' => Yii::t('podium/view', 'Name must contain only letters, digits, underscores and spaces (255 characters max).'),
                            'data-trigger' => 'focus'
                        ])->label(Yii::t('podium/view', 'Forum\'s Name')) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'sub')->textInput([
                            'placeholder' => Yii::t('podium/view', 'Optional subtitle'),
                            'data-container' => 'body',
                            'data-toggle' => 'popover',
                            'data-placement' => 'right',
                            'data-content' => Yii::t('podium/view', 'Subtitle must contain only letters, digits, underscores and spaces (255 characters max).'),
                            'data-trigger' => 'focus',
                        ])->label(Yii::t('podium/view', 'Forum\'s Subtitle')) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?= $form->field($model, 'visible')->checkbox(['uncheck' => 0])->label(Yii::t('podium/view', 'Forum visible for anonymous guests')) ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <?= Html::submitButton('<span class="glyphicon glyphicon-ok-sign"></span> ' . Yii::t('podium/view', $model->getIsNewRecord() ? 'Create new forum' : 'Save Forum'), ['class' => 'btn btn-block btn-primary', 'name' => 'save-button']) ?>
                    </div>
                </div>
            </div>
<?php ActiveForm::end(); ?>
        </div>
    </div>
</div><br>