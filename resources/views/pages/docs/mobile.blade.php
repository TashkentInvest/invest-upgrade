<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <!-- Include any necessary CSS files -->
    <style>
        /* Define your CSS styles here */
        body {
            font-family: Calibri, sans-serif;
        }

        .card-header h3 {
            margin: 0;
        }

        .card-body table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .card-body table th,
        .card-body table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .text-center {
            text-align: center;
        }

        .bg-secondary {
            background-color: #f0f0f0;
        }

        .text-light {
            color: #fff;
        }

        .formatted-number {
            /* Define any specific styles for formatted numbers */
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@lang('global.company_and_object_detail')</h3>
                </div>
                <div class="card-body">
                    <!-- Data table -->
                    <table id="datatable" class="table table-bordered dt-responsive">
                        <tbody>
                            <tr>
                                <td>@lang('global.fio')</td>
                                <td colspan="2">{{ $client->last_name }} {{ $client->first_name }}
                                    {{ $client->father_name ?? '' }}</td>
                            </tr>
                            @if ($client->mijoz_turi == 'fizik')
                                <tr>
                                    <td>@lang('global.passport_pinfl')</td>
                                    <td>{{ $client->passport->passport_pinfl ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('global.passport_serial')</td>
                                    <td>{{ $client->passport->passport_serial ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.client.fields.passport_date')</td>
                                    <td>{{ $client->passport->passport_date ? date('d-m-Y', strtotime($client->passport->passport_date)) : '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.client.fields.passport_location')</td>
                                    <td>{{ $client->passport->passport_location ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('global.home_address')</td>
                                    <td colspan="2">{{ $client->address->home_address ?? '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>@lang('cruds.client.fields.yuridik_address')</td>
                                    <td colspan="2">{{ $client->address->yuridik_address ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.company_name')</td>
                                    <td colspan="2">{{ $client->company->company_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.oked')</td>
                                    <td colspan="2">{{ $client->company->oked ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.raxbar')</td>
                                    <td colspan="2">{{ $client->company->raxbar ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.bank_code')</td>
                                    <td colspan="2">{{ $client->company->bank_code ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.bank_service')</td>
                                    <td colspan="2">{{ $client->company->bank_service ?? '' }}</td>
                                </tr>
                            @endif

                            <tr>
                                <td>@lang('cruds.company.fields.stir')</td>
                                <td colspan="2">{{ $client->company->stir ?? '' }}</td>
                            </tr>

                            @foreach ($client->branches as $b)
                                <tr>
                                    <td colspan="3" class="text-center bg-secondary text-light">
                                        <strong>@lang('global.contract_details') - {{ $b->contract_apt }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>@lang('global.ruxsatnoma_raqami')</td>
                                    <td colspan="2">{{ $b->contract_apt ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('global.created_at')</td>
                                    <td colspan="2">{{ $b->contract_date ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.branches.fields.application_number')</td>
                                    <td colspan="2">{{ $b->application_number ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('global.loyiha_nomi')</td>
                                    <td colspan="2">{{ $b->branch_type ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.branch_type')</td>
                                    <td colspan="2">{{ $b->branch_type ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('cruds.company.fields.branch_location')</td>
                                    <td colspan="2">{{ $b->branch_location ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('global.shaxarsozlik_umumiy_xajmi')</td>
                                    <td colspan="2">{{ $b->shaxarsozlik_umumiy_xajmi }}</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
