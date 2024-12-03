<?php

namespace App\Filament\Resources;

use App\Enums\GameCategoryEnum;
use App\Enums\GameStatusEnum;
use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Filament\Resources\GameResource\RelationManagers\ReviewsRelationManager;
use App\Filament\Resources\GameResource\Widgets\GameOverview;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Jogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('igdb_id')
                    ->required()
                    ->disabled(),
                Forms\Components\TextInput::make('artworks_array')
                    ->disabled(),
                Forms\Components\TextInput::make('category')
                    ->disabled()
                    ->formatStateUsing(function (?int $state): string {
                        return GameCategoryEnum::tryFrom($state)?->name
                            ? ucfirst(str_replace('_', ' ', GameCategoryEnum::tryFrom($state)->name))
                            : 'Unknown';
                    }),
                Forms\Components\TextInput::make('checksum')
                    ->disabled()
                    ->maxLength(36),
                Forms\Components\TextInput::make('collections_array')
                    ->disabled(),
                Forms\Components\TextInput::make('cover_id')
                    ->disabled(),
                Forms\Components\TextInput::make('dlcs_array')
                    ->disabled(),
                Forms\Components\TextInput::make('expansions_array')
                    ->disabled(),
                Forms\Components\DateTimePicker::make('first_release_date')
                    ->disabled(),
                Forms\Components\TextInput::make('franchises_array')
                    ->disabled(),
                Forms\Components\TextInput::make('game_modes_array')
                    ->disabled(),
                Forms\Components\TextInput::make('genres_array')
                    ->disabled(),
                Forms\Components\TextInput::make('involved_companies_array')
                    ->disabled(),
                Forms\Components\TextInput::make('language_supports_array')
                    ->disabled(),
                Forms\Components\TextInput::make('multiplayer_modes_array')
                    ->disabled(),
                Forms\Components\TextInput::make('name')
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('parent_game_id')
                    ->disabled(),
                Forms\Components\TextInput::make('platforms_array')
                    ->disabled(),
                Forms\Components\TextInput::make('player_perspectives_array')
                    ->disabled(),
                Forms\Components\TextInput::make('release_dates_array')
                    ->disabled(),
                Forms\Components\TextInput::make('screenshots_array')
                    ->disabled(),
                Forms\Components\TextInput::make('similar_games_array')
                    ->disabled(),
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('standalone_expansions_array')
                    ->disabled(),
                Forms\Components\TextInput::make('status')
                    ->disabled()
                    ->formatStateUsing(function (?int $state): string {
                        return GameStatusEnum::tryFrom($state)?->name
                            ? ucfirst(str_replace('_', ' ', GameStatusEnum::tryFrom($state)->name))
                            : 'Unknown';
                    }),
                Forms\Components\Textarea::make('storyline')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('summary')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('themes_array')
                    ->disabled(),
                Forms\Components\TextInput::make('videos_array')
                    ->disabled(),
                Forms\Components\TextInput::make('websites_array')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('igdb_id')
                    ->label('ID IGDB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nome'),
                Tables\Columns\TextColumn::make('first_release_date')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->label('Data de lançamento'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('reviews_count')
                    ->counts('reviews')
                    ->label('Avaliações')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ReviewsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            GameOverview::class,
        ];
    }
}
