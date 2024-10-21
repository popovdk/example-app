<?php

namespace App\Package\NewsVendor;

class NewsDTO
{
    private string $title;
    private string $description;
    private string $content;
    private string $source;
    private string $preview_url;
    private string $published_at;
    private string $url;

    /**
     * @param string $title
     * @param string $description
     * @param string $content
     * @param string $source
     * @param string $preview_url
     * @param string $published_at
     * @param string $url
     */
    public function __construct(string $title, string $description, string $content, string $source, string $preview_url, string $published_at, string $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->source = $source;
        $this->preview_url = $preview_url;
        $this->published_at = $published_at;
        $this->url = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getPreviewUrl(): string
    {
        return $this->preview_url;
    }

    public function getPublishedAt(): string
    {
        return $this->published_at;
    }

    public function getUrl(): string
    {
        return $this->url;
    }


}
