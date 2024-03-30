<div class="w-full h-full">
    <div class="flex flex-col self-stretch w-full h-full gap-6">
        <livewire:dynamic-component
            :is="$current" :key="$current"
            :payload="$payload"
        />
    </div>
</div>

