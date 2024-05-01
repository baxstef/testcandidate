<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Filament\Resources\CandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;


use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;

class ViewCandidate extends ViewRecord
{
    protected static string $resource = CandidateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('lastName')->required(),
                TextInput::make('firstName')->required(),
                // ...


                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('mobile')->rules('regex:/^\d{10}$/'),
                Select::make('degree_id')
                    ->relationship('degree', 'degreeTitle')
                    ->preload(),

                //                FileUpload::make('resume')->acceptedFileTypes(['resume/pdf'])->required(),
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
                DateTimePicker::make('applicationDate')->default(now())->disabled(),

            ]);
    }
}
