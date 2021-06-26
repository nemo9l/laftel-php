<?php

namespace Nemo9l\Laftel\Models;

class SearchResult
{
    /**
     * Animation id.
     */
    public int $id;

    /**
     * Title of an animation.
     */
    public string $name;

    /**
     * Laftel URL of an animation.
     */
    public string $url;

    /**
     * Thumbnail of an animation.
     */
    public string $thumbnail;

    /**
     * Does an animation for adult only.
     */
    public bool $adult;

    /**
     * Genre (in korean).
     */
    public array $genres;
}