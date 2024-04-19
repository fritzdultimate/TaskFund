<div class="fixed bottom-0 left-0 z-50 w-full h-15 bg-white">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">
        <a href="/app/dashboard" class="flex flex-col items-center justify-center px-2 py-2 hover:bg-gray-50 group {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="text-slate-500 group-hover:text-blue-600 group-[.active]:text-blue-600">
                <x-home-icon/>
            </span>
            <span class="text-xs text-gray-500  group-hover:text-blue-600 group-[.active]:text-blue-600">Home</span>
        </a>

        <a href="/app/tasks" class="flex flex-col items-center justify-center px-2 py-2 hover:bg-gray-50 group {{ request()->routeIs('tasks') ? 'active' : '' }}">
            <span class="text-slate-500 group-hover:text-blue-600 group-[.active]:text-blue-600">
                <x-activity-icon/>
            </span>
            <span class="text-xs text-gray-500  group-hover:text-blue-600 group-[.active]:text-blue-600">Tasks</span>
        </a>

        <a href="{{ route('level') }}" class="inline-flex flex-col items-center justify-center px-2 py-2 hover:bg-gray-50 group {{ request()->routeIs('level') ? 'active' : '' }}">
            <span class="text-slate-500 group-hover:text-blue-600 group-[.active]:text-blue-600">
                <x-star-icon/>
            </span>
            <span class="text-xs text-gray-500  group-hover:text-blue-600 group-[.active]:text-blue-600">level</span>
        </a>

        <a href="{{ route('earning') }}" class="inline-flex flex-col items-center justify-center px-2 py-2 hover:bg-gray-50 group {{ request()->routeIs('earning') ? 'active' : '' }}">
            <span class="text-slate-500 group-hover:text-blue-600 group-[.active]:text-blue-600">
                <x-gift-icon/>
            </span>
            <span class="text-xs text-gray-500  group-hover:text-blue-600 group-[.active]:text-blue-600">Earnings</span>
        </a>

        <a href="{{ route('profile') }}" class="inline-flex flex-col items-center justify-center px-2 py-2 hover:bg-gray-50 group {{ request()->routeIs('profile') ? 'active' : '' }}">
            <span class="text-slate-500 group-hover:text-blue-600 group-[.active]:text-blue-600">
                <x-user-icon/>
            </span>
            <span class="text-xs text-gray-500  group-hover:text-blue-600 group-[.active]:text-blue-600">Profile</span>
        </a>
    </div>
</div>