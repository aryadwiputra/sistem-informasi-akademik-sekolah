<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    {{ $pretitle }}
                </div>
                <h2 class="page-title">
                    {{ $title }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @foreach ($actions as $action)
                        <span class="d-none d-sm-inline">
                            <a href="{{ $action['url'] }}"
                                class="btn {{ $action['class'] ? $action['class'] : 'btn-green' }}">{{ $action['label'] }}</a>
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
