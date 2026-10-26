<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitPUTResource\Pages;
use App\Filament\Resources\UnitPUTResource\RelationManagers;
use App\Models\UnitPUT;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
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
                                    FileUpload::make('dukungan_kebijakan')
                                        ->label('Dukungan Aturan / Kebijakan (PDF)')
                                        ->acceptedFileTypes(['application/pdf'])
                                        ->maxSize(1024) 
                                        ->directory('put-profil/dukungan-kebijakan')
                                        ->columnSpanFull(),
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
                                    Repeater::make('sarana_prasarana')
                                        ->label('Sarana & Prasarana')
                                        ->schema([
                                            TextInput::make('nama')
                                                ->label('Nama Sarana & Prasarana')
                                                ->required()
                                                ->columnSpanFull(),

                                            FileUpload::make('foto')
                                                ->label('Foto')
                                                ->directory('put-profil/sarana-prasarana')
                                                ->image()
                                                ->multiple()
                                                ->reorderable()
                                                ->maxSize(512)
                                                ->imageEditor()
                                                ->columnSpanFull(),
                                        ])
                                        ->defaultItems(1)
                                        ->addActionLabel('Tambah Sarana & Prasarana')
                                        ->reorderable()
                                        ->columns(2)
                                        ->columnSpanFull(),
                                ]),
                            
                            Tabs\Tab::make('Roadmap')
                                ->schema([
                                    FileUpload::make('roadmap')
                                        ->label('Roadmap (Gambar)')
                                        ->image()
                                        ->maxSize(512)
                                        ->directory('put-profil/roadmap')
                                        ->columnSpanFull(),
                                ]),

                            Tabs\Tab::make('Struktur Organisasi')
                                ->schema([
                                    FileUpload::make('struktur_organisasi')
                                        ->label('Struktur Organisasi (Gambar)')
                                        ->image()
                                        ->maxSize(512)
                                        ->directory('struktur-organisasi-put/foto')
                                        ->columnSpanFull(),
                                ]),
                            
                            Tabs\Tab::make('Kegiatan')
                                ->schema([
                                    Tabs::make('Kegiatan')
                                        ->columnSpanFull()
                                        ->tabs([
                                            Tabs\Tab::make('Penelitian')
                                                ->schema([
                                                    Group::make()
                                                        ->statePath('penelitian')
                                                        ->columnSpanFull()
                                                        ->schema([
                                                            FileUpload::make('roadmap_gambar')
                                                                ->label('Roadmap Penelitian (Gambar)')
                                                                ->image()   
                                                                ->maxSize(512)
                                                                ->directory('put-profil/penelitian/roadmap')
                                                                ->columnSpanFull(),

                                                            Repeater::make('publikasi')
                                                                ->label('Publikasi')
                                                                ->schema([
                                                                    FileUpload::make('foto')
                                                                        ->label('Foto')
                                                                        ->directory('put-profil/penelitian/publikasi')
                                                                        ->image()
                                                                        ->maxSize(512)
                                                                        ->imageEditor()
                                                                        ->columnSpanFull(),

                                                                    TextInput::make('nama')
                                                                        ->label('Nama')
                                                                        ->columnSpanFull(),

                                                                    TextInput::make('link_sinta')
                                                                        ->label('Link SINTA')
                                                                        ->url(),

                                                                    TextInput::make('link_google_scholar')
                                                                        ->label('Link Google Scholar')
                                                                        ->url(),

                                                                    TextInput::make('link_orcid')
                                                                        ->label('Link ORCID')
                                                                        ->url(),
                                                                ])
                                                                ->defaultItems(1)
                                                                ->addActionLabel('Tambah Publikasi')
                                                                ->reorderable()
                                                                ->columns(2)
                                                                ->columnSpanFull(),
                                                        ]),
                                                ]),

                                            Tabs\Tab::make('Pengabdian Masyarakat')
                                                ->schema([
                                                    Repeater::make('pengabdian_masyarakat')
                                                        ->label('Pengabdian Masyarakat')
                                                        ->schema([
                                                            Hidden::make('created_at'),
                                                            Hidden::make('user_id'),

                                                            FileUpload::make('foto')
                                                                ->label('Foto Kegiatan')
                                                                ->directory('put-profil/pengabdian-masyarakat')
                                                                ->image()
                                                                ->maxSize(512)
                                                                ->imageEditor()
                                                                ->columnSpanFull(),

                                                            TextInput::make('judul')
                                                                ->label('Judul Kegiatan')
                                                                ->required()
                                                                ->distinct()
                                                                ->columnSpanFull(),

                                                            RichEditor::make('isi')
                                                                ->label('Isi Kegiatan')
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
                                                        ])
                                                        ->defaultItems(1)
                                                        ->addActionLabel('Tambah Kegiatan')
                                                        ->reorderable()
                                                        ->columns(2)
                                                        ->columnSpanFull(),
                                                ]),

                                            Tabs\Tab::make('Lecturer Series')
                                                ->schema([
                                                    RichEditor::make('lecturer_series')
                                                        ->label('Lecturer Series')
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

                                            Tabs\Tab::make('Magang Riset')
                                                ->schema([
                                                    RichEditor::make('magang_riset')
                                                        ->label('Magang Riset')
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

                                            Tabs\Tab::make('Kegiatan Lainnya')
                                                ->schema([
                                                    Repeater::make('kegiatan_lainnya')
                                                        ->label('Kegiatan Lainnya')
                                                        ->schema([
                                                            Hidden::make('created_at'),
                                                            Hidden::make('user_id'),
                                                            
                                                            FileUpload::make('foto')
                                                                ->label('Foto Kegiatan')
                                                                ->directory('put-profil/kegiatan-lainnya')
                                                                ->image()
                                                                ->maxSize(512)
                                                                ->imageEditor()
                                                                ->columnSpanFull(),

                                                            TextInput::make('judul')
                                                                ->label('Judul Kegiatan')
                                                                ->required()
                                                                ->distinct()
                                                                ->columnSpanFull(),

                                                            RichEditor::make('isi')
                                                                ->label('Isi Kegiatan')
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
                                                        ])
                                                        ->defaultItems(1)
                                                        ->addActionLabel('Tambah Kegiatan')
                                                        ->reorderable()
                                                        ->columns(2)
                                                        ->columnSpanFull(),
                                                ]),
                                        ]),
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
