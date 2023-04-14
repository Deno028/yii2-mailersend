<?php

namespace deno028\mailersend;

use yii\swiftmailer\Message as SwiftmailerMessage;

class Message extends SwiftmailerMessage
{
    private $_htmlBody;
    private $_textBody;

    public function setHtmlBody($html)
    {
        $this->_htmlBody = $html;
        return parent::setHtmlBody($html);
    }

    public function setTextBody($text)
    {
        $this->_textBody = $text;
        return parent::setTextBody($text);
    }

    /**
     * Returns text of message
     *
     * @return string
     */
    public function getBody()
    {
        return $this->_htmlBody;
    }

    /**
     * @return mixed
     */
    public function getHtmlBody()
    {
        return $this->_htmlBody;
    }

    /**
     * @return mixed
     */
    public function getTextBody()
    {
        return $this->_textBody;
    }
}
