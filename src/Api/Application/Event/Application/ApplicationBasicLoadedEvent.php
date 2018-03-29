<?php

namespace Shopware\Api\Application\Event\Application;

use Shopware\Api\Currency\Event\Currency\CurrencyBasicLoadedEvent;
use Shopware\Api\Language\Event\Language\LanguageBasicLoadedEvent;
use Shopware\Context\Struct\ApplicationContext;
use Shopware\Framework\Event\NestedEvent;
use Shopware\Api\Application\Collection\ApplicationBasicCollection;
use Shopware\Framework\Event\NestedEventCollection;


class ApplicationBasicLoadedEvent extends NestedEvent
{
    public const NAME = 'application.basic.loaded';

    /**
     * @var ApplicationContext
     */
    protected $context;

    /**
     * @var ApplicationBasicCollection
     */
    protected $applications;

    public function __construct(ApplicationBasicCollection $applications, ApplicationContext $context)
    {
        $this->context = $context;
        $this->applications = $applications;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): ApplicationContext
    {
        return $this->context;
    }

    public function getApplications(): ApplicationBasicCollection
    {
        return $this->applications;
    }

    public function getEvents(): ?NestedEventCollection
    {
        $events = [];
//        if ($this->applications->getLanguages()->count() > 0) {
//            $events[] = new LanguageBasicLoadedEvent($this->applications->getLanguages(), $this->context);
//        }
//        if ($this->applications->getCurrencies()->count() > 0) {
//            $events[] = new CurrencyBasicLoadedEvent($this->applications->getCurrencies(), $this->context);
//        }
        return new NestedEventCollection($events);
    }

}