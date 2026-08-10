<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukPekanInovasiResource\Pages;
use App\Filament\Resources\ProdukPekanInovasiResource\RelationManagers;
use App\Models\KategoriProdukPekanInovasi;
use App\Models\ProdukPekanInovasi;
use App\Models\ProfilPekanInovasi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
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

class ProdukPekanInovasiResource extends Resource
{
    protected static ?string $model = ProdukPekanInovasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Produk Pekan Inovasi';

    protected static ?string $pluralModelLabel = 'Produk Pekan Inovasi';
    protected static ?string $navigationGroup = 'Pekan Inovasi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Informasi Produk Pekan Inovasi')
                ->schema([
                    Select::make('profil_pekan_inovasi_id')
                        ->label('Pekan Inovasi')
                        ->options(ProfilPekanInovasi::pluck('nama_pekan_inovasi', 'id'))
                        ->required()
                        ->preload()
                        ->searchable()
                        ->live()
                        ->afterStateUpdated(fn (Forms\Set $set) => $set('kategori_produk_pekan_inovasi_id', null))
                        ->dehydrated(false),

                    Select::make('kategori_produk_pekan_inovasi_id')
                            ->label('Kategori Produk')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->options(function (Forms\Get $get) {
                                $profilPekanInovasiId = $get('profil_pekan_inovasi_id');
                                if (!$profilPekanInovasiId) return [];
                                return KategoriProdukPekanInovasi::where('profil_pekan_inovasi_id', $profilPekanInovasiId)
                                    ->pluck('nama_kategori', 'id');
                            }),

                        TextInput::make('judul')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),

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

                Section::make('Media Produk')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail Produk')
                            ->image()
                            ->maxSize(512)
                            ->required()
                            ->directory('pekan-inovasi-produk/thumbnail'),

                        FileUpload::make('poster')
                            ->label('Poster Produk')
                            ->image()
                            ->maxSize(512)
                            ->required()
                            ->directory('pekan-inovasi-produk/poster'),

                        FileUpload::make('galeri')
                            ->label('Galeri Produk')
                            ->image()
                            ->maxSize(512)
                            ->reorderable()
                            ->appendFiles()
                            ->multiple()
                            ->required()
                            ->directory('pekan-inovasi-produk/galeri'),

                        TextInput::make('video')
                            ->label('Link Video Produk')
                            ->helperText('Tempel link YouTube atau Google Drive. Untuk tampilan terbaik di HP, disarankan pakai YouTube.')
                            ->url(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('thumbnail')->label('Thumbnail Produk'),
                TextColumn::make('judul')->searchable()->limit(50)->label('Nama Produk'),
                TextColumn::make('kategoriProdukPekanInovasi.profilPekanInovasi.nama_pekan_inovasi')
                    ->label('Nama Pekan Inovasi')
                    ->searchable(),
                TextColumn::make('kategoriProdukPekanInovasi.nama_kategori')
                    ->label('Kategori Produk'),
                TextColumn::make('created_at')->label('Tanggal Dibuat')->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('profil_pekan_inovasi_id')
                    ->label('Pekan Inovasi')
                    ->relationship('kategoriProdukPekanInovasi.profilPekanInovasi', 'nama_pekan_inovasi'),

                SelectFilter::make('kategori_produk_pekan_inovasi_id')
                    ->label('Kategori Produk')
                    ->relationship('kategoriProdukPekanInovasi', 'nama_kategori'),
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
            'index' => Pages\ListProdukPekanInovasis::route('/'),
            'create' => Pages\CreateProdukPekanInovasi::route('/create'),
            'edit' => Pages\EditProdukPekanInovasi::route('/{record}/edit'),
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
