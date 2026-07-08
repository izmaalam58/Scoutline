<x-layout>
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <x-slot:title>Prospector — Live Lead Radar</x-slot:title>

    <x-slot:navActions>
        <button class="btn btn-ghost open-drawer-btn" onclick="toggleNavDrawer(true)">
            <span>☰</span> Navigation Menu
        </button>
    </x-slot:navActions>

    <!-- Operational Search Viewport -->
    <section class="dashboard">
        
        <div class="dash-head">
            <h2>Local Business Discovery</h2>
            <span class="scope-count" id="scopeCount">Scope idle</span>
        </div>

        <div class="console">
            <div class="console-field">
                <label for="categoryInput">Business Category</label>
                <input type="text" id="categoryInput" placeholder="e.g. Logistics, Bakery, Clinics" value="Logistics">
            </div>
            <div class="console-field">
                <label for="locationInput">Location Target</label>
                <input type="text" id="locationInput" placeholder="e.g. Gulberg, Lahore" value="Gulberg, Lahore">
            </div>
            <button class="btn btn-signal" id="scanBtn" onclick="runScan()">
                <span class="mini-sweep" id="btnSweep"></span>
                <span id="scanBtnLabel">Run Scan</span>
            </button>
        </div>

        <!-- Scanning Diagnostics Pulse Bar -->
        <div class="scan-status" id="scanStatus">
            <div class="mini-sweep"></div>
            <span id="scanMessage">Interrogating live local registers...</span>
        </div>

        <!-- System Output Ledger Grid -->
        <div id="resultsArea">
            <div class="ledger">
                <div class="empty-state">
                    <div class="eyebrow status-offline">Scope Offline</div>
                    <p>Enter a business category and location target above, then execute a scan sequence.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Layered Windows & Flyout Slide Drawers -->
    <x-slot:modalsAndDrawers>
        <div class="drawer-overlay" id="appDrawerOverlay" onclick="toggleNavDrawer(false)"></div>
        
        <div class="drawer" id="appNavDrawer">
            <div class="drawer-head">
                <span class="drawer-close" onclick="toggleNavDrawer(false)">&times;</span>
                <h3>Menu</h3>
                <div class="drawer-sub">OPERATOR:{{ auth()->user()->email }}</div>
            </div>
            
            <div class="drawer-body">
                <div class="field group-spacing">
                    <label>Navigation Links</label>
                    <a href="{{ url('/') }}" class="btn btn-ghost side-nav-link">
                         Home
                    </a><br></br>
                    <button class="btn btn-ghost side-nav-link" onclick="handleProfileAlert()">
                        Profile Details
                    </button>
                </div>
<br></br>

                <div class="field group-spacing">
                    <label>Recent Queries Archive</label>
                    
                    <div class="archive-list">
                        <div class="lead-card interactive-card" onclick="loadRecentQuery('Logistics', 'Gulberg, Lahore')">
                            <div class="lead-name highlight-gold">Logistics</div>
                            <div class="lead-title">Gulberg, Lahore</div>
                        </div>
                        
                        <div class="lead-card interactive-card" onclick="loadRecentQuery('Bakery', 'DHA Phase 5, Lahore')">
                            <div class="lead-name highlight-gold">Bakery</div>
                            <div class="lead-title">DHA Phase 5, Lahore</div>
                        </div>

                        <div class="lead-card interactive-card" onclick="loadRecentQuery('Dental Clinics', 'Johar Town, Lahore')">
                            <div class="lead-name highlight-gold">Dental Clinics</div>
                            <div class="lead-title">Johar Town, Lahore</div>
                        </div>
                    </div>
                </div>
                <br></br>

                
                <div class="drawer-actions-divider">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-terminate">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="drawer-foot">
                Logged in as: {{ auth()->user()->name }}<br>
            </div>
        </div>
    </x-slot:modalsAndDrawers>

    <!-- External Script Assets Injection -->
        <script src="{{ asset('js/dashboard.js') }}"></script>
</x-layout>