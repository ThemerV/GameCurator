<?php

namespace App\Filament\Resources\GameResource\Widgets;

use App\Models\Game;
use App\Models\Playlist;
use App\Models\Review;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GameOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Jogos', Game::count()),
            Stat::make('Playlists', Playlist::count()),
            Stat::make('Avaliações', Review::count()),
            Stat::make('Usuários', User::count()),
        ];
    }
}
