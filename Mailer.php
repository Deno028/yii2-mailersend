<?php

namespace deno028\mailersend;

use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\MailerSend;
use Yii;
use yii\base\InvalidConfigException;
use yii\mail\BaseMailer;


/**
 * Mailer implements a mailer based on MailerSend.
 *
 * To use Mailer, you should configure it in the application configuration like the following,
 *
 * ~~~
 * 'components' => [
 *     ...
 *     'mailer' => [
 *         'class' => 'deno028\mailersend\Mailer',
 *         'key' => 'key-example',
 *     ],
 *     ...
 * ],
 * ~~~
 *
 * To send an email, you may use the following code:
 *
 * ~~~
 * Yii::$app->mailer->compose('contact/html', ['contactForm' => $form])
 *     ->setFrom('from@domain.com')
 *     ->setTo($form->email)
 *     ->setSubject($form->subject)
 *     ->send();
 * ~~~
 */
class Mailer extends BaseMailer
{
    public $messageClass = "yii\swiftmailer\Message";

    public $key;

    private $_mailersend;

    public function getMailerSend()
    {
        if (!$this->_mailersend) {
            if (!$this->key) {
                throw new InvalidConfigException("Mailer key is required");
            }

            $this->_mailersend = new MailerSend(['api_key' => $this->key]);
        }

        return $this->_mailersend;
    }
    /**
     * @inheritdoc
     * @param Message $message the message to be sent
     */
    protected function sendMessage($message)
    {
        Yii::info('Sending email', __METHOD__);

        foreach ($message->getTo() as $k => $v) {
            $recipients = [
                new Recipient($k, $v)
            ];
        }

        $from = '';
        $fromName = '';
        foreach ($message->getFrom() as $k => $v) {
            $from = $k;
            $fromName = $v;
        }

        $replyTo = '';
        $replyToName = '';
        foreach ($message->getReplyTo() as $k => $v) {
            $replyTo = $k;
            $replyToName = $v;
        }

        $emailParams = (new EmailParams())
            ->setFrom($from)
            ->setFromName($fromName)
            ->setRecipients($recipients)
            ->setSubject($message->getSubject())
            ->setHtml($message->toString())
            ->setText($message->toString())
            ->setReplyTo($replyTo)
            ->setReplyToName($replyToName);

        return $this->getMailerSend()->email->send($emailParams);
    }
}
