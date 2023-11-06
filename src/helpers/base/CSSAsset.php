<?php

namespace PressWind\src\helpers\base;

class CSSAsset extends Asset
{
    /**
     * for css only
     */
    private string $media = 'all';

    public function media(string $media): CSSAsset
    {
        $this->media = $media;

        return $this;
    }

    /**
     * enqueue asset
     */
    protected function enqueue(): void
    {

        $handle = $this->handle;
        $src = $this->src;
        $deps = $this->deps;
        $ver = $this->getVersion();
        $media = $this->media;

        wp_enqueue_style(
            $handle,
            $src,
            $deps,
            $ver,
            $media
        );
    }
}
