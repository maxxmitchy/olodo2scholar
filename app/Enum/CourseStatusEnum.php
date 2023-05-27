<?php

declare(strict_types=1);

namespace app\Enum;

enum CourseStatusEnum: string
{
    case RECENT = 'recent';
    case FEATURED = 'featured';
    case TRENDING = 'trending';
}
