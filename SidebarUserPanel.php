<?php

namespace memclutter\AdminLTE;

use yii\base\InvalidValueException;
use yii\base\Model;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\web\IdentityInterface;

class SidebarUserPanel extends Widget
{
    /**
     * @var IdentityInterface|ActiveRecord|Model User model class.
     */
    public $model;

    /**
     * @var string|callable avatar builder. It can be a string or function.
     * Examples:
     *
     * <?= SidebarUserPanel::widget([
     *     'avatar' => function($model) {
     *         return Yii::getAlias('@uploads/avatars/' . $model->avatarSrc);
     *     },
     *     'userNameAttribute' => 'username',
     * ]) ?>
     *
     * or src string
     *
     * <?= SidebarUserPanel::widget([
     *     'user' => $model,
     *     'avatar' => Yii::getAlias('@uploads/avatars/' . $model->avatarSrc),
     *     'userNameAttribute' => 'username',
     * ]) ?>
     */
    public $avatar;

    /**
     * @var string this value use in panel info
     */
    public $usernameAttribute;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->model) || ($this->model instanceof IdentityInterface)) {
            if (\Yii::$app->user->isGuest) {
                throw new InvalidValueException('SidebarUserPanel::user property expected not guest authorized user');
            }

            $this->model = \Yii::$app->user->identity;
        }

        if (empty($this->usernameAttribute)) {
            throw new InvalidValueException('SidebarUserPanel::userNameAttribute property is required');
        }

        if (!$this->model->hasAttribute($this->usernameAttribute)) {
            throw new InvalidValueException('SidebarUserPanel::userNameAttribute property not found');
        }
    }

    public function run()
    {
        $userName = $this->getUserName();
        $img = $this->buildImgTag();

        return (
            '<div class="user-panel">
                <div class="pull-left image">
                    ' . $img . '
                </div>
                <div class="pull-left info">
                    <p>' . $userName . '</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>'
        );
    }

    protected function buildImgTag()
    {
        return Html::img($this->getAvatarSrc(), [
            'class' => [
                'alt' => $this->getUserName(),
                'title' => $this->getUserName(),
            ],
        ]);
    }

    protected function getUserName()
    {
        return $this->model->getAttribute($this->usernameAttribute);
    }

    protected function getAvatarSrc()
    {
        $avatar = $this->avatar;
        return $avatar instanceof \Closure ? $avatar() : $avatar;
    }
}