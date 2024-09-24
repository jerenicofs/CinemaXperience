@extends('layouts.master')

@section('title', 'Subscription Page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/PaymentPageCard.css') }}">
@endsection

</body>

</html>

@section('content')
<!-- Isi semua di sini -->

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
    <div class="payment-detail">
        <span class="payment-detail-title">Payment Detail:</span>
        <img src="/assets/v4_79.png" alt="Card Card">
        <form action="{{ route('payment') }}" method="POST" class="payment-form">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="text" name="name" placeholder="Name on Card" required class="input-field">
            <input type="tel" name="cardnumber" placeholder="1234 1234 1234 1234" pattern="[0-9\s]{13,19}"
                maxlength="19" required class="input-field">
            <input type="text" name="expdate" placeholder="MM / YY" required class="input-field">
            <input type="number" name="cvv" placeholder="CVV" required class="input-field">
            <button type="submit" class="pay-now-btn">PAY NOW</button>
        </form>
    </div>
</div>

<script>
    function redirectToRoute(route) {
        window.location.href = route;
    }
</script>

@endsection
