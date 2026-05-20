<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriLombaResource\Pages;
use App\Filament\Resources\KategoriLombaResource\RelationManagers;
use App\Models\KategoriLomba;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriLombaResource extends Resource
{
    protected static ?string $model = KategoriLomba::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationLabel = 'Kategori Lomba'; 
    protected static ?string $pluralModelLabel = 'Kategori Lomba'; 

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nama_kategori')
                    ->required()
                    ->label('Nama Kategori Lomba')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nama_kategori')
                    ->label('Nama Kategori Lomba')
                    ->searchable(),

                TextColumn::make('lomba_count')
                    ->label('Jumlah Lomba'),

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
                            $adaLomba = $records->filter(fn ($record) => $record->lomba()->exists());

                            if ($adaLomba->isNotEmpty()) {
                                $namaKategori = $adaLomba->pluck('nama_kategori')->join(', ');

                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Tidak bisa dihapus!')
                                    ->body("Kategori berikut masih memiliki lomba: {$namaKategori}. Semua penghapusan dibatalkan.")
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
            'index' => Pages\ListKategoriLombas::route('/'),
            'create' => Pages\CreateKategoriLomba::route('/create'),
            'edit' => Pages\EditKategoriLomba::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('lomba')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
