<p style="margin:0pt 0.05pt 6.2pt 0.5pt; text-indent:-0.5pt; text-align:center; line-height:104%; font-size:14pt;">
    <strong>XALQ DEPUTATLARI TOSHKENT SHAHRI KENGASHINING</strong>
</p>
<p
    style="margin-top:0pt; margin-left:0.5pt; margin-bottom:0pt; text-indent:-0.5pt; text-align:center; line-height:104%; font-size:14pt;">
    <strong>Q A R O R I</strong>
</p>
<p style="margin-top:0pt; margin-left:5.4pt; margin-bottom:16.7pt; text-align:left; line-height:108%;"></p>
<p style="margin-top:0pt; margin-bottom:12.8pt; text-align:left; line-height:108%; font-size:11pt;"><span
        style="width:81.85pt; font-family:Calibri; display:inline-block;">&nbsp;</span></p>



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('global.company_and_object_detail')</h3>

            </div>
            <div class="card-body">
                <!-- Data table -->
                <table id="datatable" class="table table-bordered dt-responsive w-100">
                    <tbody>
                        <tr>
                            <td>@lang('global.fio')</td>
                            <td colspan="2">{{ $client->last_name }} {{ $client->first_name }}
                                {{ $client->father_name ?? '' }}</td>
                        </tr>
                        @if ($client->mijoz_turi == 'fizik')
                            <tr>
                                <td>{{ __('global.passport_pinfl') ?? '' }}</td>
                                <td>{{ $client->passport->passport_pinfl ?? '' }}</td>
                            </tr>

                            <tr>
                                <td>{{ __('global.passport_serial') ?? '' }}</td>
                                <td>{{ $client->passport->passport_serial ?? '' }}</td>
                            </tr>

                            <tr>
                                @if ($client->passport_date)
                                    <td>@lang('cruds.client.fields.passport_date')</td>
                                    <td>{{ date('d-m-Y', strtotime($client->passport->passport_date)) ?? '' }}</td>
                                @else
                                    <td>@lang('cruds.client.fields.passport_date')</td>
                                    <td></td>
                                @endif
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
                                    <strong>@lang('global.contract_details') -
                                        {{ $b->contract_apt }}</strong>
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
                            <tr>
                                <td>@lang('global.qavatlar_soni_xajmi')</td>
                                <td colspan="2">{{ $b->qavatlar_soni_xajmi }}</td>
                            </tr>
                            <tr>
                                <td>@lang('global.avtoturargoh_xajmi')</td>
                                <td colspan="2">{{ $b->avtoturargoh_xajmi }}</td>
                            </tr>
                            <tr>
                                <td>@lang('global.qavat_xona_xajmi')</td>
                                <td colspan="2">{{ $b->qavat_xona_xajmi }}</td>
                            </tr>
                            <tr>
                                <td>@lang('global.umumiy_foydalanishdagi_xajmi')</td>
                                <td colspan="2">{{ $b->umumiy_foydalanishdagi_xajmi }}</td>
                            </tr>
                            <tr>
                                <td>@lang('global.qurilish_turi')</td>
                                <td colspan="2">{{ $b->qurilish_turi }}</td>
                            </tr>
                            <tr>
                                <td>@lang('global.coefficient')</td>
                                <td colspan="2">{{ $b->coefficient }}</td>
                            </tr>
                            <tr>
                                <td>@lang('global.zona')</td>
                                <td colspan="2">{{ $b->zona }}</td>
                            </tr>

                            <tr>
                                <td>@lang('global.obyekt_boyicha_tolanishi_lozim') ( m³ )</td>
                                <td colspan="2">{{ number_format($b->branch_kubmetr, 1) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>@lang('global.jami_tolanishi_kerak')</td>
                                <td colspan="2" class="formatted-number">{{ $b->generate_price ?? '' }}</td>
                            </tr>



                            <tr>
                                <td>@lang('global.bolib_tolash_foizi_oldindan')</td>
                                <td colspan="2">{{ $b->percentage_input }}%</td>
                            </tr>
                            <tr>
                                <td>@lang('global.quarterly_payment')</td>
                                <td colspan="2">{{ $b->installment_quarterly ?? '' }}</td>
                            </tr>

                            <tr>
                                <td>@lang('global.bolib_tolash')</td>
                                <td colspan="2">
                                    @if ($b->payment_type == 'pay_bolib')
                                        @lang('global.pay_bolib')
                                    @else
                                        @lang('global.pay_full')
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>@lang('cruds.branches.fields.payed_sum')</td>
                                <td colspan="2" class="formatted-number">{{ $b->payed_sum ?? '' }}</td>
                            </tr>

                            <tr>
                                <td>@lang('cruds.branches.fields.payed_date')</td>
                                <td colspan="2">{{ $b->payed_date ?? '' }}</td>
                            </tr>

                            <tr>
                                <td>@lang('cruds.branches.fields.notification_num')</td>
                                <td colspan="2">{{ $b->notification_num ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>@lang('cruds.branches.fields.notification_date')</td>
                                <td colspan="2">{{ $b->notification_date ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>@lang('cruds.branches.fields.insurance_policy')</td>
                                <td colspan="2">{{ $b->insurance_policy ?? '' }}</td>
                            </tr>

                            <tr>
                                <td>@lang('cruds.branches.fields.bank_guarantee')</td>
                                <td colspan="2">{{ $b->bank_guarantee ?? '' }}</td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
