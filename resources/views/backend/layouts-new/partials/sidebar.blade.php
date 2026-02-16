<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    @php
        $setting = \App\Models\Setting::first()
    @endphp
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <center>
            <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/img/logo/' . $setting->logo) }}" style="max-width: 100%!important">
                </span>
            </center>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    @php
        $usr = Auth::guard('admin')->user();
    @endphp

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->

        @if ($usr->can('dashboard.view'))
            <li class="menu-item">
                <a href="{{ url('admin') }}" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Dashboards">Dashboard</div>
                </a>
            </li>
        @endif

        <li class="menu-item">
            <a href="{{ route('setting') }}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="General Setting">General Setting</div>
            </a>
        </li>

        @if ($usr->can('role.view') || $usr->can('services.view') || $usr->can('divisi.view'))
            <!-- Layouts -->
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div data-i18n="Master Data">Master Data</div>
                </a>

                <ul class="menu-sub">

                    @if ($usr->can('portofolio.view'))
                        <li class="menu-item">
                            <a href="{{ route('portofolio') }}" class="menu-link">
                                <div data-i18n="Portofolio">Portofolio</div>
                            </a>
                        </li>
                    @endif
                    @if ($usr->can('klien.view'))
                        <li class="menu-item">
                            <a href="{{ route('klien') }}" class="menu-link">
                                <div data-i18n="Klien">Klien</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif


    </ul>

</aside>
