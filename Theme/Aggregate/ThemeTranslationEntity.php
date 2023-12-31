<?php declare(strict_types=1);

namespace Shopware\Storefront\Theme\Aggregate;

use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;
use Shopware\Storefront\Theme\ThemeEntity;

class ThemeTranslationEntity extends TranslationEntity
{
    /**
     * @var string|null
     */
    protected $themeId;

    /**
     * @var array|null
     */
    protected $customFields;

    /**
     * @var string|null
     */
    protected $description;

    /**
     * @var array|null
     */
    protected $labels;

    /**
     * @var ThemeEntity|null
     */
    protected $theme;

    public function getCustomFields(): ?array
    {
        return $this->customFields;
    }

    public function setCustomFields(?array $customFields): void
    {
        $this->customFields = $customFields;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getLabels(): ?array
    {
        return $this->labels;
    }

    public function setLabels(?array $labels): void
    {
        $this->labels = $labels;
    }

    public function getThemeId(): ?string
    {
        return $this->themeId;
    }

    public function setThemeId(?string $themeId): void
    {
        $this->themeId = $themeId;
    }

    public function getTheme(): ?ThemeEntity
    {
        return $this->theme;
    }

    public function setTheme(?ThemeEntity $theme): void
    {
        $this->theme = $theme;
    }
}
