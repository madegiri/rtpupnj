<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LombaResource\Pages;
use App\Filament\Resources\LombaResource\RelationManagers;
use App\Models\KategoriLomba;
use App\Models\Lomba;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LombaResource extends Resource
{
    protected static ?string $model = Lomba::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Lomba'; 
    protected static ?string $pluralModelLabel = 'Lomba'; 

    protected static ?string $navigationGroup = 'Beranda';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('kategori_lomba_id')
                    ->label('Kategori')
                    ->relationship('kategoriLomba', 'nama_kategori')
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('nama_lomba')
                    ->label('Nama Lomba')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('penyelenggara')
                    ->label('Penyelenggara')
                    ->required()
                    ->maxLength(255),

                CheckboxList::make('kategori_peserta')
                    ->label('Kategori Peserta')
                    ->options(Lomba::KATEGORI_PESERTA)
                    ->columns(2)
                    ->required(),

                Select::make('jenis_pelaksanaan')
                    ->label('Jenis Pelaksanaan')
                    ->options(Lomba::JENIS_PELAKSANAAN)
                    ->required(),

                TextInput::make('link_pendaftaran')
                    ->label('Link Pendaftaran')
                    ->url()
                    ->required(),

                DatePicker::make('tanggal_mulai_pendaftaran')
                    ->label('Tanggal Mulai Pendaftaran')
                    ->required()
                    ->live() 
                    ->afterStateUpdated(function ($state, $set, $get) {
                        if ($get('tanggal_selesai_pendaftaran') && $get('tanggal_selesai_pendaftaran') < $state) {
                            $set('tanggal_selesai_pendaftaran', null);
                        }
                    }),

                DatePicker::make('tanggal_selesai_pendaftaran')
                    ->label('Tanggal Selesai Pendaftaran')
                    ->required()
                    ->minDate(fn($get) => $get('tanggal_mulai_pendaftaran')),

                FileUpload::make('gambar')
                    ->label('Poster Lomba')
                    ->image()
                    ->directory('lomba/poster')
                    ->maxSize(512) 
                    ->required(),

                RichEditor::make('deskripsi')
                    ->label('Deskripsi')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('gambar')
                    ->label('Poster'),

                TextColumn::make('nama_lomba')
                    ->label('Nama Lomba')
                    ->searchable(),

                TextColumn::make('kategoriLomba.nama_kategori')
                    ->label('Kategori Lomba'),

                TextColumn::make('tanggal_selesai_pendaftaran')
                    ->label('Deadline Pendaftaran Lomba')
                    ->formatStateUsing(fn ($state) => 
                    \Carbon\Carbon::parse($state)
                        ->locale('id')
                        ->translatedFormat('d F Y')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('kategoriLomba')
                    ->label('Kategori Lomba')
                    ->relationship('kategoriLomba', 'nama_kategori')
                    ->searchable()
                    ->preload(),
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
            'index' => Pages\ListLombas::route('/'),
            'create' => Pages\CreateLomba::route('/create'),
            'edit' => Pages\EditLomba::route('/{record}/edit'),
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
