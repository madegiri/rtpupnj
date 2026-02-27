<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SertifikasiResource\Pages;
use App\Filament\Resources\SertifikasiResource\RelationManagers;
use App\Models\Sertifikasi;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Symfony\Component\HttpFoundation\File\File;

class SertifikasiResource extends Resource
{
    protected static ?string $model = Sertifikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationLabel = 'Sertifikasi'; 
    protected static ?string $pluralModelLabel = 'Sertifikasi';
    protected static ?string $navigationGroup = 'Sertifikasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('penyelenggara')
                    ->required()
                    ->maxLength(255),
                
                FileUpload::make('gambar')
                    ->image()
                    ->directory('sertifikasi-gambar')
                    ->maxSize(512)
                    ->required(),
                
                RichEditor::make('deskripsi')
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
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('penyelenggara')->searchable()->sortable(),
                ImageColumn::make('gambar'),
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
            'index' => Pages\ListSertifikasis::route('/'),
            'create' => Pages\CreateSertifikasi::route('/create'),
            'edit' => Pages\EditSertifikasi::route('/{record}/edit'),
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
