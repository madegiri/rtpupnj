<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PUTProdukResource\Pages;
use App\Filament\Resources\PUTProdukResource\RelationManagers;
use App\Models\PUTProduk;
use Filament\Forms;
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

class PUTProdukResource extends Resource
{
    protected static ?string $model = PUTProduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Produk PUT';

    protected static ?string $pluralModelLabel = 'Produk PUT';
    protected static ?string $navigationGroup = 'Pusat Unggulan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Section::make('Informasi Produk PUT')
                ->schema([
                    Select::make('unit_put_id')
                        ->label('Unit PUT')
                        ->relationship('kategoriProduk.unitPut', 'nama_singkat_unit_put')
                        ->required()
                        ->preload()
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(fn (Forms\Set $set) => $set('kategori_produk_put_id', null)),

                    Select::make('kategori_produk_put_id')
                        ->label('Kategori Produk')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->options(function (Forms\Get $get) {
                            $unitPutId = $get('unit_put_id');
                            if (!$unitPutId) return [];
                            return \App\Models\KategoriProdukPUT::where('unit_put_id', $unitPutId)
                                ->pluck('nama_kategori', 'id');
                        }),

                    TextInput::make('judul')
                        ->label('Nama Produk')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    RichEditor::make('isi')
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

                Forms\Components\Section::make('Media Produk PUT')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Thumbnail Produk')
                            ->image()
                            ->maxSize(512) 
                            ->required()
                            ->directory('put-produk/thumbnail'),

                        Forms\Components\FileUpload::make('poster')
                            ->label('Poster Produk')
                            ->image()
                            ->maxSize(512) 
                            ->required()
                            ->directory('put-produk/poster'),

                        Forms\Components\FileUpload::make('galeri')
                            ->label('Galeri Produk')
                            ->image()
                            ->maxSize(512) 
                            ->multiple()
                            ->required()
                            ->directory('put-produk/galeri'),

                        Forms\Components\FileUpload::make('video')
                            ->label('Video Produk')
                            ->directory('put-produk/video')
                            ->acceptedFileTypes(['video/mp4', 'video/webm'])
                            ->maxSize(12288) 
                            ->downloadable()
                            ->openable()
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail Produk'),

                TextColumn::make('judul')
                    ->label('Nama Produk')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('kategoriProduk.unitPut.nama_singkat_unit_put')
                    ->label('Unit PUT')
                    ->searchable(),

                TextColumn::make('kategoriProduk.nama_kategori')
                    ->label('Kategori Produk')
                    ->searchable(),
                
                TextColumn::make('created_at')->label('Tanggal Dibuat')->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('unit_put')
                    ->label('Filter Unit PUT')
                    ->relationship('kategoriProduk.unitPut', 'nama_singkat_unit_put')
                    ->preload()
                    ->searchable(),
                    
                SelectFilter::make('kategori_produk_put_id')
                    ->label('Filter Kategori')
                    ->relationship('kategoriProduk', 'nama_kategori')
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
            'index' => Pages\ListPUTProduks::route('/'),
            'create' => Pages\CreatePUTProduk::route('/create'),
            'edit' => Pages\EditPUTProduk::route('/{record}/edit'),
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
