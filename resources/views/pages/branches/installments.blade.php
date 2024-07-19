@extends('layouts.app')

@section('content')
<div class="container px-4 my-5">
    <h1 class="mb-4 text-info">To'lov Choraklari</h1>
    <h2 class="mb-4">{{ $branch->branch_name }}</h2>
    <a href="{{ route('payments.create', ['branch_id' => $branch->id]) }}" class="btn btn-success mb-4">Yangi To'lov Qo'shish</a>

    @if($installments)
        @php
            $totalSum = 0;
            foreach ($installments as $quarters) {
                foreach ($quarters as $data) {
                    $totalSum += $data['total'];
                }
            }
        @endphp

        <div class="alert alert-primary mb-4">
            <h3 class="mb-0">Jami To'langan Miqdor: {{ number_format($totalSum, 2) }} UZS</h3>
        </div>

        @foreach($installments as $year => $quarters)
            <h3 class="mb-3 text-success">Yil: {{ $year }}</h3>
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Chorak</th>
                            <th>To'lov Miqdori</th>
                            <th>Izoh</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quarters as $quarter => $data)
                            <tr>
                                <td>{{ $quarter }}</td>
                                <td>{{ number_format($data['total'], 2) }} UZS</td>
                                <td>
                                    @if(!empty($data['comments']))
                                        <ul class="list-unstyled mb-0">
                                            @foreach($data['comments'] as $comment)
                                                <li><i class="bi bi-chat-text"></i> {{ $comment }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted mb-0">No comments</p>
                                    @endif
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal_{{$year}}_{{ $quarter[0] }}">
                                        View Details
                                    </button>

                                    <!-- Link to the payment details -->
                                 
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="detailsModal_{{$year}}_{{ $quarter[0] }}" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailsModalLabel">To'lov Detallari (Yil: {{ $year }}, Chorak: {{ $quarter }})</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>To'lov Miqdori: {{ number_format($data['total'], 2) }} UZS</h4>
                                            <p><strong>Izohlar:</strong></p>
                                            @if(!empty($data['comments']))
                                                <ul>
                                                    @foreach($data['comments'] as $comment)
                                                        <li>{{ $comment }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>No comments</p>
                                            @endif
                                            <p><strong>Additional Details:</strong></p>
                                            {{-- {{$branch->payments}} --}}
                                               
                                        
                                            <!-- Add any additional details here -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

    @else
        <div class="alert alert-warning">
            <p class="mb-0">Not found</p>
        </div>
    @endif

    <h3 class="text-center text-info mb-4">Umumiy Obyekt xaqida malumotlar</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>To'lov Foizi</th>
                    <th>To'lov Choraki</th>
                    <th>To'lov Summasi</th>
                    <th>Birinchi to'lov</th>
                    <th>Chorak bo'yicha to'landigan summa</th>
                    <th>To'lagan sana</th>
                    <th>To'lovni tugatishi kerak bo'lgan sana</th>
                    <th>Barcha Ma'lumotlar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $branch->percentage_input }}%</td>
                    <td>{{ $branch->installment_quarterly }}</td>
                    <td>{{ number_format($branch->generate_price, 2) }} UZS</td>
                    <td>{{ number_format($branch->first_payment_percent, 2) }} UZS</td>
                    <td>{{ number_format($branch->generate_price - $branch->first_payment_percent, 2) }} UZS</td>
                    <td>{{ $branch->payed_date ? $branch->payed_date->format('d-m-Y') : 'N/A' }}</td>
                    <td>{{ $branch->payment_deadline ? $branch->payment_deadline->format('d-m-Y') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('payment.show', $branch->id) }}" class="btn btn-info btn-sm">
                            Show
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
