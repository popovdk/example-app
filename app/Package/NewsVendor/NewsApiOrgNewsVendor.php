<?php

namespace App\Package\NewsVendor;

use Generator;
use Illuminate\Support\Str;
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;

class NewsApiOrgNewsVendor implements NewsVendor
{
    private NewsApi $api;
    const PAGE_SIZE = 100;

    public function __construct(string $api_key)
    {
        $this->api = new NewsApi($api_key);
    }

    /**
     * @param $q
     * @return Generator<NewsDTO>
     * @throws NewsApiException
     */
    public function paginateList($q): Generator
    {
        $total = $this->api->getEverything(
            q: $q,
            page_size: 1,
            page: 1
        )->totalResults;

        for ($i = 1; $i <= ceil($total / self::PAGE_SIZE); $i++) {
            $response = $this->api->getEverything(
                q: $q,
                sort_by: 'publishedAt',
                page_size: self::PAGE_SIZE,
                page: $i
            );

            for ($j = 0; $j < count($response->articles); $j++) {
                $newsData = $response->articles[$j];

                if ($newsData->source->name == '[Removed]') {
                    continue;
                }

                $news = new NewsDTO(
                    $newsData->title,
                    $newsData->description ?? '',
                    $newsData->content,
                    $newsData->source->name,
                    $newsData->urlToImage ?? '',
                    $newsData->publishedAt,
                    $newsData->url
                );


                yield $news;
            }

            sleep(1);
        }
    }

    public function total($q) {

    }
}
