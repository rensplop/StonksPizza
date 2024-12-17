<?php

namespace App\Enums;

enum BestelStatus: string
{
    case Initieel = 'initieel';
    case Betaald = 'betaald';
    case Bereiden = 'bereiden';
    case InOven = 'in_oven';
    case Onderweg = 'onderweg';
    case Bezorgd = 'bezorgd';
}
