<div class="bg-slate-100 h-full w-full">
    <div>
        <div class="bg-blue-500 h-32 w-full flex flex-col justify-center items-center text-slate-300 font-bold relative bg-cover" style="background-image: url({{ asset('img/campaign-creators-gMsnXqILj.png') }})">
            <div class="absolute bg-slate-800 opacity-85 w-full h-32 right-0 top-0"></div>
            <h1 class="font-mono text-2xl z-10">{{ env('APP_NAME') }} Company</h1>
            <h3 class="text-sm font-sans z-10">You Task, We Fund.</h3>
        </div>
    </div>

    <div class="h-[78px] bg-white rounded-3xl overflow-hidden border-l-2 border-l-green-600 text-slate-500 my-5 mx-3 text-xs font-bold">
        <ul id="referrals" class="h-[78px] overflow-hidden" style="">
            @foreach ($referrals as $user => $referral)     
            <li class="h-[78px] flex justify-center items-center p-[16px]">
                <p class="flex justify-center items-center">
                    <i class="uil uil-info-circle text-2xl text-green-600 mr-2 font-bold"></i>
                    Congratulations to member {{ $user }} for recommending an {{ $referral['name'] }} and getting a promotion reward of ₦{{ number_format($referral['referral_bonus'],2) }}
                </p>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="flex mx-3 flex-col">
        <div class="flex w-full justify-between mb-3 columns-2">
            <a href="{{ route('profile') }}" class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between px-3 py-2">
                <span class="text-slate-800 font-semibold text-sm">Profile</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/profile.png') }}" class="w-5 h-5">
                </div>
            </a>
            <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between py-2 px-3">
                <span class="text-slate-800 font-semibold text-sm">Reviews</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/reviews.png') }}" class="w-5 h-5">
                </div>
            </div>
        </div>

        <div class="flex w-full justify-between mb-3">
            <a href="{{ route('deposit') }}" class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between px-3 py-2">
                <span class="text-slate-800 font-semibold text-sm">Deposit</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/deposit.png') }}" class="w-5 h-5">
                </div>
            </a>
            <a href="{{ route('withdrawal') }}" class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between py-2 px-3">
                <span class="text-slate-800 font-semibold text-sm">Withdrawal</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/withdrawal.png') }}" class="w-5 h-5">
                </div>
            </a>
        </div>
    </div>

    <div class="flex flex-col">
        <h3 class="text-base text-slate-800 mx-3 font-semibold my-3">Task Room</h3>
        <div class="flex mx-3 flex-col">
            <div class="w-full justify-between mb-3 grid grid-cols-2 gap-4">
                @foreach ($this->taskTypes as $taskType)     
                <a href="{{ route('tasks-room', ['type' => strtolower($taskType->name)]) }}" class="col-span-1 flex items-center bg-white rounded-3xl text-slate-700 justify-between px-3 py-2">
                    <span class="text-slate-800 font-semibold text-sm">
                        {{ ucFirst($taskType->name) }}
                    </span>
                    <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                        <img src="{{ $taskType->icon }}" class="w-5 h-5">
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex flex-col bg-inherit pb-[60px]">
        <h3 class="text-base text-slate-800 mx-3 font-semibold my-3">Users List</h3>
        
        <div class="h-[300px]">
            <ul id="user-list" class="flex flex-col w-full bg-white">
                
                @foreach ($completedTasks as $user => $details)
                    
                <li class="flex px-3 py-3 justify-center items-center">
                    <img src="{{ asset('img/icons/user.png') }}" class="w-8 h-8 mr-3">
                    <div class="flex flex-col">
                        <h3 class="text-xs font-semibold text-slate-700">congratulations {{ $user }}</h3>
                        <h4 class="text-[10px] font-normal text-slate-400">Completed {{ $details['tasks_completed'] }} tasks today</h4>
                    </div>
    
                    <div class="ml-auto text-green-600 font-semibold text-xs">₦{{ number_format($details['amount_earned'], 2) }}</div>
                </li>
                @endforeach
    
            </ul>
        </div>
    </div>

    @include('livewire.partials.footer')

    <script src="{{ asset('libs/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/jquery.marquee.js') }}"></script>
    <script>
        
        // document.addEventListener('load', () => {
            // alert('heyy');
            $('#referrals').marquee({
                delay: 4000
            });
            $('#user-list').marquee(); 
        // });
    </script>

</div>