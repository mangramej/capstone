<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowNotification extends Component
{
    public function getListeners(): array
    {
        return [
            'echo-private:App.Models.User.'.Auth::id().",.Illuminate\Notifications\Events\BroadcastNotificationCreated" => '$refresh',
            'refreshComponent' => '$refresh',
        ];
    }

    public function markAsRead($notif)
    {
        Auth::user()
            ->unreadNotifications
            ->where('id', $notif['id'])
            ->markAsRead();

        return to_route('requester.milk-request-detail', [$notif['data']['milk_request']['ref_number']]);
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications->markAsRead();

        $this->emit('refreshComponent');
    }

    public function render(): View
    {
        return view('livewire.show-notification', [
            'notifications' => Auth::user()->unreadNotifications,
        ]);
    }
}
