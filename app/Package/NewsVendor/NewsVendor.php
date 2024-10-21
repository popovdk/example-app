<?php

namespace App\Package\NewsVendor;

use Generator;

interface NewsVendor
{
    /**
     * @param $q
     * @return Generator<NewsDTO>
     */
    public function paginateList($q): Generator;
}
