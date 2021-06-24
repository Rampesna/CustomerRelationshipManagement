<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if($tab == 'index') active @endif" href="{{ route('activity.show', ['id' => $activity->id, 'tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Genel Bakış</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'comment') active @endif" href="{{ route('activity.show', ['id' => $activity->id, 'tab' => 'comment']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Yorumlar</span>
                </a>
            </li>

        </ul>
    </div>
</div>
