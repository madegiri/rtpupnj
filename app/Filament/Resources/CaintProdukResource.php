<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaintProdukResource\Pages;
use App\Filament\Resources\CaintProdukResource\RelationManagers;
use App\Models\CaintProduk;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
use Nette\Utils\Image;

class CaintProdukResource extends Resource
{
    protected static ?string $model = CaintProduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'CAINT Produk'; 
    protected static ?string $pluralModelLabel = 'CAINT Produk'; 
    protected static ?string $navigationGroup = 'PUT - CAINT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('judul')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255),
                
                FileUpload::make('thumbnail')
                    ->label('Thumbnail Produk')
                    ->image()
                    ->directory('caint-produk-thumbnails')
                    ->maxSize(512) 
                    ->required(),
                
                Select::make('kategori')
                    ->options(CaintProduk::KATEGORIS)
                    ->required()
                    ->native(false),
                
                FileUpload::make('galeri')
                    ->image()
                    ->label('Galeri Produk')
                    ->directory('caint-produk-galeri')
                    ->maxSize(512) 
                    ->required()
                    ->multiple()
                    ->minFiles(1)
                    ->maxFiles(10),
                
                RichEditor::make('isi')
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
                TextColumn::make('judul')->label('Nama Produk')->sortable()->searchable(),
                ImageColumn::make('thumbnail')->label('Thumbnail Produk'),
                TextColumn::make('kategori')
                ->badge()
                ->color(fn (string $state): string => match($state) {
                    'Smart Campus'              => 'primary',
                    'Green Energy'              => 'success',
                    'Industrial Automation'     => 'danger',
                    'Agriculture & Environment' => 'warning',
                    'Healthcare'                => 'info',
                    default                     => 'gray',
                }),
                TextColumn::make('created_at')->label('Tanggal Dibuat')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('kategori')
                    ->options(CaintProduk::KATEGORIS)
                    ->label('Kategori'),
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
            'index' => Pages\ListCaintProduks::route('/'),
            'create' => Pages\CreateCaintProduk::route('/create'),
            'edit' => Pages\EditCaintProduk::route('/{record}/edit'),
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
