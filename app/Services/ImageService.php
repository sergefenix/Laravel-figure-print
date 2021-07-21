<?php

namespace App\Services;

use Illuminate\Support\Str;

final class ImageService
{
    protected FigureCreateService $figureCreateService;

    public function __construct(FigureCreateService $figureCreateService)
    {
        $this->figureCreateService = $figureCreateService;
    }

    protected function toWebp($image)
    {
        imagewebp($image);
    }

    protected function toPng($image)
    {
        imagepng($image);
    }

    public function getImageWithHeadersByParams($params)
    {
        $background = imageCreateTrueColor($params['width'], $params['height']);

        $color = imageColorAllocate($background, $params['red'], $params['green'], $params['blue']);

        $this->figureCreateService->$params['type']($params, $background, $color);

        ob_start();

        $formatMethod = "to".Str::ucfirst($params['format']);

        $this->$formatMethod($background);

        $image = ob_get_contents();

        ob_end_clean();

        imagedestroy($background);

        $headers = [
            "Content-type" => "image/{$params['format']}",
        ];

        return [$image, $headers];
    }
}
