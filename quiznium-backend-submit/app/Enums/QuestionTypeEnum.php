<?php

namespace App\Enums;



use App\Traits\EnumToArray;

enum QuestionTypeEnum: string
{
    use EnumToArray;

    case multiple_choice = "multiple_choice";
    case single_choice = "single_choice";
}
