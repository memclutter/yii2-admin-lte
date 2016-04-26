<?php

namespace memclutter\AdminLTE;

use cebe\gravatar\Gravatar;
use yii\base\InvalidValueException;

class GravatarSidebarUserPanel extends SidebarUserPanel
{
    /**
     * @var string email attribute name for gravatar
     */
    public $emailAttribute = 'email';

    /**
     * @var array
     */
    public $gravatarOptions = [];

    /**
     * @var array
     */
    public $imgOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        if (empty($this->emailAttribute)) {
            throw new InvalidValueException('Missing required attribute emailAttribute');
        }
        
        if (!$this->model->hasAttribute($this->emailAttribute)) {
            throw new InvalidValueException('Email attribute not found');
        }

        if (!isset($this->imgOptions['alt'])) {
            $this->imgOptions['alt'] = $this->getUserName();
        }

        if (!isset($this->imgOptions['title'])) {
            $this->imgOptions['title'] = $this->getUserName();
        }

        if (!isset($this->imgOptions['class'])) {
            $this->imgOptions['class'] = 'img-circle';
        }

        $this->gravatarOptions['email'] = $this->getEmail();
        $this->gravatarOptions['options'] = $this->imgOptions;
    }

    /**
     * @inheritdoc
     */
    protected function buildImgTag()
    {
        return Gravatar::widget($this->gravatarOptions);
    }

    protected function getEmail()
    {
        return $this->model->getAttribute($this->emailAttribute);
    }
}