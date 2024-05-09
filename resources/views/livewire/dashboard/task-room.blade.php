<div x-data="taskroom" class="flex flex-col w-full min-h-full bg-[#FAFAFA] pb-[100px] font-poppins">

    <x-dashboard.header
        title="Task Room"
    >
        <x-slot:rightLink>
            {{-- right link --}}        
        </x-slot:rightLink>
    </x-dashboard.header>

    <div class="bg-[#4657AD] h-[127px] grid grid-cols-2 text-white">
        <div class="flex items-center flex-col h-full justify-center">
            <h1 class="text-3xl font-poppins font-semibold">
                {{ $this->totalLevelTasks }}
            </h1>
            <div class="flex flex-col">
                <span class="text-xs">
                    Todays's remaining task
                </span> 
                {{-- <span>

                </span> --}}
            </div>
        </div>
        <div class="flex items-center flex-col h-full justify-center">
            <h1 class="text-3xl font-poppins font-semibold">
                {{ $this->totalSelectedTasks }}
            </h1>
            <div class="flex flex-col">
                <span class="text-xs">
                    Todays's pending task
                </span> 
            </div>
        </div>
    </div>

    <div class="w-full flex py-4" wire:ignore>
        <div class="w-full">
            <div class="relative right-0">
              <nav id="taskTypes" x-ref="taskTypes" class="relative space-x-2 justify-center items-center flex task-types"  role="tablist">
                @foreach ($taskTypes as $type)
                    <button 
                    x-on:click="changeTab('{{ strtolower($type->name) }}')"
                    data-hs-tab="#content" 
                    key="{{ strtolower($type->name) }}" 
                    id="{{ strtolower($type->name) }}" 
                    @class(['active' => $activeTab->id == $type->id, 'hs-tab-active:bg-[#4657AD] hs-tab-active:text-white bg-white py-1 px-2 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700']) type="button" 
                    role="tab"
                    >
                        <span class="ml-1">{{ $type->name }}</span>
                    </button>
                @endforeach
              </nav>
            </div>
          </div> 
    </div>

    <div class="bg-slate- px-6 py-3 font-semibold text-xl w-full flex items-center">
        Tasks
    </div>

    <div role="tabpanel" id="content" class="bg-white">
        @forelse ($this->activeTasks as $task)
            <div class="flex px-3 py-4 items-center border-b border-slate-100">
                <div class="flex items-center">
                   
                    <img src="{{ asset($task->type->image) }}" class="w-8 h-8">
                    <div class="flex flex-col text-sm ml-2">
                        <h3 class="text-slate-400"> Request:{{ $task->type->name }}</h3>
                        <span class="text-xs font-bold text-slate-900">₦{{ number_format(auth()->user()->level->profit_per_task, 2) }}</span>
                    </div>
                </div>
    
                @php($isSelected = in_array($task->id, $this->addedTasks))

                <button x-on:click="takeTask({{ $task->id }})" class="flex justify-center items-center h-8 w-8 rounded-full border ml-auto hover:bg-slate-50 disabled:outline-green-500 disabled:outline-2"  @disabled($isSelected)>
                    @if($isSelected)
                    <i class="uil uil-check text-2xl text-green-500"></i>
                    @else
                    <i class="uil uil-thumbs-up text-base"></i>
                   
                    @endif
                </button>
            </div>
        @empty
            <div class="flex px-3 py-4 items-center text-center justify-center">
                No New Tasks Yet
            </div>
        @endforelse
    </div>


    @include('livewire.partials.footer')

</div>


@script
<script>
    Alpine.data('taskroom', () => ({
        async takeTask(taskId){
            Notiflix.Loading.Dots('', { 'svgColor' : 'aliceblue' });
            let response = await @this.takeTask(taskId);

            Notiflix.Loading.Remove();

            if(!response.success) return Notiflix.Notify.Failure(response.message);

            return Notiflix.Notify.Success(response.message);
        },
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