@extends('user.layout.index')
@section('css')
@endsection
@section('content')
    <div class="head-nav-box px-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-headset"
            viewBox="0 0 16 16">
            <path
                d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5" />
        </svg>&nbsp;
        <span>Khiếu nại</span>
    </div>
    <div class="main-content-container px-3 py-2">
        <div class="brokers-container">
            @foreach ($complaints as $complaint)
                <div class="brokers-item p-2 mb-2">
                    <a href="">
                        <div class="row justify-content-between p-2">
                            <div class="brokers-item-avatar-box">
                                @if ($complaint->headImg)
                                    <img src="{{ App\Helpers\ConstCommon::getLinkIMG($complaint->headImg) }}" alt="">
                                @endif
                            </div>
                            <div class="brokers-item-content-box">
                                <div class="font-weight-bold">{{ $complaint->readname ?? "Ẩn danh" }}</div>
                                <div class="font-weight-bold">{{ $complaint->nickname ?? " " }}</div>
                                <div class="brokers-item-time text-grey">
                                    <span>{{ $complaint->created_at->format('H:i:s') }}</span>&nbsp;
                                    <span>{{ $complaint->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="brokers-item-content">
                                    <div class="d-flex justify-content-between font-weight-bold py-3">
                                        <span>#{{ $complaint->complaintName ?? " " }}</span>
                                        <span class="mb-2">
                                            <span class="text-grey">Số tiền liên quan</span>
                                            <span>{{ $complaint->money ?? " " }}$</span>
                                        </span>
                                    </div>
                                    <p>
                                        {!! $complaint->content ?? " " !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if ($complaint->status == 1)
                        <div class="triangle-box">
                            <div class="triangle-box-text">Đợi đã</div>
                            <div class="triangle-box-bg triangle-box-bg-1"></div>
                        </div>
                        @else
                        <div class="triangle-box">
                            <div class="triangle-box-text">Xong</div>
                            <div class="triangle-box-bg triangle-box-bg-4"></div>
                        </div>
                        @endif
                        {{-- <div class="triangle-box">
                            <div class="triangle-box-text">đợi đã</div>
                            <div class="triangle-box-bg"></div>
                        </div> --}}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
@endsection
