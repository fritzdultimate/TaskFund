<div class="bg-slate-100 h-full w-full">
    <x-dashboard.header
        title="Personal Information"
    >
        <x-slot:rightLink>
            {{-- right link --}}        
        </x-slot:rightLink>
    </x-dashboard.header>
  

    <div class="bg-[#ffffffcf] h-full px-4 pt-[30px] pb-[100px]">
        <ul class="flex flex-col gap-[28px]">
            <li class="flex">
                <div class="flex justify-between w-full" href="{{ route('personal-information') }}">
                    <div class="flex gap-[16px]">
                        {{-- <img src="{{ asset('img/icons/personal-information.png') }}" alt=""> --}}
                        <span class="text-sm font-semibold font-poppins">
                            Personal Information
                        </span>
                    </div>
                    <div>
                       <span class="text-sm">Click Settings</span> >
                    </div>
                </div>
            </li>
            <li class="flex">
                <div class="flex justify-between w-full" href="{{ route('tasks') }}">
                    <div class="flex gap-[16px]">
                        {{-- <img src="{{ asset('img/icons/task-records.png') }}" alt=""> --}}
                        <span class="text-sm font-semibold font-poppins">
                            Mobile Number
                        </span>
                    </div>
                    <div>
                       <span class="text-sm"> {{ auth()->user()->phone_number }} </span> >
                    </div>
                </div>
            </li>
            <li class="flex">
                <div class="flex justify-between w-full" href="{{ route('daily-statement') }}">
                    <div class="flex gap-[16px]">
                        {{-- <img src="{{ asset('img/icons/daily-statement.png') }}" alt=""> --}}
                        <span class="text-sm font-semibold font-poppins">
                            Real Name
                        </span>
                    </div>
                    <a href="{{ route('real-name') }}">
                       <span class="text-sm"> Click Settings </span> >
                    </a>
                </div>
            </li>
            <li class="flex">
                <div class="flex justify-between w-full" href="{{ route('team-reports') }}">
                    <div class="flex gap-[16px]">
                        {{-- <img src="{{ asset('img/icons/team-reports.png') }}" alt=""> --}}
                        <span class="text-sm font-semibold font-poppins">
                            Bank Card
                        </span>
                    </div>
                    <a href="{{ route('bank-card') }}">
                       <span class="text-sm"> Click Settings </span> >
                    </a>
                </div>
            </li>
            <li class="flex">
                <div class="flex justify-between w-full" href="{{ route('invite-friends') }}">
                    <div class="flex gap-[16px]">
                        {{-- <img src="{{ asset('img/icons/invite-friends.png') }}" alt=""> --}}
                        <span class="text-sm font-semibold font-poppins">
                            Login Password
                        </span>
                    </div>
                    <a href="{{ route('change-password') }}">
                       <span class="text-sm"> Click Settings </span> >
                    </a>
                </div>
            </li>
            <li class="flex">
                <div class="flex justify-between w-full" href="{{ route('piggy-money') }}">
                    <div class="flex gap-[16px]">
                        {{-- <img src="{{ asset('img/icons/piggy-money.png') }}" alt=""> --}}
                        <span class="text-sm font-semibold font-poppins">
                            Fund Password
                        </span>
                    </div>
                    <a href="{{ route('fund-password') }}">
                       <span class="text-sm"> Click Settings </span> >
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>