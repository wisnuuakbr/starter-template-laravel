<?php
$url = request()->getPathInfo();
$items = explode('/', $url);
unset($items[0]);

// dd($url);

?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    {{-- <h4 class="page-title mb-0">Main</h4> --}}
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('users') }}">Settings</a></li> --}}
                        @foreach ($items as $key => $item)
                            @if ($key == count($items))
                                <li class="breadcrumb-item active" aria-current="page">{{ Str::ucfirst($item) }}</li>
                            @else
                                <li class="breadcrumb-item"><a href="/{{ $item }}">{{ Str::ucfirst($item) }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

