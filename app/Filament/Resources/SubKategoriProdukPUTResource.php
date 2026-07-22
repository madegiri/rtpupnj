<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubKategoriProdukPUTResource\Pages;
use App\Filament\Resources\SubKategoriProdukPUTResource\RelationManagers;
use App\Models\SubKategoriProdukPUT;
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

class SubKategoriProdukPUTResource extends Resource
{
    protected static ?string $model = SubKategoriProdukPUT::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Sub Kategori Produk PUT';
    protected static ?string $pluralModelLabel = 'Sub Kategori Produk PUT';
    protected static ?string $navigationGroup = 'Pusat Unggulan';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('unit_put_id')
                    ->label('Unit PUT')
                    ->relationship('kategoriProdukPut.unitPut', 'nama_singkat_unit_put')
                    ->required()
                    ->preload()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(fn (Forms\Set $set) => $set('kategori_produk_put_id', null))
                    ->dehydrated(false), 

                Select::make('kategori_produk_put_id')
                    ->label('Kategori')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live()
                    ->options(function (Forms\Get $get) {
                        $unitPutId = $get('unit_put_id');
                        if (!$unitPutId) return [];
                        return \App\Models\KategoriProdukPUT::where('unit_put_id', $unitPutId)
                            ->pluck('nama_kategori', 'id');
                    }),

                TextInput::make('nama_sub_kategori')
                    ->required()
                    ->label('Nama Sub Kategori')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('kategoriProdukPut.unitPut.nama_singkat_unit_put')
                    ->label('Unit PUT')
                    ->searchable(),

                TextColumn::make('kategoriProdukPut.nama_kategori')
                    ->label('Kategori')
                    ->searchable(),

                TextColumn::make('nama_sub_kategori')
                    ->label('Nama Sub Kategori')
                    ->searchable(),

                TextColumn::make('put_produk_count')
                    ->label('Jumlah Produk'),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('kategori_produk_put_id')
                    ->label('Filter Kategori')
                    ->relationship('kategoriProdukPut', 'nama_kategori'),
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
                            $adaProduk = $records->filter(fn ($record) => $record->putProduk()->exists());

                            if ($adaProduk->isNotEmpty()) {
                                $nama = $adaProduk->pluck('nama_sub_kategori')->join(', ');

                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Tidak bisa dihapus!')
                                    ->body("Sub kategori berikut masih memiliki produk: {$nama}. Semua penghapusan dibatalkan.")
                                    ->send();

                                return;
                            }

                            $records->each->delete();

                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Berhasil dihapus!')
                                ->body($records->count() . ' sub kategori berhasil dihapus.')
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
            'index' => Pages\ListSubKategoriProdukPUTS::route('/'),
            'create' => Pages\CreateSubKategoriProdukPUT::route('/create'),
            'edit' => Pages\EditSubKategoriProdukPUT::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('putProduk')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
