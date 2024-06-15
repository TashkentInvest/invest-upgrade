@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css" rel="stylesheet">

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
                                                    <a href="{{ route('construction.show', $item->id) }}" class="btn btn-success">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    @if(session('branchNotifications'))
        const notifications = @json(session('branchNotifications'));

        function showNextNotification(index) {
            if (index < notifications.length) {
                const notification = notifications[index];
                const {
                    branch_name,
                    generate_price,
                    contract_date,
                    payment_type,
                    percentage_input,
                    installment_quarterly,
                    branch_kubmetr,
                    branch_location
                } = notification;

                Swal.fire({
                    title: `Branch: ${notification.branch_name}`,
                    html: `
                        <div>
                            <p><strong>Branch Name:</strong> ${branch_name}</p>
                            <p><strong>Generate Price:</strong> ${generate_price}</p>
                            <p><strong>Contract Date:</strong> ${contract_date}</p>
                            <p><strong>Payment Type:</strong> ${payment_type}</p>
                            <p><strong>Percentage Input:</strong> ${percentage_input}</p>
                            <p><strong>Installment Quarterly:</strong> ${installment_quarterly}</p>
                            <p><strong>Branch Kubmetr:</strong> ${branch_kubmetr}</p>
                            <p><strong>Branch Location:</strong> ${branch_location}</p>
                        </div>
                    `,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("updateStatus") }}', // Ensure this route is defined correctly
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                branch_id: notification.id,
                                status: 1
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Confirmed!', 'The branch status has been updated.', 'success')
                                    .then(() => {
                                        showNextNotification(index + 1);
                                    });
                                } else {
                                    Swal.fire('Error!', 'An error occurred while updating the status.', 'error')
                                    .then(() => {
                                        showNextNotification(index + 1);
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'An error occurred while updating the status.', 'error')
                                .then(() => {
                                    showNextNotification(index + 1);
                                });
                            }
                        });
                    } else {
                        showNextNotification(index + 1);
                    }
                });
            }
        }

        showNextNotification(0);
    @endif
</script>
@endsection
