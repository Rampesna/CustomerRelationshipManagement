<div class="subheader subheader-solid" id="kt_subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <h5>{{ $customer->title }}</h5>
            </div>
        </div>
    </div>
</div>
<div class="subheader subheader-solid mt-15" id="kt_subheader">
    <div class="container-fluid align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <ul class="nav nav-tabs nav-tabs-line mb-n4">

            <li class="nav-item">
                <a class="nav-link @if($tab == 'index') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'index']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Genel Bakış</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'manager') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'manager']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Yetkililer</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'offer') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'offer']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Teklifler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'activity') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'activity']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Aktiviteler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if($tab == 'sample') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'sample']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Numuneler</span>
                </a>
            </li>

            @Authority(28)
            <li class="nav-item">
                <a class="nav-link @if($tab == 'finance-activity') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'finance-activity']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Finansal Hareketler</span>
                </a>
            </li>
            @endAuthority

            @Authority(29)
            <li class="nav-item">
                <a class="nav-link @if($tab == 'purchase') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'purchase']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Satın Alımlar</span>
                </a>
            </li>
            @endAuthority

            @Authority(30)
            <li class="nav-item">
                <a class="nav-link @if($tab == 'erp-order') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'erp-order']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Ticari Program Siparişler</span>
                </a>
            </li>
            @endAuthority

            @Authority(31)
            <li class="nav-item">
                <a class="nav-link @if($tab == 'file') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'file']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Dosyalar</span>
                </a>
            </li>
            @endAuthority

            @Authority(32)
            <li class="nav-item">
                <a class="nav-link @if($tab == 'social') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'social']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Sosyal Medya Hesapları</span>
                </a>
            </li>
            @endAuthority

            @Authority(33)
            <li class="nav-item">
                <a class="nav-link @if($tab == 'comment') active @endif" href="{{ route('customer.show', ['id' => $customer->id, 'tab' => 'comment']) }}">
                    <span class="nav-icon"><i class="fas fa-th"></i></span>
                    <span class="nav-text">Yorumlar</span>
                </a>
            </li>
            @endAuthority
        </ul>
    </div>
</div>
