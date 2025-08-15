<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Cocur\Slugify\Slugify;

class AppExtension extends AbstractExtension
{
    private Slugify $slugify;

    public function __construct()
    {
        $this->slugify = new Slugify();
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('slug', [$this, 'slugify']),
        ];
    }

    public function slugify(string $value): string
    {
        return $this->slugify->slugify($value);
    }
}
