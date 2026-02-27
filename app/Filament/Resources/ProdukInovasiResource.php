<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukInovasiResource\Pages;
use App\Filament\Resources\ProdukInovasiResource\RelationManagers;
use App\Models\ProdukInovasi;
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

class ProdukInovasiResource extends Resource
{
    protected static ?string $model = ProdukInovasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationLabel = 'Produk Inovasi'; 
    protected static ?string $pluralModelLabel = 'Produk Inovasi';
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
                
                FileUpload::make('gambar')
                    ->label('Thumbnail Produk')
                    ->image()
                    ->directory('produk-inovasi-gambar')
                    ->maxSize(512)
                    ->required(),
                
                FileUpload::make('galeri')
                    ->label('Galeri Produk')
                    ->required()
                    ->image()
                    ->directory('produk-inovasi-galeri')
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
            'index' => Pages\ListProdukInovasis::route('/'),
            'create' => Pages\CreateProdukInovasi::route('/create'),
            'edit' => Pages\EditProdukInovasi::route('/{record}/edit'),
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
