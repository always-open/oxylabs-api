<?php

namespace AlwaysOpen\OxylabsApi\Traits;

trait Headers
{
    protected ?array $__headers = null;

    public function getHeaderValue(string $key): mixed
    {
        if ($this->__headers) {
            return $this->__headers[$key] ?? null;
        }

        return null;
    }

    public function getHeaders(): ?array
    {
        return $this->__headers;
    }

    public function setHeaders(?array $headers = null): self
    {
        $this->__headers = $headers;

        return $this;
    }
}
