@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@lang('cruds.history.title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #007bff;">@lang('global.home')</a></li>
                    <li class="breadcrumb-item active">@lang('cruds.history.title')</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('Client Information')</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <strong>@lang('ID'):</strong> {{ $client->id }}<br>
                    <strong>@lang('Name'):</strong> {{ $client->first_name }} {{ $client->last_name }}
                </div>

                @foreach ($historyTypes as $type => $histories)
                    @if (!$histories->isEmpty())
                        <div class="mb-4">
                            <h4>@lang(ucfirst($type) . ' Histories')</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('Changed By')</th>
                                            <th>@lang(ucfirst($type))</th>
                                            <th>@lang('Old Value')</th>
                                            <th>@lang('Timestamp')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($histories as $history)
                                            <tr>
                                                <td>
                                                    {{-- Display user name if available, otherwise show 'Unknown User' --}}
                                                    {{ $history->user_id ? App\Models\User::find($history->user_id)->name ?? 'Unknown User' : 'Unknown User' }}
                                                </td>
                                                <td>{{ $history->{$type . '_name'} }}</td>
                                                <td>
                                                    <ul>
                                                        {{-- Display all attributes from $history --}}
                                                        @foreach ($history->getAttributes() as $key => $value)
                                                            <li>{{ $key }}: {{ $value }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                              
                                                <td>{{ $history->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- Pagination links --}}
                                {{ $histories->links() }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .highlight-diff {
        background-color: #ffdddd;
    }
</style>

@endsection
