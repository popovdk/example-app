<?php

namespace App\Package\NewsVendor\Vendors;

use App\Package\NewsVendor\NewsVendorInterface;

class NewsApiOrgNewsVendor implements NewsVendorInterface
{
    public function list(): array
    {
        return [];
    }
}
