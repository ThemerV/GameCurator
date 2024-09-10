<?php

namespace App\Enums;

enum GameCategoryEnum: int
{
    case main_game = 0;
    case dlc_addon = 1;
    case expansion = 2;
    case bundle = 3;
    case standalone_expansion = 4;
    case mod = 5;
    case episode = 6;
    case season = 7;
    case remake = 8;
    case remaster = 9;
    case expanded_game = 10;
    case port = 11;
    case fork = 12;
    case pack = 13;
    case update = 14;
}
