<?php

namespace app\components;

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class EmailJob extends BaseObject implements JobInterface
{
    public $to;
    public $subject;
    public $body;
    public $template;
    public $name;

    public function execute($queue)
    {
        $mailer = Yii::$app->mailer->compose($this->template, [
            'name' => $this->name,
            'body' => $this->body
        ])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->send();

        if (!$mailer) {
            throw new \RuntimeException('Failed to send email.');
        }
    }
}