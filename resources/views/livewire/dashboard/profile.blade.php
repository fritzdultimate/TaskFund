<div class="bg-slate-100 h-full w-full">
    <div class="flex bg-white py-3 w-full items-center">
        <div class="basis-[10%] absolute">
            <div class="mr-auto" id="returnBack"></div>
        </div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full basis-full">
            Profile
        </h1>
        {{-- <div class="ml-auto px-4 text-xs basis-[10%]">
            History
        </div> --}}
    </div>
    <div class="bg-white">
        <div class="bg-[#5362B2] h-[84px] rounded-b-[50px] flex gap-[8px] justify-center items-center flex-col">
            <img class="h-[40px] w-[40px]" src="{{ asset('img/icons/user.png') }}" alt="">
            <span class="text-white text-[12px]">
                81499990
            </span>
        </div>
        <div class="flex flex-row justify-center items-center h-[38px] text-[15px] font-poppins">
            Balance: <h4 class="ml-1 text-[#26C82C] font-semibold !font-poppins">{{ number_format(auth()->user()->balance, 2) }}</h4>
        </div>
    </div>
    <div class="py-[26px] flex justify-center items-center">
        <div class="w-[114px] text-center px-[10px] py-1 font-poppins text-[12px] text-[#5362B2] rounded-[16px] border-[#5362B2] border-[1px]">
            Wallets
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 px-4">
        <div class="bg-[#FFFFFF] flex flex-col items-center justify-center rounded-[8px] gap-[10px] p-[8px]">
            <span class="text-[14px] font-poppins font-normal">
                Today's Profit
            </span>
            <span class="text-[16px] font-medium">
                525
            </span>
        </div>
   
        <div class="bg-[#FFFFFF] flex flex-col items-center justify-center rounded-[8px] gap-[10px] p-[8px]">
            <span class="text-[14px] font-poppins font-normal">
                Yesterday's Profit
            </span>
            <span class="text-[16px] font-medium">
                525
            </span>
        </div>
   
        <div class="bg-[#FFFFFF] flex flex-col items-center justify-center rounded-[8px] gap-[10px] p-[8px]">
            <span class="text-[14px] font-poppins font-normal">
                This week's Profit
            </span>
            <span class="text-[16px] font-medium">
                525
            </span>
        </div>
    
        <div class="bg-[#FFFFFF] flex flex-col items-center justify-center rounded-[8px] gap-[10px] p-[8px]">
            <span class="text-[14px] font-poppins font-normal">
                This month's Profit
            </span>
            <span class="text-[16px] font-medium">
                525
            </span>
        </div>
   
        <div class="bg-[#FFFFFF] flex flex-col items-center justify-center rounded-[8px] gap-[10px] p-[8px]">
            <span class="text-[14px] font-poppins font-normal">
                Total revenue
            </span>
            <span class="text-[16px] font-medium">
                525
            </span>
        </div>
   
        <div class="bg-[#FFFFFF] flex flex-col items-center justify-center rounded-[8px] gap-[10px] p-[8px]">
            <span class="text-[14px] font-poppins font-normal">
                Referral's Bonus
            </span>
            <span class="text-[16px] font-medium">
                525
            </span>
        </div>
    </div>

    <div class="bg-white px-4 pt-[20px] mt-[38px] pb-[100px]">
        <ul class="flex flex-col gap-[16px]">
            <li class="flex">
                <a class="flex justify-between w-full" href="{{ route('personal-information') }}">
                    <div class="flex gap-[16px]">
                        <img src="{{ asset('img/icons/personal-information.png') }}" alt="">
                        <span class="text-[16px] font-light font-poppins">
                            Personal Information
                        </span>
                    </div>
                    <div>
                        >
                    </div>
                </a>
            </li>
            <li class="flex">
                <a class="flex justify-between w-full" href="{{ route('tasks') }}">
                    <div class="flex gap-[16px]">
                        <img src="{{ asset('img/icons/task-records.png') }}" alt="">
                        <span class="text-[16px] font-light font-poppins">
                            Task Records
                        </span>
                    </div>
                    <div>
                        >
                    </div>
                </a>
            </li>
            <li class="flex">
                <a class="flex justify-between w-full" href="{{ route('daily-statement') }}">
                    <div class="flex gap-[16px]">
                        <img src="{{ asset('img/icons/daily-statement.png') }}" alt="">
                        <span class="text-[16px] font-light font-poppins">
                            Daily Statement
                        </span>
                    </div>
                    <div>
                        >
                    </div>
                </a>
            </li>
            <li class="flex">
                <a class="flex justify-between w-full" href="{{ route('team-reports') }}">
                    <div class="flex gap-[16px]">
                        <img src="{{ asset('img/icons/team-reports.png') }}" alt="">
                        <span class="text-[16px] font-light font-poppins">
                            Team Reports
                        </span>
                    </div>
                    <div>
                        >
                    </div>
                </a>
            </li>
            <li class="flex">
                <a class="flex justify-between w-full" href="{{ route('invite-friends') }}">
                    <div class="flex gap-[16px]">
                        <img src="{{ asset('img/icons/invite-friends.png') }}" alt="">
                        <span class="text-[16px] font-light font-poppins">
                            Invite Friends
                        </span>
                    </div>
                    <div>
                        >
                    </div>
                </a>
            </li>
            <li class="flex">
                <a class="flex justify-between w-full" href="{{ route('piggy-money') }}">
                    <div class="flex gap-[16px]">
                        <img src="{{ asset('img/icons/piggy-money.png') }}" alt="">
                        <span class="text-[16px] font-light font-poppins">
                            Piggy Money
                        </span>
                    </div>
                    <div>
                        >
                    </div>
                </a>
            </li>
            <li class="flex">
                <a class="flex justify-between w-full" href="{{ route('accounting-records') }}">
                    <div class="flex gap-[16px]">
                        <img src="{{ asset('img/icons/personal-information.png') }}" alt="">
                        <span class="text-[16px] font-light font-poppins">
                            Accounting Records
                        </span>
                    </div>
                    <div>
                        >
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>