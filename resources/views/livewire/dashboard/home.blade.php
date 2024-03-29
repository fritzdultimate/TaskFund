<div class="bg-slate-100 h-full w-full">
    <div>
        <div class="bg-blue-500 h-32 w-full flex flex-col justify-center items-center text-slate-300 font-bold relative bg-cover" style="background-image: url({{ asset('img/campaign-creators-gMsnXqILj.png') }})">
            <div class="absolute bg-slate-800 opacity-85 w-full h-32 right-0 top-0"></div>
            <h1 class="font-mono text-2xl z-10">{{ env('APP_NAME') }} Company</h1>
            <h3 class="text-sm font-sans z-10">You Task, We Fund.</h3>
        </div>
    </div>

    <div class="bg-white rounded-3xl border-l-2 border-l-green-600 text-slate-500 my-5 mx-3 p-4 text-xs font-bold">
        <p class="flex justify-center items-center">
            <i class="uil uil-info-circle text-2xl text-green-600 mr-2 font-bold"></i>
            Congratulations to member ****8797 for recommending an L3 and getting a promotion reward of #20,000
        </p>
    </div>

    <div class="flex mx-3 flex-col">
        <div class="flex w-full justify-between mb-3">
            <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between px-3 py-2">
                <span class="text-slate-800 font-semibold text-sm">Profile</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/profile.png') }}" class="w-5 h-5">
                </div>
            </div>
            <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between py-2 px-3">
                <span class="text-slate-800 font-semibold text-sm">Reviews</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/reviews.png') }}" class="w-5 h-5">
                </div>
            </div>
        </div>

        <div class="flex w-full justify-between mb-3">
            <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between px-3 py-2">
                <span class="text-slate-800 font-semibold text-sm">Deposit</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/deposit.png') }}" class="w-5 h-5">
                </div>
            </div>
            <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between py-2 px-3">
                <span class="text-slate-800 font-semibold text-sm">Withdrawal</span>
                <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                    <img src="{{ asset('img/icons/withdrawal.png') }}" class="w-5 h-5">
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <h3 class="text-base text-slate-800 mx-3 font-semibold my-3">Task Room</h3>
        <div class="flex mx-3 flex-col">
            <div class="flex w-full justify-between mb-3">
                <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between px-3 py-2">
                    <span class="text-slate-800 font-semibold text-sm">Facebook</span>
                    <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                        <img src="{{ asset('img/icons/facebook.png') }}" class="w-5 h-5">
                    </div>
                </div>
                <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between py-2 px-3">
                    <span class="text-slate-800 font-semibold text-sm">WhatsApp</span>
                    <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                        <img src="{{ asset('img/icons/whatsapp.png') }}" class="w-5 h-5">
                    </div>
                </div>
            </div>
    
            <div class="flex w-full justify-between mb-3">
                <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between px-3 py-2">
                    <span class="text-slate-800 font-semibold text-sm">Instagram</span>
                    <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                        <img src="{{ asset('img/icons/instagram.png') }}" class="w-5 h-5">
                    </div>
                </div>
                <div class="w-[49%] flex items-center bg-white rounded-3xl text-slate-700 justify-between py-2 px-3">
                    <span class="text-slate-800 font-semibold text-sm">Youtube</span>
                    <div class="ml-auto rounded-full bg-slate-100 w-7 h-7 flex justify-center items-center">
                        <img src="{{ asset('img/icons/youtube.png') }}" class="w-5 h-5">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <h3 class="text-base text-slate-800 mx-3 font-semibold my-3">Users List</h3>
        
        <ul class="flex flex-col w-full bg-white">
            <li class="flex px-3 py-3 justify-center items-center">
                <img src="{{ asset('img/icons/user.png') }}" class="w-8 h-8 mr-3">
                <div class="flex flex-col">
                    <h3 class="text-xs font-semibold text-slate-700">congratulations *** 1234</h3>
                    <h4 class="text-[10px] font-normal text-slate-400">Completed 5 list today</h4>
                </div>

                <div class="ml-auto text-green-600 font-semibold text-xs">#200</div>
            </li>

            <li class="flex px-3 py-3 justify-center items-center">
                <img src="{{ asset('img/icons/user.png') }}" class="w-8 h-8 mr-3">
                <div class="flex flex-col">
                    <h3 class="text-xs font-semibold text-slate-700">congratulations *** 1234</h3>
                    <h4 class="text-[10px] font-normal text-slate-400">Completed 5 list today</h4>
                </div>

                <div class="ml-auto text-green-600 font-semibold text-xs">#200</div>
            </li>

            <li class="flex px-3 py-3 justify-center items-center">
                <img src="{{ asset('img/icons/user.png') }}" class="w-8 h-8 mr-3">
                <div class="flex flex-col">
                    <h3 class="text-xs font-semibold text-slate-700">congratulations *** 1234</h3>
                    <h4 class="text-[10px] font-normal text-slate-400">Completed 5 list today</h4>
                </div>

                <div class="ml-auto text-green-600 font-semibold text-xs">#200</div>
            </li>

            <li class="flex px-3 py-3 justify-center items-center">
                <img src="{{ asset('img/icons/user.png') }}" class="w-8 h-8 mr-3">
                <div class="flex flex-col">
                    <h3 class="text-xs font-semibold text-slate-700">congratulations *** 1234</h3>
                    <h4 class="text-[10px] font-normal text-slate-400">Completed 5 list today</h4>
                </div>

                <div class="ml-auto text-green-600 font-semibold text-xs">#200</div>
            </li>
        </ul>
    </div>
</div>