<?php

namespace App\Package\NewsVendor;

use App\Package\NewsVendor\Vendors\NewsApiOrgNewsVendor;


class NewsVendor
{
    private string $vendor;

    const NEWS_API_ORG_VENDOR = 'newsapi.org';

    const VENDORS = [
        self::NEWS_API_ORG_VENDOR => NewsApiOrgNewsVendor::class
    ];

    public function __construct()
    {
        $this->vendor = self::NEWS_API_ORG_VENDOR;
    }

    public function getVendorInstance(): ?array
    {
        return self::VENDORS[$this->vendor] ?? null;
    }
}
