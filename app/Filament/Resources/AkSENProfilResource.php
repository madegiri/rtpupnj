<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AkSENProfilResource\Pages;
use App\Filament\Resources\AkSENProfilResource\RelationManagers;
use App\Models\AkSENProfil;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AkSENProfilResource extends Resource
{
    protected static ?string $model = AkSENProfil::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'AkSEN Profil'; 
    protected static ?string $pluralModelLabel = 'AkSEN Profil';
    protected static ?string $navigationGroup = 'PUT - AkSEN';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('aksen-profil-thumbnails')
                    ->maxSize(512) 
                    ->required(),
                
                RichEditor::make('deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('thumbnail'),

                TextColumn::make('deskripsi')->limit(50),

                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListAkSENProfils::route('/'),
            'create' => Pages\CreateAkSENProfil::route('/create'),
            'edit' => Pages\EditAkSENProfil::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
