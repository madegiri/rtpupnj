<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukUnggulanResource\Pages;
use App\Filament\Resources\ProdukUnggulanResource\RelationManagers;
use App\Models\ProdukUnggulan;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nette\Utils\Image;
use Symfony\Component\HttpFoundation\File\File;

class ProdukUnggulanResource extends Resource
{
    protected static ?string $model = ProdukUnggulan::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Produk Unggulan'; 
    protected static ?string $pluralModelLabel = 'Produk Unggulan';
    protected static ?string $navigationGroup = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nama')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255),
                
                FileUpload::make('poster')
                    ->label('Poster Produk')
                    ->required()
                    ->image()
                    ->directory('produk-unggulan-poster')
                    ->maxSize(512),
                
                FileUpload::make('gambar')
                    ->label('Thumbnail Produk')
                    ->image()
                    ->directory('produk-unggulan-gambar')
                    ->maxSize(512)
                    ->required(),
                
                FileUpload::make('galeri')
                    ->label('Galeri Produk')
                    ->required()
                    ->image()
                    ->directory('produk-unggulan-galeri')
                    ->maxSize(512)
                    ->multiple()
                    ->minFiles(1)
                    ->maxFiles(10),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi Produk')
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
                TextColumn::make('nama')->label('Nama Produk')->limit(50)->searchable()->sortable(),
                ImageColumn::make('poster')->label('Poster Produk'),
                ImageColumn::make('gambar')->label('Thumbnail Produk'),
                TextColumn::make('created_at')->label('Tanggal Dibuat')->dateTime()->sortable(),
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
            'index' => Pages\ListProdukUnggulans::route('/'),
            'create' => Pages\CreateProdukUnggulan::route('/create'),
            'edit' => Pages\EditProdukUnggulan::route('/{record}/edit'),
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
