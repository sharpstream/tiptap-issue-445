<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                [
                    // Forms\Components\TextInput::make('rich_text'),
                    \FilamentTiptapEditor\TiptapEditor::make('rich_text')
                        ->label('Rich Text')
                        ->bubbleMenuTools(['bold', 'italic', 'underline', 'strike'])
                        ->disableFloatingMenus()
                        ->disableToolbarMenus()
                        ->output(\FilamentTiptapEditor\Enums\TiptapOutput::Json)
                        ->live()
                        ->extraInputAttributes(['style' => 'min-height: 6rem; max-height: 6rem;']),

                    Forms\Components\Textarea::make('plain_text')->label('Plain Text'),
                ]
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                [
                    Tables\Columns\TextColumn::make('plain_text')
                        ->searchable(),
                    /*
                    Tables\Columns\TextColumn::make('rich_text')
                        ->searchable(),
                    */
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ]
            )
            ->filters(
                [
                    //
                ]
            )
            ->actions(
                [
                    Tables\Actions\EditAction::make(),
                ]
            )
            ->bulkActions(
                [
                    Tables\Actions\BulkActionGroup::make(
                        [
                            Tables\Actions\DeleteBulkAction::make(),
                        ]
                    ),
                ]
            );
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
