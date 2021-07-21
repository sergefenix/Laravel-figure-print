<?php

namespace App\Http\Requests\Figure;

use App\Enums\FigureEnum;
use App\Enums\FigureFormatResponseEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class FigureRequest extends FormRequest
{
    public function rules(): array
    {
        $rectangle = FigureEnum::rectangle()->value;
        $ellipse = FigureEnum::ellipse()->value;
        $triangle = FigureEnum::triangle()->value;

        return [
            'type' => ['required', new EnumRule(FigureEnum::class)],
            'format' => ['required', new EnumRule(FigureFormatResponseEnum::class)],

            'background' => ['required', 'array'],
            'background.width' => ['required', 'int'],
            'background.height' => ['required', 'int'],

            'color' => ['required', 'array'],
            'color.red' => ['required', 'int'],
            'color.green' => ['required', 'int'],
            'color.blue' => ['required', 'int'],

            'params' => ['required', 'array'],

            "params.{$rectangle}" => ["required_without:params.{$ellipse}", "required_without:params.{$triangle}"],
            "params.{$rectangle}.x1" => ["required_with:params.{$rectangle}", 'int'],
            "params.{$rectangle}.y1" => ["required_with:params.{$rectangle}", 'int'],
            "params.{$rectangle}.x2" => ["required_with:params.{$rectangle}", 'int'],
            "params.{$rectangle}.y2" => ["required_with:params.{$rectangle}", 'int'],

            "params.{$ellipse}" => ["required_without:params.{$rectangle}"], "required_without:params.{$triangle}",
            "params.{$ellipse}.cx" => ["required_with:params.{$ellipse}", 'int'],
            "params.{$ellipse}.cy" => ["required_with:params.{$ellipse}", 'int'],
            "params.{$ellipse}.width" => ["required_with:params.{$ellipse}", 'int'],
            "params.{$ellipse}.height" => ["required_with:params.{$ellipse}", 'int'],

            "params.{$triangle}" => ["required_without:params.{$rectangle}", "required_without:params.{$ellipse}"],
            "params.{$triangle}.points" => ["required_with:params.{$triangle}", 'array'],
            "params.{$triangle}.points.*" => ["required_with:params.{$triangle}.points", 'int'],
        ];
    }
}
