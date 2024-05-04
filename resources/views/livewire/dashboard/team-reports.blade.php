<div class="bg-slate-100 w-full min-h-full pb-[100px]" x-data="teamReports">
    <style>
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: initial !important;
        }
        .select2.select2-container{
            width: 100% !important;
        }
    </style>
    <x-dashboard.header
        title="Team Reports"
    >
        <x-slot:rightLink>
            <a href="{{ route('wallet') }}">
                Team
            </a>
        </x-slot:rightLink>
    </x-dashboard.header>
</div>

@script
<script>
    Alpine.data('teamReports', () => ({
        init(){
            alert('hey');
        }
    }));
</script>
@endscript