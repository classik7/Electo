<div class="dashboard-preview-sidebar hidden w-[190px] shrink-0 border-r xl:block">

    <div class="space-y-2 p-4">

        {{-- Dashboard --}}
        <button
            type="button"
            onclick="guestPreviewNavigation('{{ route('dashboard') }}')"
            class="dashboard-preview-nav-item dashboard-preview-nav-active w-full text-left"
        >
            <span>🏠</span>
            <span>Dashboard</span>
        </button>


        {{-- Elections --}}
        <button
            type="button"
            onclick="guestPreviewNavigation('{{ url('/elections') }}')"
            class="dashboard-preview-nav-item w-full text-left"
        >
            <span>🗳️</span>
            <span>Elections</span>
        </button>


        {{-- Candidates --}}
        <button
            type="button"
            onclick="guestPreviewNavigation('{{ url('/candidates') }}')"
            class="dashboard-preview-nav-item w-full text-left"
        >
            <span>👥</span>
            <span>Candidates</span>
        </button>


        {{-- Voters --}}
        <button
            type="button"
            onclick="guestPreviewNavigation('{{ url('/voters') }}')"
            class="dashboard-preview-nav-item w-full text-left"
        >
            <span>🧑</span>
            <span>Voters</span>
        </button>


        {{-- Analytics --}}
        <button
            type="button"
            onclick="guestPreviewNavigation('{{ url('/results') }}')"
            class="dashboard-preview-nav-item w-full text-left"
        >
            <span>📊</span>
            <span>Analytics</span>
        </button>


        {{-- Reports --}}
        <button
            type="button"
            onclick="guestPreviewNavigation('{{ url('/reports') }}')"
            class="dashboard-preview-nav-item w-full text-left"
        >
            <span>📄</span>
            <span>Reports</span>
        </button>


        {{-- Settings --}}
        <button
            type="button"
            onclick="guestPreviewNavigation('{{ url('/settings') }}')"
            class="dashboard-preview-nav-item w-full text-left"
        >
            <span>⚙️</span>
            <span>Settings</span>
        </button>

    </div>

</div>