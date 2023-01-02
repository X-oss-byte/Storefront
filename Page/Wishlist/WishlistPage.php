<?php declare(strict_types=1);

namespace Shopware\Storefront\Page\Wishlist;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Checkout\Customer\SalesChannel\LoadWishlistRouteResponse;
use Shopware\Storefront\Page\Page;

/**
 * @package storefront
 */
#[Package('storefront')]
class WishlistPage extends Page
{
    /**
     * @var LoadWishlistRouteResponse
     */
    protected $wishlist;

    public function getWishlist(): LoadWishlistRouteResponse
    {
        return $this->wishlist;
    }

    public function setWishlist(LoadWishlistRouteResponse $wishlist): void
    {
        $this->wishlist = $wishlist;
    }
}
