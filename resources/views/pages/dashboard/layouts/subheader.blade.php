<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'index' ? 'active' : '' }}" href="{{ route('dashboard.index', ['tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Kontrol Paneli</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'target' ? 'active' : '' }}" href="{{ route('dashboard.index', ['tab' => 'target']) }}">
                    <span class="nav-icon"><i class="far fa-dot-circle"></i></span>
                    <span class="nav-text">Hedef Durumu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->segment(2) === 'report' ? 'active' : '' }}" href="{{ route('dashboard.index', ['tab' => 'report']) }}">
                    <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                    <span class="nav-text">Rapor</span>
                </a>
            </li>

        </ul>
    </div>
</div>
