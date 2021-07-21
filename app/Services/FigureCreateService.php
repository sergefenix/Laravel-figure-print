<?php

namespace App\Services;

use GdImage;

class FigureCreateService
{

    protected function rectangle(array $params, GdImage $background, int $color): void
    {
        imageRectangle($background, $params['x1'], $params['y1'], $params['x2'], $params['y2'], $color);
    }

    protected function ellipse(array $params, GdImage $background, int $color): void
    {
        imageFilledEllipse($background, $params['cx'], $params['cy'], $params['width'], $params['height'], $color);
    }

    protected function triangle(array $params, GdImage $background, int $color): void
    {
        $numPoints = round($params['points'] / 2);

        imagePolygon($background, $params['points'], $numPoints, $color);
    }
}
