<?php

namespace App\Http\Controllers;

use App\Http\Requests\Figure\FigureRequest;
use App\Services\ImageService;

class FigureController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getImage(FigureRequest $request)
    {
        [$image, $headers] = $this->imageService->getImageWithHeadersByParams($request->validated());

        return response($image)->withHeaders($headers);
    }
}
