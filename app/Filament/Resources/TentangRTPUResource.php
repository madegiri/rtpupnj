<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TentangRTPUResource\Pages;
use App\Filament\Resources\TentangRTPUResource\RelationManagers;
use App\Models\TentangRTPU;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TentangRTPUResource extends Resource
{
    protected static ?string $model = TentangRTPU::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Tentang RTPU'; 
    protected static ?string $pluralModelLabel = 'Tentang RTPU';
    protected static ?string $navigationGroup = 'Tentang RTPU';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                FileUpload::make('logo')
                ->label('Logo RTPU')
                ->required()
                ->image()
                ->directory('tentang-logo-rtpu')
                ->maxSize(512),

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
                ImageColumn::make('logo')->label('Logo RTPU'),
                TextColumn::make('isi')->limit(50)->searchable()->sortable()->label('Tentang RTPU'),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Tanggal Dibuat'),
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
            'index' => Pages\ListTentangRTPUS::route('/'),
            'create' => Pages\CreateTentangRTPU::route('/create'),
            'edit' => Pages\EditTentangRTPU::route('/{record}/edit'),
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
