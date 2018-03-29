<?php declare(strict_types=1);

namespace Shopware\Api\Config\Event\ConfigFormField;

use Shopware\Api\Config\Collection\ConfigFormFieldDetailCollection;
use Shopware\Api\Config\Event\ConfigForm\ConfigFormBasicLoadedEvent;
use Shopware\Api\Config\Event\ConfigFormFieldTranslation\ConfigFormFieldTranslationBasicLoadedEvent;
use Shopware\Api\Config\Event\ConfigFormFieldValue\ConfigFormFieldValueBasicLoadedEvent;
use Shopware\Context\Struct\ApplicationContext;
use Shopware\Framework\Event\NestedEvent;
use Shopware\Framework\Event\NestedEventCollection;

class ConfigFormFieldDetailLoadedEvent extends NestedEvent
{
    public const NAME = 'config_form_field.detail.loaded';

    /**
     * @var ApplicationContext
     */
    protected $context;

    /**
     * @var ConfigFormFieldDetailCollection
     */
    protected $configFormFields;

    public function __construct(ConfigFormFieldDetailCollection $configFormFields, ApplicationContext $context)
    {
        $this->context = $context;
        $this->configFormFields = $configFormFields;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): ApplicationContext
    {
        return $this->context;
    }

    public function getConfigFormFields(): ConfigFormFieldDetailCollection
    {
        return $this->configFormFields;
    }

    public function getEvents(): ?NestedEventCollection
    {
        $events = [];
        if ($this->configFormFields->getConfigForms()->count() > 0) {
            $events[] = new ConfigFormBasicLoadedEvent($this->configFormFields->getConfigForms(), $this->context);
        }
        if ($this->configFormFields->getTranslations()->count() > 0) {
            $events[] = new ConfigFormFieldTranslationBasicLoadedEvent($this->configFormFields->getTranslations(), $this->context);
        }
        if ($this->configFormFields->getValues()->count() > 0) {
            $events[] = new ConfigFormFieldValueBasicLoadedEvent($this->configFormFields->getValues(), $this->context);
        }

        return new NestedEventCollection($events);
    }
}
