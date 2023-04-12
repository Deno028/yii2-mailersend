<?php

namespace deno028\mailersend;

use MailerSend\Helpers\Builder\EmailParams;
use MailerSend\Helpers\Builder\Recipient;
use MailerSend\MailerSend;
use Yii;
use yii\base\InvalidConfigException;
use yii\mail\BaseMailer;


/**
 * Mailer implements a mailer based on Mailgun.
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
    public $messageClass = Message::class;

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

        $recipients = [
            new Recipient('your@client.com', 'Your Client'),
        ];

        var_dump($message);

        $emailParams = (new EmailParams())
            ->setFrom('your@domain.com')
            ->setFromName('Your Name')
            ->setRecipients($recipients)
            ->setSubject('Subject')
            ->setHtml('This is the HTML content')
            ->setText('This is the text content')
            ->setReplyTo('reply to')
            ->setReplyToName('reply to name');

        return $this->getMailerSend()->email->send($emailParams);
    }
}
