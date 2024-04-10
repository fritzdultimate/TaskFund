<div class="flex flex-col w-full h-full">
    <div class="flex my-3 w-full items-center">
        <div class="mr-auto" id="returnBack"></div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full">Task Room</h1>
    </div>

    <div class="bg-slate-200 w-full flex py-4" wire:ignore>
        <div class="w-full">
            <div class="relative right-0">
              <ul class="relative flex flex-wrap p-1 list-none rounded-xl text-sm" data-tabs="tabs" role="list">
                <li class="z-30 flex-auto text-center">
                  <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                    wire:click="switchTask('facebook')"
                    data-tab-target="" active role="tab" aria-selected="true">
                    <span class="ml-1">Facebook</span>
                  </a>
                </li>
                <li class="z-30 flex-auto text-center">
                  <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                    wire:click="switchTask('whatsapp')"
                    data-tab-target="" role="tab" aria-selected="false">
                    <span class="ml-1">Whatsapp</span>
                  </a>
                </li>
                <li class="z-30 flex-auto text-center">
                  <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                    wire:click="switchTask('instagram')"
                    data-tab-target="" role="tab" aria-selected="false">
                    <span class="ml-1">Instagram</span>
                  </a>
                </li>
                <li class="z-30 flex-auto text-center">
                    <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
                        wire:click="switchTask('youtube')"
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

    @foreach ($tasks as $task)
        <div class="flex px-3 my-6 items-center">
            <div class="flex items-center">
                <img src="{{ asset($task->type->image) }}" class="w-8 h-8">
                <div class="flex flex-col text-sm ml-2">
                    <h3 class="text-slate-400"> Request:{{ $task->type->name }}</h3>
                    <span class="text-xs font-bold text-slate-900">#{{ $task->id + 342 }}</span>
                </div>
            </div>

            <button class="flex justify-center items-center h-8 w-8 rounded-full border ml-auto hover:bg-slate-50" wire:click="takeTask({{ $task->id }})" wire:loading.attr="disabled" wire:target='takeTask'>
                <i class="uil uil-thumbs-up text-base" wire:target='takeTask' wire:loading.remove></i>
                <i wire:loading wire:target='takeTask' class="uil uil-spinner text-base  animate-spin"></i>
            </button>
        </div>
    @endforeach


</div>

@push('script-bottom')
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('success', (event) => {
            swal("Good job!", event, "success");
           });

           @this.on('error', (event) => {
            swal("Oops", event, "error");
           });
        });
    
    </script>
@endpush