<div class="landing-dashboard">

    {{-- Browser/dashboard frame --}}
    <div class="landing-dashboard-window">


        {{-- ================================================= --}}
        {{-- WINDOW HEADER --}}
        {{-- ================================================= --}}

        <div class="landing-dashboard-header">

            <div class="landing-window-dots">

                <span class="dot-red"></span>
                <span class="dot-yellow"></span>
                <span class="dot-green"></span>

            </div>

            <span class="landing-dashboard-title">
                Electo Enterprise Dashboard
            </span>

            <span class="landing-admin-badge">
                Admin
            </span>

        </div>


        {{-- ================================================= --}}
        {{-- DASHBOARD TOOLBAR --}}
        {{-- ================================================= --}}

        <div class="landing-dashboard-toolbar">

            <div class="landing-search">

                <span>⌕</span>

                <span>
                    Search elections...
                </span>

            </div>


            <div class="landing-demo-user">

                <div class="landing-avatar">
                    DE
                </div>

                <div>

                    <strong>
                        Demo Environment
                    </strong>

                    <small>
                        ● Enterprise Preview
                    </small>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- MAIN DASHBOARD --}}
        {{-- ================================================= --}}

        <div class="landing-dashboard-body">


            {{-- SIDEBAR --}}
            <div class="landing-dashboard-sidebar">

                <button
                    type="button"
                    onclick="guestPreviewNavigation('{{ route('dashboard') }}')"
                    class="landing-sidebar-active"
                >
                    <span>🏠</span>
                    Dashboard
                </button>


                <button
                    type="button"
                    onclick="guestPreviewNavigation('{{ url('/elections') }}')"
                >
                    <span>🗳️</span>
                    Elections
                </button>


                <button
                    type="button"
                    onclick="guestPreviewNavigation('{{ url('/candidates') }}')"
                >
                    <span>👥</span>
                    Candidates
                </button>


                <button
                    type="button"
                    onclick="guestPreviewNavigation('{{ url('/voters') }}')"
                >
                    <span>🧑</span>
                    Voters
                </button>


                <button
                    type="button"
                    onclick="guestPreviewNavigation('{{ url('/results') }}')"
                >
                    <span>📊</span>
                    Analytics
                </button>


                <button
                    type="button"
                    onclick="guestPreviewNavigation('{{ url('/settings') }}')"
                >
                    <span>⚙️</span>
                    Settings
                </button>

            </div>


            {{-- CONTENT --}}
            <div class="landing-dashboard-content">


                {{-- Greeting --}}
                <div class="landing-dashboard-heading">

                    <div>

                        <span>
                            OVERVIEW
                        </span>

                        <h3>
                            Election Command Center
                        </h3>

                    </div>

                    <div class="landing-live-indicator">
                        <i></i>
                        Live
                    </div>

                </div>


                {{-- KPI --}}
                <div class="landing-kpi-grid">

                    <div class="landing-kpi">

                        <span>
                            ACTIVE ELECTIONS
                        </span>

                        <strong>
                            124
                        </strong>

                        <small class="positive">
                            ▲ 12% this month
                        </small>

                    </div>


                    <div class="landing-kpi">

                        <span>
                            REGISTERED VOTERS
                        </span>

                        <strong class="cyan">
                            48K
                        </strong>

                        <small class="cyan-text">
                            +2,340 new voters
                        </small>

                    </div>


                    <div class="landing-kpi">

                        <span>
                            PARTICIPATION
                        </span>

                        <strong class="indigo">
                            78%
                        </strong>

                        <small class="indigo-text">
                            Live turnout
                        </small>

                    </div>


                    <div class="landing-kpi">

                        <span>
                            INTEGRITY
                        </span>

                        <strong class="green">
                            99.99%
                        </strong>

                        <small class="positive">
                            ✓ Verified
                        </small>

                    </div>

                </div>


                {{-- Lower analytics --}}
                <div class="landing-analytics-grid">


                    {{-- Turnout --}}
                    <div class="landing-analytics-card">

                        <div class="analytics-heading">

                            <div>

                                <span>
                                    LIVE TURNOUT
                                </span>

                                <strong>
                                    78.4%
                                </strong>

                            </div>

                            <span class="analytics-pill">
                                Live
                            </span>

                        </div>


                        <div class="landing-chart">

                            <div style="height:35%"></div>
                            <div style="height:52%"></div>
                            <div style="height:43%"></div>
                            <div style="height:68%"></div>
                            <div style="height:58%"></div>
                            <div style="height:79%"></div>
                            <div style="height:91%"></div>
                            <div style="height:73%"></div>
                            <div style="height:88%"></div>

                        </div>

                    </div>


                    {{-- Election status --}}
                    <div class="landing-status-card">

                        <span>
                            ELECTION STATUS
                        </span>

                        <div class="status-row">

                            <div class="status-icon">
                                🗳️
                            </div>

                            <div>

                                <strong>
                                    Annual General Election
                                </strong>

                                <small>
                                    Voting in progress
                                </small>

                            </div>

                        </div>


                        <div class="status-progress">

                            <div></div>

                        </div>


                        <div class="status-footer">

                            <span>
                                8,420 votes
                            </span>

                            <span>
                                78%
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Floating security card --}}
    <div class="landing-floating-card">

        <div class="floating-security-icon">
            ✓
        </div>

        <div>

            <strong>
                Election Verified
            </strong>

            <span>
                End-to-end integrity secured
            </span>

        </div>

    </div>

</div>