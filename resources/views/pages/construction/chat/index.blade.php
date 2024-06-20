@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Chat</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('construction.index') }}"
                            style="color: #007bff;">@lang('global.home')</a>
                    </li>
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="d-lg-flex">
    <div class="w-100 user-chat">
        <div class="card">
            <div class="p-4 border-bottom">
                <div class="row">
                    <div class="col-md-4 col-9">
                        <h5 class="font-size-15 mb-1">Tashkent Invest Group</h5>
                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i>@lang('global.active')</p>
                    </div>
                </div>
            </div>

            <div>
                <div id="chat-conversation" class="chat-conversation p-3" style="height: 500px; overflow-y: auto;">
                    <ul class="list-unstyled mb-0" data-simplebar>
                        @php
                            $lastDate = null;
                        @endphp
                        @foreach ($messages as $message)
                            @php
                                $messageDate = $message->created_at->format('Y-m-d');
                            @endphp
                            @if ($lastDate !== $messageDate)
                                <li class="chat-day-title">
                                    <span class="title">{{ $message->created_at->format('F j, Y') }}</span>
                                </li>
                                @php
                                    $lastDate = $messageDate;
                                @endphp
                            @endif
                            <li class="{{ $message->user->id === auth()->id() ? 'right' : '' }}">
                                <div class="conversation-list">
                                    <div class="ctext-wrap">
                                        <div class="conversation-name">{{ $message->user->name }}</div>
                                        <p>{{ $message->message }}</p>
                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> {{ $message->created_at->format('H:i') }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="p-3 chat-input-section">
                    <form action="{{ route('chat.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="position-relative">
                                    <input type="text" name="message" class="form-control chat-input" placeholder="Enter Message...">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light">
                                    <span class="d-none d-sm-inline-block me-2">Send</span>
                                    <i class="mdi mdi-send"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var chatConversation = document.getElementById('chat-conversation');
        chatConversation.scrollTop = chatConversation.scrollHeight;
    });
</script>
@endsection
