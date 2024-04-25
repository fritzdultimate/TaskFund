
    <div x-data="tasks" class="flex flex-col w-full h-full">
        <div class="flex my-3 w-full items-center">
            <div class="mr-auto" id="returnBack"></div>
            <h1 class="text-slate-800 font-semibold text-xl text-center w-full">Task Hall</h1>
        </div>
    
        <div class="bg-slate-200 w-full flex py-4">
            <div class="w-full">
                <div class="relative right-0">
                    <nav id="taskTypes" x-ref="taskTypes" class="relative space-x-2 justify-center items-center flex task-types"  role="tablist">
                        @foreach ($statuses as $status)
                            <button 
                            x-on:click="changeTab('{{ strtolower($status) }}')"
                            data-hs-tab="#content" 
                            key="{{ strtolower($status) }}" 
                            id="{{ strtolower($status) }}" 
                            @class(['active' => $activeTab == $status, 'hs-tab-active:bg-white py-1 px-2 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700']) type="button" 
                            role="tab"
                            >
                                <span class="ml-1">{{ ucFirst($status) }}</span>
                            </button>
                        @endforeach
                      </nav>
                </div>
              </div> 
        </div>
    
        <div role="tabpanel" id="content">
            @foreach ($this->activeTasks as $activeTask)    
                <div class="flex flex-col w-full my-6 px-3">
                    <div class="flex w-full justify-between items-center mt-6">
                        <div class="mt-12">
                            <a href="{{ $activeTask->task->link }}" target="_blank" class="text-xs text-blue-600 font-semibold rounded-3xl border flex justify-center items-center px-2 py-1">Open Link</a>
                        </div>
                        <div class="rounded-full bg-blue-100/50 h-10 w-10 flex justify-center items-center">
                            <img src="{{ asset('img/icons/task.png') }}" class="w-8 h-8">
                        </div>
                        <button type="button" class="mt-12 bg-blue-200 text-blue-600 font-semibold text-xs rounded-xl px-3 py-[2px] flex  justify-center items-center">submit</button>
                    </div>
                </div>
            @endforeach
        </div>
    
        @include('livewire.partials.footer')
    @push('script-bottom')
        {{-- <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script> --}}
    @endpush
</div>    
    @script
    <script>
        Alpine.data('tasks', () => ({
            async changeTab(status){
    
                Notiflix.Loading.Dots('', { 'svgColor' : 'aliceblue' });
                let response = await @this.changeTab(status);
                
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
