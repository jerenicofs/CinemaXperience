@extends('layouts.master')

@section('title', 'Subscription Page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/subscriptionPage.css') }}">
@endsection

@section('content')
<!-- Isi semua di sini -->
<div class="title-container">
    <h2 class="title"> The right plans for your needs. </h2>
    <h5 class="sub-title"> Choose monthly package that suits you. </h5>
</div>

<div class="package-container">
    <div class="plan-card">
        <h3> Silver </h3>
        <div class="price">
            <a id="rp"> Rp </a>
            <a id="num"> 50 </a>
            <a id="mo"> /mo </a>
        </div>
        <a href="{{ route('card') }}" class="choose-plan-button hover:bg-yellow-500"> Choose plan </a>
        <ul>
            <li>Akses ke semua konten standar</li>
            <li>Hanya tersedia untuk 1 perangkat</li>
            <li>Tanpa iklan</li>
            <li>Streaming dalam resolusi HD</li>
        </ul>
    </div>

    <div class="plan-card">
        <h3> Gold </h3>
        <div class="price">
            <a id="rp"> Rp </a>
            <a id="num"> 100 </a>
            <a id="mo"> /mo </a>
        </div>
        <a href="{{ route('card') }}" class="choose-plan-button hover:bg-yellow-500"> Choose plan </a>
        <ul>
            <li>Akses ke semua konten standar</li>
            <li>Akses ke semua konten eksklusif</li>
            <li>Tersedia untuk 2 perangkat</li>
            <li>Tanpa iklan</li>
            <li>Streaming dalam resolusi HD</li>
        </ul>
    </div>

    <div class="plan-card">
        <h3> Platinum </h3>
        <div class="price">
            <a id="rp"> Rp </a>
            <a id="num"> 150 </a>
            <a id="mo"> /mo </a>
        </div>
        <a href="{{ route('card') }}" class="choose-plan-button hover:bg-yellow-500"> Choose plan </a>
        <ul>
            <li>Akses ke semua konten standar</li>
            <li>Akses ke semua konten eksklusif</li>
            <li>Tersedia untuk 4 perangkat</li>
            <li>Tanpa iklan</li>
            <li>Streaming dalam resolusi Ultra HD (4K)</li>
        </ul>
    </div>

</div>

@endsection
