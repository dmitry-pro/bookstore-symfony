<?php

namespace AppBundle\Util;

use Psr\Log\LoggerInterface;
use Swift_Events_SendEvent;
use Swift_Events_SendListener;

/**
 * Implements Swiftmailer emails logging.
 *
 * Class MailerLoggerUtil
 * @package AppBundle\Util
 */
class MailerLoggerUtil implements Swift_Events_SendListener
{

    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
        // ...
    }
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        // $evt contains mail, response and many more data
        $this->logger->info($evt->getMessage()->getSubject() . ' - ' . $evt->getMessage()->getId());
    }
}
