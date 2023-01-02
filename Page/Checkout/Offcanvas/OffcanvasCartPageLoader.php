<?php declare(strict_types=1);

namespace Shopware\Storefront\Page\Checkout\Offcanvas;

use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Checkout\Shipping\SalesChannel\AbstractShippingMethodRoute;
use Shopware\Core\Checkout\Shipping\ShippingMethodCollection;
use Shopware\Core\Content\Category\Exception\CategoryNotFoundException;
use Shopware\Core\Framework\DataAbstractionLayer\Exception\InconsistentCriteriaIdsException;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\Routing\Exception\MissingRequestParameterException;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Checkout\Cart\SalesChannel\StorefrontCartFacade;
use Shopware\Storefront\Page\GenericPageLoaderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package storefront
 */
#[Package('storefront')]
class OffcanvasCartPageLoader
{
    private EventDispatcherInterface $eventDispatcher;

    private StorefrontCartFacade $cartService;

    private GenericPageLoaderInterface $genericLoader;

    private AbstractShippingMethodRoute $shippingMethodRoute;

    /**
     * @internal
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        StorefrontCartFacade $cartService,
        GenericPageLoaderInterface $genericLoader,
        AbstractShippingMethodRoute $shippingMethodRoute
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->cartService = $cartService;
        $this->genericLoader = $genericLoader;
        $this->shippingMethodRoute = $shippingMethodRoute;
    }

    /**
     * @throws CategoryNotFoundException
     * @throws InconsistentCriteriaIdsException
     * @throws MissingRequestParameterException
     */
    public function load(Request $request, SalesChannelContext $salesChannelContext): OffcanvasCartPage
    {
        $page = $this->genericLoader->load($request, $salesChannelContext);

        $page = OffcanvasCartPage::createFrom($page);

        if ($page->getMetaInformation()) {
            $page->getMetaInformation()->assign(['robots' => 'noindex,follow']);
        }

        $page->setCart($this->cartService->get($salesChannelContext->getToken(), $salesChannelContext));

        $page->setShippingMethods($this->getShippingMethods($salesChannelContext));

        $this->eventDispatcher->dispatch(
            new OffcanvasCartPageLoadedEvent($page, $salesChannelContext, $request)
        );

        return $page;
    }

    private function getShippingMethods(SalesChannelContext $context): ShippingMethodCollection
    {
        $request = new Request();
        $request->query->set('onlyAvailable', '1');

        return $this->shippingMethodRoute->load($request, $context, new Criteria())->getShippingMethods();
    }
}
