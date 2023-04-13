Yii2 Extension for Mailersend
=============================
Yii2 Extension for Mailersend

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist deno028/yii2-mailersend "*"
```

or add

```
"deno028/yii2-mailersend": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```
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
 ```