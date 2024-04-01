<div class="flex flex-col w-full h-full">
    <div class="flex my-3 w-full items-center">
        <div class="mr-auto" id="returnBack"></div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full">Task Room</h1>
    </div>

    <div class="bg-slate-200 w-full flex py-4">
        <div class="w-full">
            <div class="relative right-0">
              <ul class="relative flex flex-wrap p-1 list-none rounded-xl text-sm" data-tabs="tabs" role="list">
                <li class="z-30 flex-auto text-center">
                  <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                    data-tab-target="" active role="tab" aria-selected="true">
                    <span class="ml-1">Facebook</span>
                  </a>
                </li>
                <li class="z-30 flex-auto text-center">
                  <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                    data-tab-target="" role="tab" aria-selected="false">
                    <span class="ml-1">Whatsapp</span>
                  </a>
                </li>
                <li class="z-30 flex-auto text-center">
                  <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                    data-tab-target="" role="tab" aria-selected="false">
                    <span class="ml-1">Instagram</span>
                  </a>
                </li>
                <li class="z-30 flex-auto text-center">
                    <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                      data-tab-target="" role="tab" aria-selected="false">
                      <span class="ml-1">Youtube</span>
                    </a>
                  </li>
              </ul>
            </div>
          </div> 
    </div>

    <div class="bg-slate-50 px-6 py-3 font-semibold text-xl w-full flex items-center">
        Tasks
    </div>

    <div class="flex px-3 my-6 items-center">
        <div class="flex items-center">
            <img src="{{ asset('img/icons/whatsapp.png') }}" class="w-8 h-8">
            <div class="flex flex-col text-sm ml-2">
                <h3 class="text-slate-400"> Request:Whatsapp</h3>
                <span class="text-xs font-bold text-slate-900">#105M</span>
            </div>
        </div>

        <button class="flex justify-center items-center h-8 w-8 rounded-full border ml-auto hover:bg-slate-50" style="">
            <i class="uil uil-thumbs-up text-base"></i>
        </button>
    </div>

    <div class="flex px-3 my-6 items-center">
        <div class="flex items-center">
            <img src="{{ asset('img/icons/whatsapp.png') }}" class="w-8 h-8">
            <div class="flex flex-col text-sm ml-2">
                <h3 class="text-slate-400"> Request:Whatsapp</h3>
                <span class="text-xs font-bold text-slate-900">#105M</span>
            </div>
        </div>

        <button class="flex justify-center items-center h-8 w-8 rounded-full border ml-auto hover:bg-slate-50" style="">
            <i class="uil uil-thumbs-up text-base"></i>
        </button>
    </div>

    <div class="flex px-3 my-6 items-center">
        <div class="flex items-center">
            <img src="{{ asset('img/icons/whatsapp.png') }}" class="w-8 h-8">
            <div class="flex flex-col text-sm ml-2">
                <h3 class="text-slate-400"> Request:Whatsapp</h3>
                <span class="text-xs font-bold text-slate-900">#105M</span>
            </div>
        </div>

        <button class="flex justify-center items-center h-8 w-8 rounded-full border ml-auto hover:bg-slate-50" style="">
            <i class="uil uil-thumbs-up text-base"></i>
        </button>
    </div>


</div>

@push('script-bottom')
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script>
@endpush