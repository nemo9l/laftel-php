<?php

namespace Nemo9l\Laftel\Models;

class AnimeInfo
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
     * Description about an animation.
     */
    public string $content;

    /**
     * Does an animation completed.
     */
    public bool $ended;

    /**
     * Awards that granted to an animation.
     */
    public array $awards;

    /**
     * Content rating (in korean).
     */
    public string $content_rating;

    /**
     * Does an animation for adult only.
     */
    public bool $adult;

    /**
     * Does an animation available in Laftel.
     */
    public bool $viewable;

    /**
     * Genre (in korean).
     */
    public array $genres;

    /**
     * Tags from Laftel (in korean).
     */
    public array $tags;

    /**
     * Airing quater.
     */
    public string $air_year_quarter;

    /**
     * Airing day.
     * 0 as sunday, 6 as saturday.
     */
    public int $air_day;

    /**
     * Average of user rating out of 5.
     */
    public float $avg_rating;

    /**
     * Percentage of male in total watched users.
     */
    public int $view_male;

    /**
     * Percentage of female in total watched users.
     */
    public int $view_female;
}