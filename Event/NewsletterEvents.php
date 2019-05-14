<?php declare(strict_types=1);

namespace Shopware\Storefront\Event;

use Shopware\Core\Content\NewsletterRecipient\Event\NewsletterConfirmEvent;
use Shopware\Core\Content\NewsletterRecipient\Event\NewsletterRegisterEvent;
use Shopware\Storefront\Page\Newsletter\ConfirmSubscribe\NewsletterConfirmSubscribePageLoadedEvent;
use Shopware\Storefront\Page\Newsletter\Register\NewsletterRegisterPageLoadedEvent;

class NewsletterEvents
{
    /**
     * @Event("Shopware\Core\Content\NewsletterRecipient\Event\NewsletterRegisterEvent")
     */
    public const NEWSLETTER_REGISTER_EVENT = NewsletterRegisterEvent::EVENT_NAME;

    /**
     * @Event("Shopware\Core\Content\NewsletterRecipient\Event\NewsletterConfirmEvent")
     */
    public const NEWSLETTER_REGISTER_CONFIRM_EVENT = NewsletterConfirmEvent::EVENT_NAME;

    /**
     * @Event("Shopware\Storefront\Page\Newsletter\Register\NewsletterRegisterPageLoadedEvent")
     */
    public const NEWSLETTER_PAGE_LOADED_EVENT = NewsletterRegisterPageLoadedEvent::NAME;

    /**
     * @Event("Shopware\Storefront\Page\Newsletter\ConfirmSubscribe\NewsletterConfirmSubscribePageLoadedEvent")
     */
    public const NEWSLETTER_CONFIRM_SUBSCRIBE_PAGE_LOADED_EVENT = NewsletterConfirmSubscribePageLoadedEvent::NAME;
}
