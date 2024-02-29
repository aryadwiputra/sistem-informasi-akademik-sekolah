@extends('layouts.admin')

@section('title', 'Dashboard')

@php
    $headerData = [
        'pretitle' => 'Dashboard',
        'title' => 'Dashboard Administrator',
        'actions' => [
            ['label' => 'New view', 'url' => '#', 'class' => 'btn-green'],
            ['label' => 'Create new report', 'url' => '#', 'class' => 'btn-primary'],
        ],
    ];
@endphp

@section('content')
    @include('components.header', $headerData)

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    Ini halaman dashboard
                </div>
            </div>
        </div>
    </div>
@endsection
