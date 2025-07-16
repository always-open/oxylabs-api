<?php

namespace AlwaysOpen\OxylabsApi\Traits;

trait Renderable
{
    public function isRaw(): bool
    {
        return is_string($this->content);
    }

    public function saveImageTo(string $imagePath): bool
    {
        if (! $this->isRaw()) {
            return false;
        }

        $data = str_replace(' ', '+', $this->content);
        $img = base64_decode($data);
        $success = false;
        if ($img) {
            $success = file_put_contents($imagePath, $img);
        }

        return $success;
    }
}
