<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriProdukPekanInovasiResource\Pages;
use App\Filament\Resources\KategoriProdukPekanInovasiResource\RelationManagers;
use App\Models\KategoriProdukPekanInovasi;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriProdukPekanInovasiResource extends Resource
{
    protected static ?string $model = KategoriProdukPekanInovasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Kategori Produk Pekan Inovasi';
    protected static ?string $pluralModelLabel = 'Kategori Produk Pekan Inovasi';
    protected static ?string $navigationGroup = 'Pekan Inovasi';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('profil_pekan_inovasi_id')
                    ->label('Profil Pekan Inovasi')
                    ->relationship('profilPekanInovasi', 'nama_pekan_inovasi')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('nama_kategori')
                    ->required()
                    ->label('Nama Kategori Produk Pekan Inovasi')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('profilPekanInovasi.nama_pekan_inovasi')
                    ->label('Nama Pekan Inovasi')
                    ->searchable(),

                TextColumn::make('nama_kategori')
                    ->label('Nama Kategori Produk')
                    ->searchable(),

                TextColumn::make('produk_pekan_inovasi_count')
                    ->label('Jumlah Produk Terkait'),

                TextColumn::make('created_at')->label('Tanggal Dibuat')->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('profil_pekan_inovasi_id')
                    ->label('Filter by Pekan Inovasi')
                    ->relationship('profilPekanInovasi', 'nama_pekan_inovasi'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('delete')
                        ->label('Delete Selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $adaProduk = $records->filter(
                                fn ($record) => $record->produkPekanInovasi()->exists()
                            );

                            if ($adaProduk->isNotEmpty()) {
                                $namaKategori = $adaProduk->pluck('nama_kategori')->join(', ');

                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Tidak bisa dihapus!')
                                    ->body("Kategori berikut masih memiliki produk: {$namaKategori}. Semua penghapusan dibatalkan.")
                                    ->send();

                                return;
                            }

                            $records->each->delete();

                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Berhasil dihapus!')
                                ->body($records->count() . ' kategori berhasil dihapus.')
                                ->send();
                        }),
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
            'index' => Pages\ListKategoriProdukPekanInovasis::route('/'),
            'create' => Pages\CreateKategoriProdukPekanInovasi::route('/create'),
            'edit' => Pages\EditKategoriProdukPekanInovasi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('produkPekanInovasi')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
