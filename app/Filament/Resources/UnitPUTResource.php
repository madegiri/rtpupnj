<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitPUTResource\Pages;
use App\Filament\Resources\UnitPUTResource\RelationManagers;
use App\Models\UnitPUT;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitPUTResource extends Resource
{
    protected static ?string $model = UnitPUT::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Unit PUT';
    protected static ?string $pluralModelLabel = 'Unit PUT';
    protected static ?string $navigationGroup = 'Pusat Unggulan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Tabs::make('Unit PUT')
                    ->columnSpanFull()
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->schema([
                                TextInput::make('nama_singkat_unit_put')
                                    ->label('Nama Singkat Unit PUT')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true),

                                TextInput::make('nama_lengkap_unit_put')
                                    ->label('Nama Lengkap Unit PUT')
                                    ->required()
                                    ->maxLength(255),
                                
                                FileUpload::make('thumbnail')
                                    ->label('Logo Unit PUT')
                                    ->image()
                                    ->maxSize(512) 
                                    ->required()
                                    ->directory('put-profil/thumbnail'),

                                FileUpload::make('poster')
                                    ->label('Poster Produk PUT')
                                    ->image()
                                    ->maxSize(512) 
                                    ->nullable()
                                    ->multiple()
                                    ->directory('put-profil/poster'),
                            ])->columns(2),

                            Tabs\Tab::make('Profil')
                                ->schema([
                                    RichEditor::make('deskripsi')
                                        ->label('Deskripsi Unit PUT')
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
                                ]),
                            
                            Tabs\Tab::make('Visi & Misi')
                                ->schema([
                                    RichEditor::make('visi_misi')
                                        ->label('Visi & Misi')
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
                                ]),
                            
                            Tabs\Tab::make('Dukungan Kebijakan')
                                ->schema([
                                    RichEditor::make('dukungan_kebijakan')
                                        ->label('Dukungan Aturan / Kebijakan')
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
                                ]),

                            Tabs\Tab::make('Sumber Daya Manusia (SDM)')
                                ->schema([
                                    RichEditor::make('sdm')
                                        ->label('Sumber Daya Manusia (SDM)')
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
                                ]),

                            Tabs\Tab::make('Sarana & Prasarana')
                                ->schema([
                                    RichEditor::make('sarana_prasarana')
                                        ->label('Sarana & Prasarana')
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
                                ]),
                            
                            Tabs\Tab::make('Struktur Organisasi')
                                ->schema([
                                    Repeater::make('struktur_organisasi')
                                        ->label('Struktur Organisasi')
                                        ->schema([
                                            FileUpload::make('foto')
                                                ->label('Foto')
                                                ->directory('struktur-organisasi-put/foto')
                                                ->image()
                                                ->maxSize(512)
                                                ->imageEditor()
                                                ->columnSpanFull(),

                                            TextInput::make('nama')
                                                ->label('Nama'),

                                            TextInput::make('jabatan')
                                                ->label('Jabatan'),
                                        ])
                                        ->defaultItems(1)
                                        ->addActionLabel('Tambah Anggota')
                                        ->reorderable()
                                        ->columns(2)
                                        ->columnSpanFull(),
                                ]),
                            
                            Tabs\Tab::make('Roadmap')
                                ->schema([
                                    Repeater::make('roadmap')
                                        ->label('Roadmap')
                                        ->schema([
                                            TextInput::make('tahun')
                                                ->label('Tahun'),

                                            TextInput::make('tahap')
                                                ->label('Tahap')
                                                ->helperText('mis. Tahap 1, Tahap 2'),

                                            RichEditor::make('deskripsi_tahapan')
                                                ->label('Deskripsi Tahapan')
                                                ->columnSpanFull(),
                                        ])
                                        ->defaultItems(1)
                                        ->addActionLabel('Tambah Tahapan')
                                        ->reorderable()
                                        ->columns(2)
                                        ->columnSpanFull(),
                                ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('thumbnail')
                    ->label('Logo Unit PUT'),

                TextColumn::make('nama_singkat_unit_put')
                    ->label('Unit PUT')
                    ->searchable(),

                TextColumn::make('nama_lengkap_unit_put')
                    ->label('Nama Lengkap Unit PUT')
                    ->searchable(),
                
                TextColumn::make('kategori_produk_count')
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
                            $adaKategori = $records->filter(fn ($record) => $record->kategoriProduk()->exists());

                            if ($adaKategori->isNotEmpty()) {
                                $namaUnit = $adaKategori->pluck('nama_singkat_unit_put')->join(', ');

                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Tidak bisa dihapus!')
                                    ->body("Unit PUT berikut masih memiliki kategori produk: {$namaUnit}. Semua penghapusan dibatalkan.")
                                    ->send();

                                return;
                            }

                            $records->each->delete();

                            \Filament\Notifications\Notification::make()
                                ->success()
                                ->title('Berhasil dihapus!')
                                ->body($records->count() . ' Unit PUT berhasil dihapus.')
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
            'index' => Pages\ListUnitPUTS::route('/'),
            'create' => Pages\CreateUnitPUT::route('/create'),
            'edit' => Pages\EditUnitPUT::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('kategoriProduk')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
