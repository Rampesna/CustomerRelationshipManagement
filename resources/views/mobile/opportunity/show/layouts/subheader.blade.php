<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if($tab == 'index') active @endif" href="{{ route('mobile.opportunity.show', ['id' => $opportunity->id, 'tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Genel Bakış</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'offer') active @endif" href="{{ route('mobile.opportunity.show', ['id' => $opportunity->id, 'tab' => 'offer']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Teklifler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'activity') active @endif" href="{{ route('mobile.opportunity.show', ['id' => $opportunity->id, 'tab' => 'activity']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Aktiviteler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'sample') active @endif" href="{{ route('mobile.opportunity.show', ['id' => $opportunity->id, 'tab' => 'sample']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Numuneler</span>
                </a>
            </li>

            @Authority(17)
            <li class="nav-item">
                <a class="nav-link @if($tab == 'comment') active @endif" href="{{ route('mobile.opportunity.show', ['id' => $opportunity->id, 'tab' => 'comment']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Yorumlar</span>
                </a>
            </li>
            @endAuthority

        </ul>
    </div>
</div>
