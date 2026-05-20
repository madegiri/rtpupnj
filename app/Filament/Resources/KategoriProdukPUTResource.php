<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriProdukPUTResource\Pages;
use App\Filament\Resources\KategoriProdukPUTResource\RelationManagers;
use App\Models\KategoriProdukPUT;
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

class KategoriProdukPUTResource extends Resource
{
    protected static ?string $model = KategoriProdukPUT::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationLabel = 'Kategori Produk PUT';
    protected static ?string $pluralModelLabel = 'Kategori Produk PUT';
    protected static ?string $navigationGroup = 'Pusat Unggulan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('unit_put_id')
                    ->label('Unit PUT')
                    ->relationship('unitPut', 'nama_singkat_unit_put')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('nama_kategori')
                    ->required()
                    ->label('Nama Kategori Produk PUT')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('UnitPUT.nama_singkat_unit_put')
                    ->label('Unit PUT')
                    ->searchable(),

                TextColumn::make('nama_kategori')
                    ->label('Nama Kategori Produk PUT')
                    ->searchable(),
                
                TextColumn::make('put_produk_count')
                    ->label('Jumlah Produk'),
                
                TextColumn::make('created_at')->label('Tanggal Dibuat')->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('unit_put_id')
                    ->label('Filter by Unit PUT')
                    ->relationship('unitPut', 'nama_singkat_unit_put'),
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
            'index' => Pages\ListKategoriProdukPUTS::route('/'),
            'create' => Pages\CreateKategoriProdukPUT::route('/create'),
            'edit' => Pages\EditKategoriProdukPUT::route('/{record}/edit'),
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
