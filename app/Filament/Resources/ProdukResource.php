<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Data Produk';

    protected static ?string $pluralModelLabel = 'Data Produk';
    protected static ?string $navigationGroup = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Section::make('Informasi Produk')
                ->schema([
                    Select::make('kategori_produk_id')
                        ->label('Kategori Produk')
                        ->relationship('kategoriProduk', 'nama_kategori_produk')
                        ->preload()
                        ->searchable()
                        ->required(),
                
                    TextInput::make('nama')
                        ->label('Nama Produk')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

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
                ])->columns(2),

                Forms\Components\Section::make('Media Produk')
                ->schema([

                    FileUpload::make('gambar')
                        ->label('Thumbnail Produk')
                        ->image()
                        ->directory('produk-gambar')
                        ->maxSize(512)
                        ->required(),
                        
                    FileUpload::make('poster')
                        ->label('Poster Produk')
                        ->required()
                        ->image()
                        ->directory('produk-poster')
                        ->maxSize(512),
                    
                    FileUpload::make('galeri')
                        ->label('Galeri Produk')
                        ->required()
                        ->image()
                        ->directory('produk-galeri')
                        ->maxSize(512)
                        ->multiple()
                        ->minFiles(1)
                        ->maxFiles(10),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nama')->label('Nama Produk')->limit(50)->searchable(),
                TextColumn::make('kategoriProduk.nama_kategori_produk')->label('Kategori Produk'),
                ImageColumn::make('poster')->label('Poster Produk'),
                ImageColumn::make('gambar')->label('Thumbnail Produk'),
                TextColumn::make('created_at')->label('Tanggal Dibuat')->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('kategori_produk_id')
                    ->label('Filter Kategori Produk')
                    ->relationship('kategoriProduk', 'nama_kategori_produk')
                    ->preload()
                    ->searchable(),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
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
