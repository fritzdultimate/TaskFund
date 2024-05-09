<?php

namespace App\Livewire\Dashboard;

use App\Models\Level;
use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Computed;

#[Layout('livewire.layouts.dashboard')]
#[Title('Home for enterpreneurs')]
class Home extends Component
{

    public $completedTasks = [];
    public $referrals = [];


    public function boot()
    {
        // session()->forget(['completed-tasks', 'referrals']);

        // $this->completedTasks = $this->getCompletedTasks();
        // $this->referrals = $this->getReferrals();

        session()->forget(['a', 'b']);


         $this->completedTasks = $this->a();
        $this->referrals = $this->b();
        dd($this->completedTasks, $this->referrals);
    }

    private function getAOrB($isA){
        return $isA ? ['a' => 'a'] : ['b' => 'b'];
    }

    private function a(){
        if(session()->missing('a')){
            //do stuffs
            $a = $this->getAOrB(isA:true);

            session(['a' => $a]);
            return $a;
        }
        return session('a');
    }
    private function b(){
        if(session()->missing('b')){
            //do stuffs
            $b = $this->getAOrB(isA:false);

            session(['b' => $b]);

            return $b;
        }
        return session('b');
    }

    #[Computed]
    public function levels(){
        return Level::all(['name', 'daily_tasks', 'referral_bonus', 'profit_per_task']);
    }

    private function generateData($length = 10, $isReferral = false)
    {

        $levels = $this->levels;

        $data = [];

        for ($i = 0; $i < $length; $i++) {

            $rand = rand(1000, 9000);

            $level = $levels[rand(0, count($levels) - 1)];

            $referralData = [
                'name' => $level->name,
                'referral_bonus' => $level->referral_bonus,
            ];

            $tasksData = [
                'tasks_completed' => $level->daily_tasks,
                'amount_earned' => $level->daily_tasks * $level->profit_per_task,
            ];

            $data["****" . $rand] = $isReferral ? $referralData : $tasksData;

        }

        return $data;
    }


    private function getCompletedTasks()
    {
        if (session()->missing('completed-tasks')) {

            $tasks = $this->generateData(20, isReferral:false);

            session()->put('completed-tasks', $tasks);

            return $tasks;
        }

        return session()->get('completed-tasks');
    }

    private function getReferrals()
    {
        
        if (session()->missing('referrals')) {
            
            $referrals = $this->generateData(20, isReferral:true);
            
            
            session()->put('referrals', $referrals);
            
            
            return $referrals;
        }
        
        dd(session()->all());

        return session()->get('referrals');
    }

    public function render()
    {
        // $this->authorize();
        return view('livewire.dashboard.home');
    }
}
