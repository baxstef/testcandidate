<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Filament\Resources\CandidateResource\RelationManagers;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;


class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('lastName')->required(),
                TextInput::make('firstName')->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('mobile')->rules('regex:/^\d{10}$/'),
                Select::make('degree_id')
                    ->relationship('degree', 'degreeTitle')
                    ->preload(),
                FileUpload::make('resume')
                    ->label('Resume')
                    ->acceptedFileTypes(['application/pdf']),
                Select::make('jobAppliedFor')
                    ->options([
                        'PHP Developer' => 'PHP Developer',
                        'JAVA Developer' => 'JAVA Developer',
                        'PYTHON Developer' => 'PYTHON Developer',
                        'ERP Support' => 'ERP Support',
                        'Sales' => 'Sales',
                        'Technician' => 'Technician',
                    ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lastName')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('firstName')
                    ->searchable()
                    ->sortable(),
                tables\Columns\TextColumn::make('email'),
                tables\Columns\TextColumn::make('mobile'),
                Tables\Columns\TextColumn::make('degree.degreeTitle')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jobAppliedFor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('applicationDate'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jobAppliedFor')
                    ->options([
                        'PHP Developer' => 'PHP Developer',
                        'JAVA Developer' => 'JAVA Developer',
                        'PYTHON Developer' => 'PYTHON Developer',
                        'ERP Support' => 'ERP Support',
                        'Sales' => 'Sales',
                        'Technician' => 'Technician',
                    ])
                    ->label('Job Applied For'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'view' => Pages\ViewCandidate::route('/{record}'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
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
