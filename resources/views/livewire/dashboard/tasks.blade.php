
    <div x-data="task" class="flex flex-col w-full min-h-full pb-[100px] font-poppins bg-slate-100">
        <div class="flex bg-white py-3 w-full items-center">
            <div class="basis-[10%] absolute">
                <a x-on:click="history.go(-1)">
                    <div class="mr-auto p-2 pl-4" id="returnBack">
                        <x-arrow-back-icon/>
                    </div>
                </a>
            </div>
            <h1 class="text-slate-800 font-semibold text-xl text-center w-full basis-full">
                Task Hall
            </h1>
            {{-- <div class="basis-[10%] absolute text-xs right-0 px-4">
                History
            </div> --}}
        </div>
    
        <div class=" w-full flex py-4">
            <div class="w-full">
                <div class="relative right-0">
                    <nav id="taskTypes" x-ref="taskTypes" class="relative space-x-2 justify-center items-center flex task-types"  role="tablist">
                        @foreach ($statuses as $status)
                            <button 
                            x-on:click="changeTab('{{ strtolower($status) }}')"
                            data-hs-tab="#content" 
                            key="{{ strtolower($status) }}" 
                            id="{{ strtolower($status) }}" 
                            @class(['active' => $activeTab == $status, 'hs-tab-active:bg-[#4657AD] hs-tab-active:text-white bg-white py-1 px-2 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700']) type="button" 
                            role="tab"
                            >
                                <span class="ml-1">{{ ucFirst($status) }}</span>
                            </button>
                        @endforeach
                      </nav>
                </div>
              </div> 
        </div>
        <div class="bg-slate- px-3 py-3  text-sm w-full flex items-center">
            Tasks ({{ $this->activeTasks->count() }})
        </div>
        <div role="tabpanel" id="content" class="bg-whit">
            @forelse ($this->activeTasks as $activeTask)    
                <div class="flex flex-col w-full py-6 px-3 bg-white mb-4">
                    <div class="flex w-full justify-between flex-col">
                        <div>
                            <div class="text-sm font-semibold flex gap-2 items-center">
                                <img class="rounded-full p-1 bg-slate-50 h-[50px] w-[50px]" src="{{ $activeTask->task->type->image }}" alt="">
                                Task requirements : {{ ucfirst($activeTask->task->type->name) }} (<a class="text-blue-400" href="{{ route('task-detail', ['id' => $activeTask->id]) }}">
                                    Details
                                </a>)
                            </div>
                            <p class="talic text-sm">
                                (Follow the image creation process to upload photos to complete task)
                            </p>
                            <b class="text-green-500">
                                {{ format_currency(auth()->user()->level->profit_per_task) }}
                                </b>
                            <span class="text-xs flex gap-2">
                                Added on : <x-calender-icon/> {{ $activeTask->created_at }}
                            </span>
                            <div class="my-4 flex gap-3 flex-row">
                                <a href="{{ $activeTask->task->link }}" target="_blank" class="text-xs text-blue-600 font-semibold rounded-3xl border flex justify-center items-center px-2 py-1">Open Link</a>
                                <a data-clipboard-text="{{ $activeTask->task->link }}" class="text-xs text-blue-600 font-semibold rounded-3xl border flex justify-center items-center px-2 py-1 copy-link hover:cursor-pointer">Copy Link</a>
                            </div>

                            @if($activeTask->status == 'pending')

                            <span>Audit : </span>
                            <div class="">
                                <label class="border rounded-md justify-center bg-blue-50/50  my-2 items-center flex">
                                    <div class="h-10 w-10 flex justify-center items-center">
                                        <img src="{{ asset('img/icons/task.png') }}" class="w-8 h-8">
                                        <input x-ref="attachments" multiple x-on:change="uploadAttachments({{ $activeTask->id }})" class="hidden" type="file"  name="" id=""/>
                                    </div>
                                </label>
                                @error('attachments.{{ $activeTask->id }}')
                                <span class="text-red-500">
                                    {{ $message }}
                                </span>
                                @enderror
                                <ul class="flex gap-2 mb-2" id="images-{{ $activeTask->id }}">
                                    <template x-for="preview in previewImages[{{ $activeTask->id }}]">
                                        <li>
                                            <img class="w-[50px] h-[50px]" x-bind:src="preview" alt="">
                                        </li>
                                    </template>
                                </ul>
                            </div>

                            @else
                            <div>
                                <ul class="flex gap-2 mb-2 image-viewer" id="images-{{ $activeTask->id }}" wire:ignore>
                                    @foreach ($activeTask->attachments as $attachment)
                                    <li>
                                        <img class="w-[50px] h-[50px]" src="{{ asset('uploads/' .$attachment) }}" alt="">
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        
                        <button x-on:click="submitTask({{ $activeTask->id }})" type="button" class=" h-[40px] bg-blue-200 text-blue-900 capitalize font-semibold text-xs rounded-xl px-3 py-[2px] flex  justify-center items-center">
                            <span class="text-" wire:loading.remove wire:target='submitTask({{ $activeTask->id }})'>
                               Submit Task 
                            </span>
                            <div wire:loading wire:target='submitTask({{ $activeTask->id }})'>
                                <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                            </div>
                            {{-- submit task --}}
                        </button>
                    </div>
                </div>
            @empty
            <div class="flex text-center flex-col w-full py-6 px-3 mb-4">
                No Records
            </div>
            @endforelse
        </div>
    
        @include('livewire.partials.footer')
    @push('script-bottom')
        {{-- <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script> --}}
    @endpush
</div>    
@script
<script>
    Alpine.data('task', () => ({
        previewImages: [],
        attachments: @entangle('attachments'),
        viewer : null,
        activeTaskId : @entangle('activeTaskId'),

        async changeTab(status){
            Notiflix.Loading.Dots('', { 'svgColor' : 'aliceblue' });
            
            this.previewImages = [];

            let response = await @this.changeTab(status);

            [... document.querySelectorAll('.image-viewer')]
                .forEach(imageViewer => {
                    // console.log(imageViewer);
                    // console.log(`#${imageViewer.id}`);
                    this.initViewer(imageViewer.id);
                });

            Notiflix.Loading.Remove();

        },

        async submitTask(activeTaskId){

            console.log(activeTaskId);
            
            this.activeTaskId = activeTaskId;

            Notiflix.Loading.Dots();
            let response = await @this.submitTask(activeTaskId);
            Notiflix.Loading.Remove();

            if(!response || !('message' in response)) return;

            if(!response.success) return Notiflix.Notify.Failure(response.message);

            Notiflix.Notify.Success(response.message);

        },

        handleSuccess(){
            console.log(this.attachments);
            console.log(this);
            Notiflix.Loading.Remove();
        },

        handleError(){
            Notiflix.Loading.Remove();
            Notiflix.Notify.Failure('Something went wrong while processing files. Retry or contact support if the issue persists');
        },

        uploadAttachments(activeTaskId){
            
            this.activeTaskId;

            // if(this.viewer) this.viewer.destroy();

            let files = event.currentTarget.files;
            this.previewImages[activeTaskId] = [];

            for(let file of files){
                this.previewImages[activeTaskId].push(URL.createObjectURL(file));
            }

            Notiflix.Loading.Dots();

            @this.uploadMultiple(`attachments.${ activeTaskId }`, files, this.handleSuccess.bind(this), this.handleError.bind(this));

            setTimeout(() => {      
                this.initViewer(`images-${activeTaskId}`)
            }, 1000);

        },
        initViewer(id){
            // this.viewer = 
            new Viewer(document.getElementById(id));
        },
        init(){
            let clipboard = new ClipboardJS('.copy-link');

            clipboard.on('success', function(e) {
                // selectText("#task-link");

                Notiflix.Notify.Success('Copied successfully', {
                    fontFamily: "Poppins",
                })
            });
        }
    }));
</script>
@endscript