<?php

namespace App\Filament\Pages;

use App\Mail\Admin\NewsLetterMail;
use App\Models\User;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Mail;

class NewsLetter extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.news-letter';

    protected static ?string $navigationGroup = 'Others';

    protected static ?string $navigationLabel = "Send NewsLetter";

    // protected static ?string $modelLabel = 'Declined Deposit';


    public array $data = [
        'host_email' => '',
        'email' => '',
        'subject' => '',
        'message' => '',
    ];

    public function mount()
    {
        if (request()->has('user_id')) {
            $this->data['email'] = User::find(request()->get('user_id'))?->email;
        }
    }

    public function create(): void
    {


        $emails = explode(',', $this->data['email']);

        $recipients = [];

        collect($emails)->each(function ($email) use (&$recipients) {
            $subEmails = collect(explode(" ", trim($email)));
            $emails = $subEmails->map(fn ($subEmail) => trim($subEmail))->toArray();
            array_push($recipients, ...$emails);
        });

        Mail::bcc($recipients)

            ->queue(new NewsLetterMail($this->form->getState()));


        Notification::make()
            ->title('Success')
            ->iconColor('success')
            ->color('success')
            ->body('Email successfully sent to ' . $this->data['email'])
            ->icon('heroicon-o-document-text')
            ->send();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->placeholder('Enter email address')
                    ->required(),
                // Select::make('host_email')
                //     ->label('Send From')
                //     ->options(HostEmails::pluck('email', 'id')->all()),
                // ->required(),
                TextInput::make('subject')
                    ->placeholder('Enter Email Subject')
                    ->required(),
                // Textarea::make('message')
                // ->required(),
                RichEditor::make('message')
                    ->fileAttachmentsDirectory('public')
                // ->required(),
            ])
            ->statePath('data');
    }
}
