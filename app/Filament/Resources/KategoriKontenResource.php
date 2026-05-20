<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriKontenResource\Pages;
use App\Filament\Resources\KategoriKontenResource\RelationManagers;
use App\Models\KategoriKonten;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriKontenResource extends Resource
{
    protected static ?string $model = KategoriKonten::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationLabel = 'Kategori Konten'; 
    protected static ?string $pluralModelLabel = 'Kategori Konten'; 

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nama_kategori_konten')
                    ->required()
                    ->label('Nama Kategori Konten')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nama_kategori_konten')
                    ->label('Nama Kategori Konten')
                    ->searchable(),

                TextColumn::make('konten_count')
                    ->label('Jumlah Konten Terkait'),

                TextColumn::make('created_at')->label('Tanggal Dibuat')->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->timezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y, H:i') . ' WIB'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
                            $adaKonten = $records->filter(fn ($record) => $record->konten()->exists());

                            if ($adaKonten->isNotEmpty()) {
                                $namaKategori = $adaKonten->pluck('nama_kategori_konten')->join(', ');

                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Tidak bisa dihapus!')
                                    ->body("Kategori berikut masih memiliki konten: {$namaKategori}. Semua penghapusan dibatalkan.")
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
            'index' => Pages\ListKategoriKontens::route('/'),
            'create' => Pages\CreateKategoriKonten::route('/create'),
            'edit' => Pages\EditKategoriKonten::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('konten')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
