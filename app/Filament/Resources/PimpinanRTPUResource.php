<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PimpinanRTPUResource\Pages;
use App\Filament\Resources\PimpinanRTPUResource\RelationManagers;
use App\Models\PimpinanRTPU;
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
use Nette\Utils\Image;

class PimpinanRTPUResource extends Resource
{
    protected static ?string $model = PimpinanRTPU::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Pimpinan RTPU'; 
    protected static ?string $pluralModelLabel = 'Pimpinan RTPU';
    protected static ?string $navigationGroup = 'Tentang RTPU';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                
                FileUpload::make('foto')
                    ->image()
                    ->directory('pimpinan-rtpu-foto')
                    ->maxSize(512)
                    ->required(),
                
                TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255),
                
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
                TextColumn::make('jabatan')->searchable()->sortable(),
                ImageColumn::make('foto'),
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
            'index' => Pages\ListPimpinanRTPUS::route('/'),
            'create' => Pages\CreatePimpinanRTPU::route('/create'),
            'edit' => Pages\EditPimpinanRTPU::route('/{record}/edit'),
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
