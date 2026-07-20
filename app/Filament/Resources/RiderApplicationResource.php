<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiderApplicationResource\Pages\ListRiderApplications;
use App\Filament\Resources\RiderApplicationResource\Pages\ViewRiderApplication;
use App\Models\RiderApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class RiderApplicationResource extends Resource
{
    protected static ?string $model = RiderApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Driver Applications';

    protected static ?string $pluralLabel = 'Driver Applications';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public static function canView($record): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])->columns(3),

                Forms\Components\Section::make('Vehicle Information')
                    ->schema([
                        Forms\Components\Select::make('vehicle_type')
                            ->options([
                                'bike' => 'Motorcycle / Bike',
                                'car' => 'Car (Sedan/Hatchback)',
                                'cng' => 'CNG / Auto-rickshaw',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('license_plate')
                            ->required()
                            ->maxLength(20)
                            ->uppercase(),
                    ])->columns(2),

                Forms\Components\Section::make('Documents')
                    ->schema([
                        Forms\Components\FileUpload::make('verification_documents.nid_front')
                            ->label('NID Front')
                            ->image()
                            ->directory('driver-applications/nid')
                            ->required(),
                        Forms\Components\FileUpload::make('verification_documents.nid_back')
                            ->label('NID Back')
                            ->image()
                            ->directory('driver-applications/nid')
                            ->required(),
                        Forms\Components\FileUpload::make('verification_documents.driving_license')
                            ->label('Driving License')
                            ->image()
                            ->directory('driver-applications/license')
                            ->required(),
                    ])->columns(3),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('pending'),
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Rejection Reason')
                            ->visible(fn (Forms\Get $get) => $get('status') === 'rejected')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email copied'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Phone copied'),

                Tables\Columns\TextColumn::make('vehicle_type')
                    ->label('Vehicle')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bike' => 'Motorcycle / Bike',
                        'car' => 'Car',
                        'cng' => 'CNG / Auto-rickshaw',
                        default => ucfirst($state),
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bike' => 'green',
                        'car' => 'amber',
                        'cng' => 'emerald',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('license_plate')
                    ->label('License Plate')
                    ->searchable()
                    ->fontFamily('mono')
                    ->uppercase(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->icons([
                        'pending' => 'heroicon-o-clock',
                        'approved' => 'heroicon-o-check-circle',
                        'rejected' => 'heroicon-o-x-circle',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Applied')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->label('Status'),

                Tables\Filters\SelectFilter::make('vehicle_type')
                    ->options([
                        'bike' => 'Motorcycle / Bike',
                        'car' => 'Car',
                        'cng' => 'CNG / Auto-rickshaw',
                    ])
                    ->label('Vehicle Type'),

                Tables\Filters\Filter::make('created_today')
                    ->label('Applied Today')
                    ->query(fn (Builder $query): Builder => $query->whereDate('created_at', today())),

                Tables\Filters\Filter::make('created_this_week')
                    ->label('Applied This Week')
                    ->query(fn (Builder $query): Builder => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View Details'),

                Action::make('approve_and_register')
                    ->label('Approve & Register')
                    ->icon('heroicon-o-user-plus')
                    ->color('success')
                    ->visible(fn (RiderApplication $record): bool => $record->isPending())
                    ->requiresConfirmation()
                    ->modalHeading('Approve & Register Driver')
                    ->modalDescription('This will approve the application, create a driver account, and send login credentials via email. Are you sure you want to proceed?')
                    ->modalSubmitActionLabel('Yes, Approve & Register')
                    ->action(function (RiderApplication $record) {
                        self::approveAndRegister($record);
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (RiderApplication $record): bool => $record->isPending())
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Rejection Reason')
                            ->required()
                            ->placeholder('Enter reason for rejection...'),
                    ])
                    ->action(function (RiderApplication $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'rejection_reason' => $data['rejection_reason'],
                        ]);

                        Notification::make()
                            ->title('Application Rejected')
                            ->body("{$record->name}'s application has been rejected.")
                            ->danger()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->poll('30s');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Full Name')
                                    ->weight('bold'),
                                TextEntry::make('email')
                                    ->label('Email')
                                    ->copyable(),
                                TextEntry::make('phone')
                                    ->label('Phone')
                                    ->copyable(),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Vehicle Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('vehicle_type')
                                    ->label('Vehicle Type')
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'bike' => 'Motorcycle / Bike',
                                        'car' => 'Car (Sedan/Hatchback)',
                                        'cng' => 'CNG / Auto-rickshaw',
                                        default => ucfirst($state),
                                    })
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'bike' => 'green',
                                        'car' => 'amber',
                                        'cng' => 'emerald',
                                        default => 'gray',
                                    }),
                                TextEntry::make('license_plate')
                                    ->label('License Plate')
                                    ->fontFamily('mono')
                                    ->uppercase(),
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->colors([
                                        'warning' => 'pending',
                                        'success' => 'approved',
                                        'danger' => 'rejected',
                                    ]),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Verification Documents')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                ImageEntry::make('verification_documents.nid_front')
                                    ->label('NID Front')
                                    ->disk('public')
                                    ->height(200)
                                    ->defaultImageUrl(url('/images/placeholder.png')),
                                ImageEntry::make('verification_documents.nid_back')
                                    ->label('NID Back')
                                    ->disk('public')
                                    ->height(200)
                                    ->defaultImageUrl(url('/images/placeholder.png')),
                                ImageEntry::make('verification_documents.driving_license')
                                    ->label('Driving License')
                                    ->disk('public')
                                    ->height(200)
                                    ->defaultImageUrl(url('/images/placeholder.png')),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Timeline')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Applied On')
                                    ->dateTime('M d, Y H:i'),
                                TextEntry::make('approved_at')
                                    ->label('Approved On')
                                    ->dateTime('M d, Y H:i')
                                    ->placeholder('Not approved yet'),
                                TextEntry::make('approver.name')
                                    ->label('Approved By')
                                    ->placeholder('Not approved yet'),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Rejection Reason')
                    ->schema([
                        TextEntry::make('rejection_reason')
                            ->label('Reason')
                            ->columnSpanFull()
                            ->placeholder('No rejection reason provided'),
                    ])
                    ->visible(fn (RiderApplication $record): bool => $record->status === 'rejected')
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRiderApplications::route('/'),
            'view' => ViewRiderApplication::route('/{record}'),
        ];
    }

    /**
     * Approve application and create driver account
     */
    public static function approveAndRegister(RiderApplication $application): void
    {
        $application->load('approver');

        try {
            // Execute in database transaction
            \DB::transaction(function () use ($application) {
                // 1. Generate secure temporary password
                $temporaryPassword = \Str::random(12);

                // 2. Create user account
                $user = \App\Models\User::create([
                    'name' => $application->name,
                    'email' => $application->email,
                    'phone' => $application->phone,
                    'password' => \Hash::make($temporaryPassword),
                    'role' => 'driver',
                    'is_active' => true,
                ]);

                // 3. Create driver profile
                $user->driverProfile()->create([
                    'vehicle_type' => $application->vehicle_type,
                    'license_plate' => $application->license_plate,
                    'is_online' => false,
                    'is_verified' => true,
                    'rating' => 5.0,
                    'total_rides' => 0,
                ]);

                // 4. Update application status
                $application->update([
                    'status' => 'approved',
                    'approved_at' => now(),
                    'approved_by' => auth()->id(),
                ]);

                // 5. Send email with credentials
                \Mail::to($application->email)->send(
                    new \App\Mail\DriverCredentials($application->name, $application->email, $temporaryPassword)
                );
            });

            Notification::make()
                ->title('Driver Registered Successfully')
                ->body("{$application->name} has been approved and registered as a driver. Credentials sent via email.")
                ->success()
                ->send();

        } catch (\Exception $e) {
            \Log::error('Driver registration failed', [
                'application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);

            Notification::make()
                ->title('Registration Failed')
                ->body('Failed to create driver account: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}