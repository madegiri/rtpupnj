<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilPekanInovasiResource\Pages;
use App\Filament\Resources\ProfilPekanInovasiResource\RelationManagers;
use App\Models\ProfilPekanInovasi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfilPekanInovasiResource extends Resource
{
    protected static ?string $model = ProfilPekanInovasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationLabel = 'Profil Pekan Inovasi';
    protected static ?string $pluralModelLabel = 'Profil Pekan Inovasi';
    protected static ?string $navigationGroup = 'Pekan Inovasi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Profil Pekan Inovasi')
                ->schema([
                    TextInput::make('nama_pekan_inovasi')
                        ->required()
                        ->label('Nama Pekan Inovasi')
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    RichEditor::make('deskripsi')
                        ->label('Deskripsi Pekan Inovasi')
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

                Section::make('Media Profil Pekan Inovasi')
                ->collapsible()
                ->schema([
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail Pekan Inovasi')
                        ->image()
                        ->maxSize(512) 
                        ->required()
                        ->directory('profil-pekan-inovasi/thumbnail'),

                    FileUpload::make('poster')
                        ->label('Poster Produk Pekan Inovasi')
                        ->image()
                        ->maxSize(512) 
                        ->nullable()
                        ->multiple()
                        ->directory('profil-pekan-inovasi/poster'),

                    FileUpload::make('galeri_kegiatan')
                        ->label('Galeri Kegiatan Pekan Inovasi')
                        ->image()
                        ->maxSize(512) 
                        ->reorderable()
                        ->appendFiles()
                        ->multiple()
                        ->columnSpanFull()
                        ->directory('profil-pekan-inovasi/galeri-kegiatan'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail Pekan Inovasi'),

                TextColumn::make('nama_pekan_inovasi')
                    ->label('Nama Pekan Inovasi')
                    ->searchable(),
                
                TextColumn::make('kategori_produk_pekan_inovasi_count')
                    ->label('Jumlah Kategori Produk'),
                
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
                            $adaKategori = $records->filter(fn ($record) => $record->kategoriProdukPekanInovasi()->exists());

                            if ($adaKategori->isNotEmpty()) {
                                $namaPekanInovasi = $adaKategori->pluck('nama_pekan_inovasi')->join(', ');

                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Tidak bisa dihapus!')
                                    ->body("Pekan inovasi berikut masih memiliki kategori produk: {$namaPekanInovasi}. Semua penghapusan dibatalkan.")
                                    ->send();

                                return;
                            }

                            $records->each->delete();

                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Berhasil dihapus!')
                                ->body($records->count() . ' Profil pekan inovasi berhasil dihapus.')
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
            'index' => Pages\ListProfilPekanInovasis::route('/'),
            'create' => Pages\CreateProfilPekanInovasi::route('/create'),
            'edit' => Pages\EditProfilPekanInovasi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('kategoriProdukPekanInovasi')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
