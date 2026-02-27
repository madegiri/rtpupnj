<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelInovasiResource\Pages;
use App\Filament\Resources\ArtikelInovasiResource\RelationManagers;
use App\Models\ArtikelInovasi;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArtikelInovasiResource extends Resource
{
    protected static ?string $model = ArtikelInovasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Artikel Inovasi'; 
    protected static ?string $pluralModelLabel = 'Artikel Inovasi'; 

    protected static ?string $navigationGroup = 'Beranda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('thumbnail')
                    ->image()
                    ->directory('artikel-inovasi-thumbnails')
                    ->maxSize(512) // Maksimal ukuran file dalam KB (1 MB)
                    ->required(),

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
                Tables\Columns\TextColumn::make('judul')->searchable()->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            'index' => Pages\ListArtikelInovasis::route('/'),
            'create' => Pages\CreateArtikelInovasi::route('/create'),
            'edit' => Pages\EditArtikelInovasi::route('/{record}/edit'),
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
