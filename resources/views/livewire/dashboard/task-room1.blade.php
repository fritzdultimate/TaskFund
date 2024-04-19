<div x-data="taskroom" class="flex flex-col w-full h-full">
    <div class="flex my-3 w-full items-center">
        <div class="mr-auto" id="returnBack"></div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full">Task Room</h1>
    </div>

    <div class="bg-slate-200 w-full flex py-4">
        <div class="w-full">
            <div class="relative right-0">
              <ul class="relative flex flex-wrap p-1 list-none rounded-xl text-sm task-types" data-tabs="tabs" role="list">
                @foreach ($taskTypes as $type)
                    <li class="z-30 flex-auto text-center">
                        <a class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit {{  $activeTab->id == $type->id ? 'active' : '' }}"
                            aria-selected="{{ $activeTab->id == $type->id ? 'true' : 'false' }}"
                            role="tab"
                            data-tab-target=""
                            
                            {{-- active="{{ $activeTab->id == $type->id ? true : false }}" --}}
                            @if($activeTab->id == $type->id)
                            active 
                            @endif
                            x-on:click="changeTab('{{ strtolower($type->name) }}')"
                        >
                        <span class="ml-1">{{ $type->name }} {{ $activeTab->id }} {{ $type->id }} {{ $activeTab->id == $type->id ? 'true': 'false' }}</span>
                        </a>
                    </li>
                @endforeach
              </ul>
            </div>
          </div> 
    </div>

    <div class="bg-slate-50 px-6 py-3 font-semibold text-xl w-full flex items-center">
        Tasks
    </div>

    
    @foreach ($this->activeTasks as $task)
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
    <script defer src="{{ asset('libs/tabs.js') }}"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('success', (event) => {
            swal("Good job!", `${event}`, "success");
           });

           @this.on('error', (event) => {
            swal("Oops", `${event}`, "error");
           });
        });

    </script>
@endpush

@script
<script>
    Alpine.data('taskroom', () => ({
        async changeTab(taskname){
            let url = location.href.split('?')[0];

            history.replaceState(null, `${taskname} Tasks`, `${url}?type=${taskname}`);

            Notiflix.Loading.Dots('', { 'svgColor' : 'aliceblue' });
            let response = await @this.changeTab(taskname);
            
            Notiflix.Loading.Remove();

        },
        init(){
            let taskTypes = document.querySelector('.task-types').querySelectorAll('li');
            [... taskTypes].forEach(taskType => {
                let link = taskType.querySelector('a');
                if(link.hasAttribute('active')) {
                    // console.log(taskType);
                    taskType.click();
                    return link.click();
                }
            });
        }
    }));
</script>
@endscript