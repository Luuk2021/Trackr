<?php
namespace App\Enum;

enum PackageStatusEnum:string
{
    case REGISTERED = 'registered';
    case PRINTED = 'printed';
    case IN_SORTING_CENTER = 'in_sorting_center';
    case ON_THE_WAY = 'on_the_way';
    case DELIVERED = 'delivered';
}