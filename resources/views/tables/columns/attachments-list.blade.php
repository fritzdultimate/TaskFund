@php($attachments = $getState() ?? [])
@php($record = $getRecord())

<div x-data="attachment" class="fi-ta-col-wrp">
    <div class="flex w-full disabled:pointer-events-none justify-start text-start">
        <div class="fi-ta-image px-3 py-4">
            <div class="flex items-center gap-x-2.5">
                <ul x-init="recordId = {{ $getRecord()->id }}" id="images-{{ $record->id }}" class="flex -space-x-2">
                    @foreach ($attachments as $idx => $attachment)
                    <li>
                        <img 
                            src="{{ asset('uploads/' .$attachment) }}" 
                            style="height: 2rem; width: 2rem; @if($idx > 2)  display:none; @endif" 
                            class="max-w-none object-cover object-center rounded-full ring-white dark:ring-gray-900 ring-2" 
                        />
                    </li>
                    @endforeach
                </ul>
                @php($hiddenImagesCount = count($attachments) - 3)
                @if($hiddenImagesCount > 0 )
                <div style="height: 2rem; width: 2rem; background:#51515a; display: flex; justify-content: center; align-items: center;" class="max-w-none object-cover object-center rounded-full bg-slate-500 ring-white dark:ring-gray-900 ring-2">
                   <small>+{{ $hiddenImagesCount }}</small> 
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@script
    <script>
        Alpine.data('attachment', () => ({
            recordId : null,
            init(){
                this.$nextTick(() => {
                    new Viewer(document.getElementById(`images-${this.recordId}`));
                });
            }
        }));
    </script>
@endscript
