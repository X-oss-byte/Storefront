<?php declare(strict_types=1);

namespace Shopware\Storefront\Framework\Seo;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Struct\Uuid;

class SeoResolver implements SeoResolverInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function resolveSeoPath(string $salesChannelId, string $pathInfo): ?array
    {
        $seoPathInfo = ltrim($pathInfo, '/');
        if ($seoPathInfo === '') {
            return [
                'pathInfo' => '/' . $seoPathInfo,
                'isCanonical' => false,
            ];
        }

        $seoPath = $this->connection->createQueryBuilder()
            ->select('id', 'path_info pathInfo', 'is_canonical isCanonical')
            ->from('seo_url')
            ->where('sales_channel_id = :salesChannelId')
            ->andWhere('seo_path_info = :seoPath')
            ->andWhere('is_valid = 1')
            ->setMaxResults(1)
            ->setParameter('salesChannelId', Uuid::fromHexToBytes($salesChannelId))
            ->setParameter('seoPath', $seoPathInfo)
            ->execute()
            ->fetch();

        $seoPath = $seoPath !== false
            ? $seoPath
            : ['pathInfo' => $seoPathInfo, 'isCanonical' => false];

        if (!$seoPath['isCanonical']) {
            $query = $this->connection->createQueryBuilder()
                ->select('path_info pathInfo', 'seo_path_info seoPathInfo')
                ->from('seo_url')
                ->where('sales_channel_id = :salesChannelId')
                ->andWhere('id != :id')
                ->andWhere('path_info = :pathInfo')
                ->andWhere('is_valid = 1')
                ->andWhere('is_canonical = 1')
                ->setMaxResults(1)
                ->setParameter('salesChannelId', Uuid::fromHexToBytes($salesChannelId))
                ->setParameter('id', $seoPath['id'] ?? '')
                ->setParameter('pathInfo', '/' . ltrim($seoPath['pathInfo'], '/'));

            $canonical = $query->execute()->fetch();
            if ($canonical) {
                $seoPath['canonicalPathInfo'] = '/' . ltrim($canonical['seoPathInfo'], '/');
            }
        }

        $seoPath['pathInfo'] = '/' . ltrim($seoPath['pathInfo'], '/');

        return $seoPath;
    }
}
