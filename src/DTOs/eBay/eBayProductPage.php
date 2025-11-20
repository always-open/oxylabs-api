<?php

namespace AlwaysOpen\OxylabsApi\DTOs\eBay;

use AlwaysOpen\OxylabsApi\Traits\Renderable;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

class eBayProductPage extends Data
{
    use Renderable;

    protected \DOMXPath|null $domXPath = null;

    public function __construct(
        public readonly string $content,
    ) {}

    public function getXPath(): \DOMXPath
    {
        if (! $this->domXPath) {
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($this->content);
            libxml_clear_errors();

            $this->domXPath = new \DOMXPath($dom);
        }

        return $this->domXPath;
    }

    public function getProductTitle(): ?string
    {
        return $this->getTextContent('//*[@data-testid="x-item-title"]');
    }

    public function getSellerName(): ?string
    {
        return $this->getTextContent('//*[@data-testid="x-sellercard-atf"]/div/div/a[@data-testid="ux-action"]/span');
    }

    public function getCondition(): ?string
    {
        return $this->getTextContent('//*[@data-testid="x-item-condition"]/div[contains(@class, "x-item-condition-text")]//span[@data-testid="ux-textual-display"]');
    }

    public function getPrice(): ?string
    {
        return $this->getTextContent('//*[@data-testid="x-price-primary"]');
    }

    public function getSellerUrl(): ?string
    {
        $xpath = $this->getXPath();
        $nodes = $xpath->query('//*[@data-testid="x-sellercard-atf"]/div/div/a[@data-testid="ux-action"]');

        return $nodes[0]?->attributes?->getNamedItem('href')->nodeValue ?? '';
    }

    protected function getTextContent(string $selector): ?string
    {
        $xpath = $this->getXPath();
        $nodes = $xpath->query($selector);

        return $nodes[0]->textContent ?? null;
    }

    public function arrayContent(): array
    {
        return [
            'condition' => $this->getCondition(),
            'product_title' => $this->getProductTitle(),
            'seller_name' => $this->getSellerName(),
            'seller_url' => $this->getSellerUrl(),
            'price' => $this->getPrice(),
        ];
    }
}
