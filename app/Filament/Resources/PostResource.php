<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use Filament\Forms\FormsComponent;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\KeyValue::make('meta')
                // ->default([])
                // ->live(onBlur: true)
                // ->live()
                ,

                Forms\Components\Fieldset::make('result')
                    ->schema([
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('show')
                                ->color('info')
                                ->action(function (Get $get) {
                                    dump($get('meta'));
                                }),
                            Forms\Components\Actions\Action::make('clear')
                                ->color('danger')
                                ->action(fn (Set $set) => $set('meta', [])),
                        ])->columnSpanFull(),
                    ]),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Fieldset::make('dot (A-B-C)')
                            ->columnSpan(1)
                            ->columns(1)
                            ->schema([
                                Forms\Components\Actions::make([
                                    Forms\Components\Actions\Action::make('DotButtonOne')
                                        ->label('A => Foo | B => Bar | C => Baz')
                                        ->action(function (Set $set) {
                                            $set('meta.a', 'foo');
                                            $set('meta.b', 'bar');
                                            $set('meta.c', 'baz');
                                        }),
                                    Forms\Components\Actions\Action::make('DotButtonTwo')
                                        ->label('A => This | B => Is | C => Sparta')
                                        ->action(function (Set $set) {
                                            $set('meta.a', 'this');
                                            $set('meta.b', 'is');
                                            $set('meta.c', 'sparta');
                                        }),
                                ]),
                            ]),
                        Forms\Components\Fieldset::make('dot (X-Y-Z)')
                            ->columnSpan(1)
                            ->columns(1)
                            ->schema([
                                Forms\Components\Actions::make([
                                    Forms\Components\Actions\Action::make('DotButtonThree')
                                        ->label('X => Foo | Y => Bar | Z => Baz')
                                        ->action(function (Set $set) {
                                            $set('meta.x', 'foo');
                                            $set('meta.y', 'bar');
                                            $set('meta.z', 'baz');
                                        }),
                                    Forms\Components\Actions\Action::make('DotButtonFour')
                                        ->label('X => This | Y => Is | Z => Sparta')
                                        ->action(function (Set $set) {
                                            $set('meta.x', 'this');
                                            $set('meta.y', 'is');
                                            $set('meta.z', 'sparta');
                                        }),
                                ]),
                            ]),
                        Forms\Components\Fieldset::make('array (A-B-C)')
                            ->columnSpan(1)
                            ->columns(1)
                            ->schema([
                                Forms\Components\Actions::make([
                                    Forms\Components\Actions\Action::make('ArrayButtonOne')
                                        ->label('A => Foo | B => Bar | C => Baz')
                                        ->action(function (Set $set) {
                                            $set('meta', [
                                                'a' => 'foo',
                                                'b' => 'bar',
                                                'c' => 'baz',
                                            ]);
                                        }),
                                    Forms\Components\Actions\Action::make('ArrayButtonTwo')
                                        ->label('A => This | B => Is | C => Sparta')
                                        ->action(function (Set $set) {
                                            $set('meta', [
                                                'a' => 'this',
                                                'b' => 'is',
                                                'c' => 'sparta'
                                            ]);
                                        }),
                                ]),
                            ]),
                        Forms\Components\Fieldset::make('array (X-Y-Z)')
                            ->columnSpan(1)
                            ->columns(1)
                            ->schema([
                                Forms\Components\Actions::make([
                                    Forms\Components\Actions\Action::make('ArrayButtonThree')
                                        ->label('X => Foo | Y => Bar | Z => Baz')
                                        ->action(function (Set $set) {
                                            $set('meta', [
                                                'x' => 'foo',
                                                'y' => 'bar',
                                                'z' => 'baz',
                                            ]);
                                        }),
                                    Forms\Components\Actions\Action::make('ArrayButtonFour')
                                        ->label('X => This | Y => Is | Z => Sparta')
                                        ->action(function (Set $set) {
                                            $set('meta', [
                                                'x' => 'this',
                                                'y' => 'is',
                                                'z' => 'sparta'
                                            ]);
                                        }),
                                ]),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
