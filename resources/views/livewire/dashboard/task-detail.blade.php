
<div x-data="taskDetail" class="flex flex-col w-full min-h-full pb-[100px] font-poppins bg-slate-100">
    <x-dashboard.header
            title="Task Detail"
        >
        <x-slot:rightLink>
            {{-- right link --}}        
        </x-slot:rightLink>
    </x-dashboard.header>

    <div role="tabpanel" id="content" class="bg-whit mt-5 px-5">
          
            <div class="flex flex-col w-full py-6 p-5 rounded-xl bg-white mb-4 relative">
                <div class="flex w-full justify-between flex-col gap-3">
                    <span class="task-{{ strtolower($this->taskHall->status) }} rounded-full absolute right-2 text-xs py-[2px] px-3 top-2">
                        {{ ucFirst($this->taskHall->status) }}
                    </span>
                    <h4 class="font-[550] text-slate-800/90">
                        {{ $this->taskHall->task->title_label }}
                    </h4>
                    <p class="text-sm text-slate-700">
                    {{ $this->taskHall->task->sub_title_label }}
                    </p>
                    <b class="text-green-500">
                    {{ format_currency(auth()->user()->level->profit_per_task) }}
                    </b>
                    <p class="text-sm">
                        Upload requirements: Follow the image creation process to upload photos to complete the task
                    </p>
                    <div>
                        @if($this->taskHall->status == 'pending')
                        <label class="border rounded-md justify-center bg-blue-50/50  my-2 items-center flex">
                            <div class="h-10 w-10 flex justify-center items-center">
                                <img src="{{ asset('img/icons/task.png') }}" class="w-8 h-8">
                                <input x-ref="attachments" multiple x-on:change="uploadAttachments" class="hidden" type="file"  name="" id=""/>
                            </div>
                        </label>
                        @error('attachments')
                            <span class="text-red-500">
                                {{ $message }}
                            </span>
                        @enderror
                        <ul class="flex gap-2" id="images" wire:ignore>
                            <template x-for="attachment in attachments">
                                <li>
                                    <img class="w-[50px] h-[50px]" x-bind:src="attachment" alt="">
                                </li>
                            </template>
                        </ul>
                        @else
                        <ul class="flex gap-2" id="images" wire:ignore>
                           @foreach ($this->taskHall->attachments as $attachment)
                               
                           <li>
                               <img class="w-[50px] h-[50px]" src="{{ asset('uploads/' .$attachment) }}" alt="">
                           </li>
                           @endforeach
                        </ul>
                        @endif
                    </div>
                   
                </div>
            </div>
      
    </div>

    <div role="tabpanel" id="content" class="bg-whit mt-5 px-5">
          
        <div class="flex flex-col w-full rounded-2xl bg-white mb-4 overflow-hidden">
            <div class="flex w-full justify-between flex-row gap-3 pl-4">
                <div class="flex gap-2 overflow-x-scroll no-scrollbar pr-4">
                    <span  data-clipboard-text="{{ $this->taskHall->task->link }}" id="task-link" class="text-sm whitespace-nowrap flex justify-center items-center text-slate-600 copy-link hover:cursor-pointer">
                         {{ $this->taskHall->task->link }} {{ $this->taskHall->task->link }}
                    </span>
                </div>
                <div class="flex justify-between flex-shrink-0">
                    <div class="px-2 flex items-center justify-center shrink-0 copy-link hover:cursor-pointer" data-clipboard-text="{{ $this->taskHall->task->link }}">
                        <x-link-icon width="20" height="21" class="text-slate-500"/>
                    </div>
                    <a target="_blank" href="{{ $this->taskHall->task->link }}" class="bg-blue-500 py-2 px-4 text-white text-sm" href="">Open</a>
                </div>
            </div>
        </div>
  
</div>

{{-- @if($this->taskHall->status == 'pending') --}}
    <div class="fixed bottom-0 left-0 z-50 w-full">
        <div class="grid h-full max-w-lg  mx-auto font-medium">
            <button @disabled($this->taskHall->status != 'pending') 
                @if($this->taskHall->status == 'pending')
                x-on:click="submitTask" 
                @endif
                type="button" class=" h-[40px] bg-blue-500 text-white capitalize font-semibold text-sm px-3 py-[2px] flex  justify-center items-center">
                <span class="text-" wire:loading.remove wire:target='submitTask'>
                    @if($this->taskHall->status == 'pending') Submit Task @else {{ ucFirst($this->taskHall->status) }} @endif
                </span>
                <div wire:loading wire:target='submitTask'>
                    <i class="uil uil-spinner justify-center items-center flex text-sm text-white mr-2 font-bold animate-spin"></i>
                </div>
            </button>
        </div>
    </div>
{{-- @endif --}}
@push('script-bottom')
    {{-- <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script> --}}
@endpush
</div>    
@script
<script>
    Alpine.data('taskDetail', () => ({
        attachments: [],
        files: [],
        taskStatus: @js($this->taskHall->status),
        viewer : null,

        async submitTask(){
            Notiflix.Loading.Dots();
            let response = await @this.submitTask();
            Notiflix.Loading.Remove();

            if(!response || !('message' in response)) return;

            if(!response.success) return Notiflix.Notify.Failure(response.message);

            Notiflix.Notify.Success(response.message);

        },

        handleSuccess(){
            Notiflix.Loading.Remove();
        },

        handleError(){
            Notiflix.Loading.Remove();
            Notiflix.Notify.Failure('Something went wrong while processing files. Retry or contact support if the issue persists');
        },

        uploadAttachments(){
            if(this.viewer) this.viewer.destroy();

            let files = event.currentTarget.files;
            
            for(let file of files){
                this.attachments.push(URL.createObjectURL(file));
            }

            Notiflix.Loading.Dots();

            @this.uploadMultiple('attachments', files, this.handleSuccess, this.handleError);

            setTimeout(() => {      
                this.initViewer()
            }, 1000);

        },
        initViewer(){
            this.viewer = new Viewer(document.getElementById('images'));
        },
        init(){
            if(this.taskStatus.toLowerCase() != 'pending') this.initViewer();
            let clipboard = new ClipboardJS('.copy-link');

            clipboard.on('success', function(e) {
                selectText("#task-link");

                Notiflix.Notify.Success('Copied successfully', {
                    fontFamily: "Poppins",
                })
            });
        }
    }));
</script>
@endscript
