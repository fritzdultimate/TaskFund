<div x-data="taskroom" class="flex flex-col w-full h-full">
    <div class="flex my-3 w-full items-center">
        <div class="mr-auto" id="returnBack"></div>
        <h1 class="text-slate-800 font-semibold text-xl text-center w-full">Task Room</h1>
    </div>

    <div class="bg-slate-200 w-full flex py-4" wire:ignore>
        <div class="w-full">
            <div class="relative right-0">
              <nav id="taskTypes" x-ref="taskTypes" class="relative space-x-2 justify-center items-center flex task-types"  role="tablist">
                @foreach ($taskTypes as $type)
                    <button 
                    x-on:click="changeTab('{{ strtolower($type->name) }}')"
                    data-hs-tab="#content" 
                    key="{{ strtolower($type->name) }}" 
                    id="{{ strtolower($type->name) }}" 
                    @class(['active' => $activeTab->id == $type->id, 'hs-tab-active:bg-white py-1 px-2 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700']) type="button" 
                    role="tab"
                    >
                        <span class="ml-1">{{ $type->name }}</span>
                    </button>
                @endforeach
              </nav>
            </div>
          </div> 
    </div>

    <div class="bg-slate-50 px-6 py-3 font-semibold text-xl w-full flex items-center">
        Tasks
    </div>

    <div role="tabpanel" id="content">
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


</div>

@push('script-bottom')
    {{-- <script defer src="{{ asset('libs/tabs.js') }}"></script> --}}

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

            this.$nextTick(() => {
                
                setTimeout(() => {
                    let taskTypes = HSTabs.getInstance('#taskTypes');
                    taskTypes.on('change', ({el, prev, current}) => {
                        
                    });
                }, 5);
            });

        }
    }));
</script>
@endscript