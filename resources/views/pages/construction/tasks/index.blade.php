@extends('layouts.admin')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.css">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Customers</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box me-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive w-100">
                            <thead>
                                <tr>
                                    <th>@lang('global.id')</th>
                                    <th>@lang('global.client_name') / @lang('cruds.company.fields.company_name')</th>
                                    <th>@lang('cruds.client.fields.contact')</th>
                                    <th>@lang('cruds.company.fields.address')</th>
                                    <th>@lang('cruds.company.fields.stir')</th>
                                    <th style="width: 150px;">@lang('global.created_at')</th>
                                    <th style="width: 100px;">@lang('global.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($constructions as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>

                                        @if ($item->mijoz_turi == 'fizik')
                                            <td>{{ $item->last_name }} {{ $item->first_name }} {{ $item->father_name }}</td>
                                        @else
                                            <td>{{ $item->company->company_name }}</td>
                                        @endif

                                        <td>{{ $item->contact ?? '---' }}</td>

                                        @if ($item->mijoz_turi == 'fizik')
                                            <td>{{ $item->address->home_address }}</td>
                                        @else
                                            <td>{{ $item->address->yuridik_address }}</td>
                                        @endif

                                        <td>{{ $item->company->stir }}</td>

                                        <td>{{ $item->updated_at }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('clientDestroy', $item->id) }}" method="post">
                                                @csrf
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="@lang('global.view')">
                                                        <a href="{{ route('construction.show', $item->id) }}"
                                                            class="btn btn-success">
                                                            <i class="bx bxs-edit" style="font-size:16px;"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $constructions->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Modals for Notifications -->
    @php
        $modalIndex = 0;
    @endphp

    @foreach ($constructions as $notification)
        @foreach ($notification->branches as $b)
            @if($b->view ? $b->view->status != 1 : true)
                @php
                    $modalIndex++;
                @endphp
                <div class="modal fade" id="notificationModal{{ $modalIndex }}" tabindex="-1"
                    aria-labelledby="notificationModalLabel{{ $modalIndex }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="notificationModalLabel{{ $modalIndex }}">Branch Notification
                                </h5>
                                {{-- Remove the close button --}}
                            </div>
                            <div class="modal-body">
                                <div>
                                    <p><strong>Branch Name:</strong> {{ $b->branch_name ?? '' }}</p>
                                    <p><strong>Generate Price:</strong> {{ $b->generate_price ?? '' }}</p>
                                    <p><strong>Contract Date:</strong> {{ $b->contract_date ?? '' }}</p>
                                    <p><strong>Payment Type:</strong> {{ $b->payment_type ?? '' }}</p>
                                    <p><strong>Percentage Input:</strong> {{ $b->percentage_input ?? '' }}</p>
                                    <p><strong>Installment Quarterly:</strong> {{ $b->installment_quarterly ?? '' }}</p>
                                    <p><strong>Branch Kubmetr:</strong> {{ $b->branch_kubmetr ?? '' }}</p>
                                    <p><strong>Branch Location:</strong> {{ $b->branch_location ?? '' }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('updateStatus') }}" method="post" class="update-status-form">
                                    @csrf
                                    <input type="hidden" name="branch_id" value="{{ $b->id }}">
                                    <input type="hidden" name="status" value="1">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js"></script>
    <script>
        $(document).ready(function() {
            let modalIndex = 1;
            const totalModals = {{ $modalIndex }};
            
            function showNextModal() {
                if (modalIndex <= totalModals) {
                    $(`#notificationModal${modalIndex}`).modal('show');
                }
            }

            $('.update-status-form').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let modal = form.closest('.modal');

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        if(response.success) {
                            modal.modal('hide');
                            modalIndex++;
                            showNextModal();
                        }
                    },
                    error: function(response) {
                        // Handle error
                    }
                });
            });

            // Start the sequence
            showNextModal();
        });
    </script>
@endsection
