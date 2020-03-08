@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Methods</div>

                <div class="card-body">
                    <stripe-payment-methods stripe-key="{{ config('cashier.key') }}" client-secret="{{ $intent->client_secret }}"></stripe-payment-methods>
                    @foreach($payment_methods as $payment_method) 
                    <div class="row">
                        <div class="col-3">{{ $payment_method->card->last4 }}</div>
                        <div class="col-3">{{ $payment_method->card->brand }}</div>
                        <div class="col-3">{{ $payment_method->card->exp_month }}/{{ $payment_method->card->exp_year }}</div>
                        <div class="col-3">
                        <form action="{{ route('payment-methods.destroy', $payment_method->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>
@endsection