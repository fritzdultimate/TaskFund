<?php

namespace App\Traits;

use App\Filament\Resources\TaskHallResource\Pages\ListTaskHalls;
use Filament\Notifications\Notification;

trait RecordUtils {
    public static function shouldBeVisibleIn($key){
        $label = strtolower(static::getModelLabel());

        
        if(!is_array($key)) return str_contains($label, $key);
        
        return !!array_filter($key, fn($k) => str_contains($label, $k));
        
    }
    
    public static function getActiveTab(){
        $url = parse_url(url()->full());
        $listTaskHall = new ListTaskHalls;

        if(!isset($url['query'])) return $listTaskHall->getDefaultActiveTab();

        $result = null;
       
        parse_str($url['query'], $result);

        return $result['activeTab'];
    }

    public static function shouldBeVisibleInTab($key){
       

        $label = strtolower(self::getActiveTab());
        

        if(!is_array($key)) return str_contains($label, $key);
        
        // dd(!!str_contains('pending', $key[0]));

        return !!array_filter($key, fn($k) => str_contains($label, $k));

    }

    public static function showResponse($response){
        Notification::make()
            ->when($response['success'], function (Notification $notification) {
                $notification->title('Success')
                    ->iconColor('success')
                    ->color('success')
                    ->icon('heroicon-o-check-circle');
            })
            ->unless($response['success'], function (Notification $notification) {
                $notification->title('Something went wrong')
                    ->iconColor('danger')
                    ->color('danger')
                    ->icon('heroicon-o-exclamation-circle');
            })
            ->body($response['message'])
            ->send();    
    }
        
}