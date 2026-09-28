@auth

<header
    class="
        h-16
        flex
        items-center
        justify-between
        border-b
        border-blue-700/30
        bg-blue-600
        px-6
        text-white
        transition-colors
        duration-300

        dark:border-white/10
        dark:bg-[#132544]
    "
>

    {{-- ========================================================= --}}
    {{-- LEFT --}}
    {{-- ========================================================= --}}

    <div class="min-w-0">

        <h1
            class="
                text-xl
                font-bold
                leading-tight
                text-white
            "
        >
            @yield('page-title')
        </h1>

        <p
            class="
                mt-0.5
                text-xs
                text-blue-100
                dark:text-gray-400
            "
        >
            Welcome back, {{ auth()->user()->name }}
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- RIGHT --}}
    {{-- ========================================================= --}}

    <div class="flex items-center gap-4">


        {{-- ===================================================== --}}
        {{-- SEARCH --}}
        {{-- ===================================================== --}}

        <div class="relative hidden md:block">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="
                    absolute
                    left-3
                    top-2.5
                    h-4
                    w-4
                    text-blue-100
                    dark:text-gray-400
                "
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"
                />

            </svg>


            <input
                type="text"
                placeholder="Search..."
                class="
                    w-64
                    rounded-lg
                    border
                    border-blue-400/40
                    bg-blue-700/40
                    py-2
                    pl-9
                    pr-3
                    text-sm
                    text-white
                    placeholder-blue-100/70
                    outline-none
                    transition

                    focus:border-white/60
                    focus:ring-2
                    focus:ring-white/20

                    dark:border-white/10
                    dark:bg-[#0B1730]
                    dark:text-white
                    dark:placeholder-gray-500
                    dark:focus:border-blue-500
                    dark:focus:ring-blue-500/20
                "
            >

        </div>


        {{-- ===================================================== --}}
        {{-- MY VOTING --}}
        {{-- ===================================================== --}}

        <a
            href="{{ route('voting.my') }}"
            class="
                group
                relative
                hidden
                items-center
                gap-2
                overflow-hidden
                rounded-xl
                border
                border-cyan-200/40
                bg-white/[0.10]
                px-3
                py-1.5
                text-white
                backdrop-blur-xl
                shadow-[0_5px_18px_rgba(6,182,212,0.10)]
                transition-all
                duration-300

                hover:-translate-y-0.5
                hover:border-cyan-100/70
                hover:bg-white/[0.18]
                hover:shadow-[0_8px_22px_rgba(6,182,212,0.18)]

                sm:flex

                dark:border-cyan-400/30
                dark:bg-white/[0.06]
                dark:hover:border-cyan-300/60
                dark:hover:bg-white/[0.10]
            "
        >

            <span
                class="
                    absolute
                    -right-4
                    -top-4
                    h-10
                    w-10
                    rounded-full
                    bg-cyan-300/20
                    blur-xl
                    transition-all
                    duration-500
                    group-hover:bg-cyan-200/30
                    dark:bg-cyan-400/20
                    dark:group-hover:bg-cyan-300/30
                "
            ></span>


            <span
                class="
                    relative
                    flex
                    h-7
                    w-7
                    items-center
                    justify-center
                    rounded-lg
                    border
                    border-cyan-200/30
                    bg-gradient-to-br
                    from-blue-500/30
                    to-cyan-400/30
                "
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="
                        h-3.5
                        w-3.5
                        text-cyan-100
                        transition-transform
                        duration-300
                        group-hover:scale-110
                        dark:text-cyan-300
                    "
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 4.5h14a1.5 1.5 0 011.5 1.5v12a1.5 1.5 0 01-1.5 1.5H5A1.5 1.5 0 013.5 18V6A1.5 1.5 0 015 4.5z"
                    />

                    <path
                        stroke-linecap="round"
                        d="M8 9h8M8 12h5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.5 16l1.5 1.5 3-3"
                    />

                </svg>

            </span>


            <span class="relative flex flex-col leading-none">

                <span
                    class="
                        text-[8px]
                        font-semibold
                        uppercase
                        tracking-[0.13em]
                        text-cyan-100/90
                        dark:text-cyan-300/80
                    "
                >
                    My Voting
                </span>

                <span
                    class="
                        mt-0.5
                        text-[11px]
                        font-bold
                        text-white
                    "
                >
                    Vote Now
                </span>

            </span>


            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="
                    relative
                    h-3
                    w-3
                    text-blue-100
                    transition-all
                    duration-300
                    group-hover:translate-x-1
                    group-hover:text-white
                    dark:text-slate-400
                    dark:group-hover:text-cyan-300
                "
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 12h14M13 6l6 6-6 6"
                />

            </svg>

        </a>


        {{-- ===================================================== --}}
        {{-- NOTIFICATIONS --}}
        {{-- ===================================================== --}}

        @php

            /*
            |--------------------------------------------------------------------------
            | Load Recent Notifications
            |--------------------------------------------------------------------------
            |
            | We deliberately load both read and unread notifications.
            | This means the notification center does not become empty
            | after the user reads a notification.
            |
            */

            $notifications = auth()
                ->user()
                ->notifications()
                ->latest()
                ->take(8)
                ->get();


            /*
            |--------------------------------------------------------------------------
            | Unread Count
            |--------------------------------------------------------------------------
            */

            $unreadNotificationCount = auth()
                ->user()
                ->unreadNotifications()
                ->count();

        @endphp


        <div
            id="notification-container"
            class="relative"
        >


            {{-- ================================================= --}}
            {{-- NOTIFICATION BUTTON --}}
            {{-- ================================================= --}}

            <button
                type="button"
                id="notification-button"
                class="
                    relative
                    flex
                    h-9
                    w-9
                    items-center
                    justify-center
                    rounded-lg
                    text-white
                    transition

                    hover:bg-white/10

                    focus:outline-none
                    focus:ring-2
                    focus:ring-white/30
                "
                aria-label="Notifications"
                aria-expanded="false"
                aria-haspopup="true"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0h6z"
                    />

                </svg>


                {{-- ================================================= --}}
                {{-- LIVE UNREAD COUNT --}}
                {{-- ================================================= --}}

                <span
                    id="notification-count"
                    class="
                        absolute
                        -right-0.5
                        -top-0.5
                        flex
                        min-h-4
                        min-w-4
                        items-center
                        justify-center
                        rounded-full
                        bg-red-500
                        px-1
                        text-[9px]
                        font-bold
                        leading-none
                        text-white
                        ring-2
                        ring-blue-600
                        dark:ring-[#132544]
                        {{ $unreadNotificationCount > 0 ? '' : 'hidden' }}
                    "
                >
                    {{ $unreadNotificationCount > 99 ? '99+' : $unreadNotificationCount }}
                </span>

            </button>


            {{-- ================================================= --}}
            {{-- NOTIFICATION DROPDOWN --}}
            {{-- ================================================= --}}

            <div
                id="notification-dropdown"
                class="
                    absolute
                    right-0
                    top-12
                    z-[100]
                    hidden
                    w-[380px]
                    max-w-[calc(100vw-2rem)]
                    overflow-hidden
                    rounded-2xl
                    border
                    border-slate-200
                    bg-white
                    shadow-[0_20px_60px_rgba(15,23,42,0.18)]

                    dark:border-white/10
                    dark:bg-[#132544]
                "
            >


                {{-- ================================================= --}}
                {{-- HEADER --}}
                {{-- ================================================= --}}

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        border-b
                        border-slate-200
                        px-5
                        py-4

                        dark:border-white/10
                    "
                >

                    <div>

                        <h3
                            class="
                                text-sm
                                font-bold
                                text-slate-900
                                dark:text-white
                            "
                        >
                            Notifications
                        </h3>

                        <p
                            id="notification-summary"
                            class="
                                mt-0.5
                                text-[11px]
                                text-slate-500
                                dark:text-gray-400
                            "
                        >

                            @if($unreadNotificationCount > 0)

                                {{ $unreadNotificationCount }}
                                {{ $unreadNotificationCount === 1 ? 'unread notification' : 'unread notifications' }}

                            @else

                                You're all caught up.

                            @endif

                        </p>

                    </div>


                    <button
                        type="button"
                        id="mark-all-notifications"
                        class="
                            {{ $unreadNotificationCount > 0 ? '' : 'hidden' }}
                            text-[11px]
                            font-semibold
                            text-blue-600
                            transition
                            hover:text-blue-700

                            dark:text-cyan-300
                            dark:hover:text-cyan-200
                        "
                    >
                        Mark all as read
                    </button>

                </div>


                {{-- ================================================= --}}
                {{-- NOTIFICATION LIST --}}
                {{-- ================================================= --}}

                <div
                    id="notification-list"
                    class="max-h-[420px] overflow-y-auto"
                >

                    @forelse($notifications as $notification)

                        @php

                            $data = $notification->data ?? [];

                            $title =
                                $data['title']
                                ?? 'Notification';

                            $message =
                                $data['message']
                                ?? '';

                            $url =
                                $data['url']
                                ?? null;

                            $type =
                                $data['type']
                                ?? 'general';

                            $icon =
                                $data['icon']
                                ?? 'bell';

                            $isUnread =
                                is_null($notification->read_at);

                        @endphp


                        <div
                            class="
                                notification-item
                                border-b
                                border-slate-100
                                transition
                                last:border-b-0

                                hover:bg-slate-50

                                dark:border-white/5
                                dark:hover:bg-white/[0.03]

                                {{ $isUnread ? 'bg-blue-50/40 dark:bg-blue-500/[0.04]' : '' }}
                            "
                            data-notification-id="{{ $notification->id }}"
                            data-unread="{{ $isUnread ? '1' : '0' }}"
                        >

                            <div class="flex gap-3 px-5 py-4">


                                {{-- ================================================= --}}
                                {{-- ICON --}}
                                {{-- ================================================= --}}

                                <div
                                    class="
                                        flex
                                        h-9
                                        w-9
                                        shrink-0
                                        items-center
                                        justify-center
                                        rounded-xl
                                        bg-blue-50
                                        text-blue-600

                                        dark:bg-blue-500/10
                                        dark:text-cyan-300
                                    "
                                >

                                    @if($icon === 'shield')

                                        🛡️

                                    @elseif($icon === 'vote')

                                        🗳️

                                    @elseif($icon === 'result')

                                        📊

                                    @elseif($icon === 'certificate')

                                        🏆

                                    @else

                                        🔔

                                    @endif

                                </div>


                                {{-- ================================================= --}}
                                {{-- CONTENT --}}
                                {{-- ================================================= --}}

                                <div class="min-w-0 flex-1">


                                    @if($url)

                                        <a
                                            href="{{ $url }}"
                                            class="
                                                notification-link
                                                block
                                                cursor-pointer
                                            "
                                            data-notification-id="{{ $notification->id }}"
                                        >

                                            <p
                                                class="
                                                    text-xs
                                                    font-bold
                                                    text-slate-900
                                                    dark:text-white
                                                "
                                            >
                                                {{ $title }}
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    line-clamp-2
                                                    text-[11px]
                                                    leading-5
                                                    text-slate-500
                                                    dark:text-gray-400
                                                "
                                            >
                                                {{ $message }}
                                            </p>

                                        </a>

                                    @else

                                        <button
                                            type="button"
                                            class="
                                                notification-link
                                                block
                                                w-full
                                                cursor-pointer
                                                text-left
                                            "
                                            data-notification-id="{{ $notification->id }}"
                                        >

                                            <p
                                                class="
                                                    text-xs
                                                    font-bold
                                                    text-slate-900
                                                    dark:text-white
                                                "
                                            >
                                                {{ $title }}
                                            </p>

                                            <p
                                                class="
                                                    mt-1
                                                    line-clamp-2
                                                    text-[11px]
                                                    leading-5
                                                    text-slate-500
                                                    dark:text-gray-400
                                                "
                                            >
                                                {{ $message }}
                                            </p>

                                        </button>

                                    @endif


                                    <div class="mt-2 flex items-center gap-2">

                                        <span
                                            class="
                                                text-[10px]
                                                text-slate-400
                                                dark:text-gray-500
                                            "
                                        >
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>


                                        @if($isUnread)

                                            <span
                                                class="
                                                    notification-unread-label
                                                    rounded-full
                                                    bg-blue-100
                                                    px-2
                                                    py-0.5
                                                    text-[9px]
                                                    font-bold
                                                    text-blue-600

                                                    dark:bg-blue-500/10
                                                    dark:text-blue-300
                                                "
                                            >
                                                Unread
                                            </span>

                                        @else

                                            <span
                                                class="
                                                    notification-read-label
                                                    text-[9px]
                                                    font-semibold
                                                    text-slate-400
                                                "
                                            >
                                                Read
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                {{-- ================================================= --}}
                                {{-- UNREAD DOT --}}
                                {{-- ================================================= --}}

                                <span
                                    class="
                                        notification-unread-dot
                                        mt-1
                                        h-2
                                        w-2
                                        shrink-0
                                        rounded-full
                                        bg-blue-500
                                        {{ $isUnread ? '' : 'hidden' }}
                                    "
                                ></span>

                            </div>

                        </div>

                    @empty

                        <div
                            id="notification-empty"
                            class="
                                px-6
                                py-12
                                text-center
                            "
                        >

                            <div
                                class="
                                    mx-auto
                                    flex
                                    h-12
                                    w-12
                                    items-center
                                    justify-center
                                    rounded-full
                                    bg-slate-100
                                    text-slate-400

                                    dark:bg-white/5
                                    dark:text-gray-500
                                "
                            >
                                🔔
                            </div>

                            <p
                                class="
                                    mt-3
                                    text-sm
                                    font-semibold
                                    text-slate-700
                                    dark:text-gray-300
                                "
                            >
                                No notifications yet
                            </p>

                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-400
                                    dark:text-gray-500
                                "
                            >
                                Your Electo notifications will appear here.
                            </p>

                        </div>

                    @endforelse

                </div>


                {{-- ================================================= --}}
                {{-- FOOTER --}}
                {{-- ================================================= --}}

                <div
                    class="
                        border-t
                        border-slate-200
                        px-5
                        py-3
                        text-center

                        dark:border-white/10
                    "
                >

                    <a
                        href="{{ route('settings.index', ['section' => 'notifications']) }}"
                        class="
                            text-xs
                            font-semibold
                            text-blue-600
                            transition
                            hover:text-blue-700

                            dark:text-cyan-300
                            dark:hover:text-cyan-200
                        "
                    >
                        View notification settings
                    </a>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- USER PROFILE --}}
        {{-- ===================================================== --}}

        <a
            href="{{ route('settings.index', ['section' => 'account']) }}"
            title="Account Settings"
            class="
                group
                flex
                items-center
                gap-3
                rounded-xl
                px-2
                py-1.5
                transition-all
                duration-200

                hover:bg-white/10

                dark:hover:bg-white/5
            "
        >

            {{-- AVATAR --}}

            <div
                class="
                    relative
                    flex
                    h-9
                    w-9
                    shrink-0
                    items-center
                    justify-center
                    overflow-hidden
                    rounded-full
                    bg-blue-600
                    text-sm
                    font-bold
                    text-white
                    ring-2
                    ring-white/20
                    transition-all
                    duration-200

                    group-hover:ring-white/50

                    dark:ring-white/10
                    dark:group-hover:ring-blue-400/50
                "
            >

                @if(auth()->user()->avatar)

                    <img
                        src="{{ asset('storage/' . auth()->user()->avatar) }}"
                        alt="{{ auth()->user()->name }}"
                        class="h-full w-full object-cover"
                    >

                @else

                    <span>
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>

                @endif

            </div>


            {{-- USER INFORMATION --}}

            <div class="hidden max-w-[190px] lg:block">

                <h4
                    class="
                        truncate
                        text-sm
                        font-semibold
                        leading-tight
                        text-white
                        transition-colors
                        group-hover:text-blue-100
                    "
                >
                    {{ auth()->user()->name }}
                </h4>

                <p
                    class="
                        mt-0.5
                        text-[10px]
                        text-blue-100/70
                        dark:text-gray-400
                    "
                >
                    {{ ucfirst(auth()->user()->role ?? 'User') }}
                </p>

            </div>

        </a>

    </div>

</header>


{{-- ============================================================= --}}
{{-- NOTIFICATION JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const button =
        document.getElementById('notification-button');

    const dropdown =
        document.getElementById('notification-dropdown');

    const container =
        document.getElementById('notification-container');

    const countElement =
        document.getElementById('notification-count');

    const summaryElement =
        document.getElementById('notification-summary');

    const listElement =
        document.getElementById('notification-list');

    const markAllButton =
        document.getElementById('mark-all-notifications');


    if (!button || !dropdown) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Current Unread Count
    |--------------------------------------------------------------------------
    */

    let unreadCount = Number(
        @json($unreadNotificationCount)
    );


    /*
    |--------------------------------------------------------------------------
    | Update Badge
    |--------------------------------------------------------------------------
    */

    function updateNotificationBadge(count) {

        unreadCount =
            Math.max(0, Number(count) || 0);


        if (countElement) {

            if (unreadCount > 0) {

                countElement.textContent =
                    unreadCount > 99
                        ? '99+'
                        : unreadCount;

                countElement.classList.remove(
                    'hidden'
                );

            } else {

                countElement.textContent = '0';

                countElement.classList.add(
                    'hidden'
                );

            }

        }


        if (summaryElement) {

            if (unreadCount === 0) {

                summaryElement.textContent =
                    "You're all caught up.";

            } else {

                summaryElement.textContent =
                    unreadCount +
                    (
                        unreadCount === 1
                            ? ' unread notification'
                            : ' unread notifications'
                    );

            }

        }


        if (markAllButton) {

            if (unreadCount > 0) {

                markAllButton.classList.remove(
                    'hidden'
                );

            } else {

                markAllButton.classList.add(
                    'hidden'
                );

            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Dropdown
    |--------------------------------------------------------------------------
    */

    button.addEventListener(
        'click',
        function (event) {

            event.stopPropagation();

            const isHidden =
                dropdown.classList.contains(
                    'hidden'
                );


            dropdown.classList.toggle(
                'hidden'
            );


            button.setAttribute(
                'aria-expanded',
                isHidden
                    ? 'true'
                    : 'false'
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Close When Clicking Outside
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            if (
                container &&
                !container.contains(
                    event.target
                )
            ) {

                dropdown.classList.add(
                    'hidden'
                );

                button.setAttribute(
                    'aria-expanded',
                    'false'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Mark One Notification As Read
    |--------------------------------------------------------------------------
    */

    async function markNotificationAsRead(
        notificationId
    ) {

        if (!notificationId) {
            return false;
        }


        try {

            const response =
                await fetch(
                    `/notifications/${notificationId}/read`,
                    {
                        method: 'POST',

                        headers: {

                            'X-CSRF-TOKEN':
                                document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .getAttribute(
                                        'content'
                                    ),

                            'Accept':
                                'application/json',

                            'Content-Type':
                                'application/json'

                        },

                        body:
                            JSON.stringify({})
                    }
                );


            if (!response.ok) {

                throw new Error(
                    'Unable to mark notification as read.'
                );

            }


            const data =
                await response.json();


            if (
                data.success &&
                typeof data.unread_count !== 'undefined'
            ) {

                updateNotificationBadge(
                    data.unread_count
                );

            }


            return true;


        } catch (error) {

            console.error(
                'Notification read error:',
                error
            );

            return false;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Individual Notification Click
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll(
            '.notification-link'
        )
        .forEach(
            function (link) {

                link.addEventListener(
                    'click',
                    async function (event) {

                        const item =
                            this.closest(
                                '.notification-item'
                            );


                        if (!item) {
                            return;
                        }


                        const notificationId =
                            item.dataset.notificationId;


                        if (!notificationId) {
                            return;
                        }


                        const wasUnread =
                            item.dataset.unread === '1';


                        /*
                        |------------------------------------------------------
                        | No need to update database if already read.
                        |------------------------------------------------------
                        */

                        if (!wasUnread) {

                            return;

                        }


                        event.preventDefault();


                        const destination =
                            this.tagName === 'A'
                                ? this.href
                                : null;


                        /*
                        |------------------------------------------------------
                        | Temporarily disable repeated clicks.
                        |------------------------------------------------------
                        */

                        this.style.pointerEvents =
                            'none';


                        const success =
                            await markNotificationAsRead(
                                notificationId
                            );


                        if (success) {

                            /*
                            |--------------------------------------------------------------------------
                            | Update Item Visually
                            |--------------------------------------------------------------------------
                            */

                            item.dataset.unread =
                                '0';


                            item.classList.remove(
                                'bg-blue-50/40',
                                'dark:bg-blue-500/[0.04]'
                            );


                            const unreadDot =
                                item.querySelector(
                                    '.notification-unread-dot'
                                );


                            if (unreadDot) {

                                unreadDot.classList.add(
                                    'hidden'
                                );

                            }


                            const unreadLabel =
                                item.querySelector(
                                    '.notification-unread-label'
                                );


                            if (unreadLabel) {

                                unreadLabel.outerHTML =
                                    '<span class="notification-read-label text-[9px] font-semibold text-slate-400">Read</span>';

                            }


                            if (destination) {

                                window.location.href =
                                    destination;

                            }

                        } else {

                            this.style.pointerEvents =
                                '';

                            alert(
                                'Unable to mark this notification as read. Please try again.'
                            );

                        }

                    }
                );

            }
        );


    /*
    |--------------------------------------------------------------------------
    | Mark All As Read
    |--------------------------------------------------------------------------
    */

    if (markAllButton) {

        markAllButton.addEventListener(
            'click',
            async function () {

                if (unreadCount === 0) {
                    return;
                }


                markAllButton.disabled =
                    true;


                const originalText =
                    markAllButton.textContent;


                markAllButton.textContent =
                    'Marking...';


                try {

                    const response =
                        await fetch(
                            '{{ route('notifications.read.all') }}',
                            {
                                method: 'POST',

                                headers: {

                                    'X-CSRF-TOKEN':
                                        document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            .getAttribute(
                                                'content'
                                            ),

                                    'Accept':
                                        'application/json',

                                    'Content-Type':
                                        'application/json'

                                },

                                body:
                                    JSON.stringify({})
                            }
                        );


                    if (!response.ok) {

                        throw new Error(
                            'Unable to mark notifications as read.'
                        );

                    }


                    const data =
                        await response.json();


                    /*
                    |--------------------------------------------------------------------------
                    | Update Count
                    |--------------------------------------------------------------------------
                    */

                    updateNotificationBadge(
                        data.unread_count ?? 0
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Update Every Notification
                    |--------------------------------------------------------------------------
                    */

                    document
                        .querySelectorAll(
                            '.notification-item'
                        )
                        .forEach(
                            function (item) {

                                item.dataset.unread =
                                    '0';


                                item.classList.remove(
                                    'bg-blue-50/40',
                                    'dark:bg-blue-500/[0.04]'
                                );


                                const dot =
                                    item.querySelector(
                                        '.notification-unread-dot'
                                    );


                                if (dot) {

                                    dot.classList.add(
                                        'hidden'
                                    );

                                }


                                const unreadLabel =
                                    item.querySelector(
                                        '.notification-unread-label'
                                    );


                                if (unreadLabel) {

                                    unreadLabel.outerHTML =
                                        '<span class="notification-read-label text-[9px] font-semibold text-slate-400">Read</span>';

                                }

                            }
                        );


                    markAllButton.textContent =
                        originalText;


                } catch (error) {

                    console.error(
                        'Mark all notifications error:',
                        error
                    );


                    markAllButton.textContent =
                        originalText;


                    alert(
                        'Unable to mark notifications as read. Please try again.'
                    );

                } finally {

                    markAllButton.disabled =
                        false;

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Initialize Badge
    |--------------------------------------------------------------------------
    */

    updateNotificationBadge(
        unreadCount
    );

});

</script>

@endauth