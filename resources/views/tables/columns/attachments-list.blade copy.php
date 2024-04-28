

<div x-data="attachment">
    @php($attachments = $getState() ?? [])

    <ul x-init="recordId = {{ $getRecord()->id }}" style="display: flex; gap: 8px" id="images-{{ $getRecord()->id }}" wire:ignore>
        @foreach ($attachments as $attachment)
        <li>
            <img style="height: 50px; width:50px" src="{{ asset('uploads/' .$attachment) }}" alt="">
        </li>
        @endforeach
     </ul>
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
