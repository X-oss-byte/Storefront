<?php declare(strict_types=1);

namespace Shopware\Storefront\Pagelet\Listing;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\EntitySearchResult;
use Shopware\Core\Framework\Struct\Struct;
use Shopware\Core\System\Listing\ListingSortingCollection;
use Shopware\Storefront\Framework\Page\AggregationView\AggregationViewCollection;

class ListingPageletStruct extends Struct
{
    /**
     * @var EntitySearchResult
     */
    protected $products;

    /**
     * @var Criteria
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $showListing = true;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var int
     */
    protected $pageCount;

    /**
     * @var string|null
     */
    protected $currentSorting;

    /**
     * @var AggregationViewCollection
     */
    protected $aggregations;

    /**
     * @var ListingSortingCollection
     */
    protected $sortings;

    /**
     * @var string
     */
    protected $productBoxLayout;

    /**
     * @var string|null
     */
    protected $navigationId;

    public function __construct()
    {
        $this->aggregations = new AggregationViewCollection();
        $this->sortings = new ListingSortingCollection();
    }

    public function getProducts(): ?EntitySearchResult
    {
        return $this->products;
    }

    public function setProducts(EntitySearchResult $products): void
    {
        $this->products = $products;
    }

    public function getCriteria(): ?Criteria
    {
        return $this->criteria;
    }

    public function setCriteria(Criteria $criteria): void
    {
        $this->criteria = $criteria;
    }

    public function showListing(): bool
    {
        return $this->showListing;
    }

    public function setShowListing(bool $showListing): void
    {
        $this->showListing = $showListing;
    }

    public function setCurrentPage(int $page): void
    {
        $this->currentPage = $page;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setPageCount(int $count): void
    {
        $this->pageCount = $count;
    }

    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    public function setAggregations(AggregationViewCollection $aggregations): void
    {
        $this->aggregations = $aggregations;
    }

    public function getAggregations(): AggregationViewCollection
    {
        return $this->aggregations;
    }

    public function getSortings(): ListingSortingCollection
    {
        return $this->sortings;
    }

    public function getCurrentSorting(): ?string
    {
        return $this->currentSorting;
    }

    public function setCurrentSorting(?string $currentSorting): void
    {
        $this->currentSorting = $currentSorting;
    }

    public function getProductBoxLayout(): string
    {
        return $this->productBoxLayout;
    }

    public function setProductBoxLayout(string $productBoxLayout): void
    {
        $this->productBoxLayout = $productBoxLayout;
    }

    public function getNavigationId(): ?string
    {
        return $this->navigationId;
    }

    public function setNavigationId(?string $navigationId): void
    {
        $this->navigationId = $navigationId;
    }
}
