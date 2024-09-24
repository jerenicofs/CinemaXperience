@extends('layouts.master')

@section('title', 'Subscription Page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/PaymentPageQris.css') }}">

@endsection

</body>

</html>

@section('content')

<div class="container payment-container">
    <h1 class="payment-heading">Payment Method</h1>
    <div class="payment-method">
        <label>

                <input type="radio" name="payment-method" value="card" onclick="redirectToRoute('{{ route('card') }}');">
                <span></span>
                <img src="/assets/v4_55.png" alt="card" style="width:70px;height:63px;">

        </label>
        <label>

                <input type="radio" name="payment-method" value="qris" onclick="redirectToRoute('{{ route('qris') }}');">
                <span></span>
                <img src="/assets/v4_54.png" alt="Qris" style="width:70px;height:63px;">

        </label>
    </div>
    <div class="Scan-Code">
        <h1 class="Scan-Code-Title">Scan Here</h1>
            <img src="/assets/V5-Qris.png" alt="Barcode" style="width:200px;height:200px;">
            <p>Scan QRIS to do the payment</p>
            <form action="{{ route('payment') }}" method="POST" class="payment-form">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <button type="submit" class="pay-now-btn">PAY NOW</button>
            </form>
        </form>
    </div>
</div>


<script>
    function redirectToRoute(route) {
        window.location.href = route;
    }
</script>
@endsection
