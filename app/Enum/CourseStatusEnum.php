<?php

namespace app\Enum;

enum CourseStatusEnum: string
{
    case RECENT = 'recent';
    case FEATURED = 'featured';
    case TRENDING = 'trending';
}
