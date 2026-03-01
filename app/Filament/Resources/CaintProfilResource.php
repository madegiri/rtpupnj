<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaintProfilResource\Pages;
use App\Filament\Resources\CaintProfilResource\RelationManagers;
use App\Models\CaintProfil;
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

class CaintProfilResource extends Resource
{
    protected static ?string $model = CaintProfil::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'CAINT Profil'; 
    protected static ?string $pluralModelLabel = 'CAINT Profil'; 
    protected static ?string $navigationGroup = 'PUT - CAINT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                FileUpload::make('thumbnail')
                    ->label('Logo')
                    ->image()
                    ->directory('caint-profil-thumbnails')
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
                
                FileUpload::make('poster')
                ->label('Poster Produk')
                ->image()
                ->directory('caint-profil-poster')
                ->multiple()
                ->minFiles(1)
                ->maxSize(512),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('thumbnail')->label('Logo'),

                TextColumn::make('deskripsi')->limit(50),

                TextColumn::make('created_at')->dateTime()->sortable()->label('Tanggal Dibuat'),
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
            'index' => Pages\ListCaintProfils::route('/'),
            'create' => Pages\CreateCaintProfil::route('/create'),
            'edit' => Pages\EditCaintProfil::route('/{record}/edit'),
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
