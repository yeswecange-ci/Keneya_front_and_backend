@extends('layouts.backend.app')
@section('content')
    <section class="section">
        <div class="row ">
            <!-- Total visiteurs -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Visiteurs totaux</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['total_visitors'] }}</h2>
                                        {{-- <p class="mb-0"><span class="col-green">+100%</span> Depuis le début</p> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/1.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visiteurs ayant accepté les cookies -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Cookies acceptés</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['visitors_with_cookies'] }}</h2>
                                        <p class="mb-0"><span class="col-green">
                                            {{ $stats['total_visitors'] > 0 ? round(($stats['visitors_with_cookies'] / $stats['total_visitors']) * 100, 2) : 0 }}%
                                        </span> des visiteurs</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/2.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visiteurs aujourd'hui -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Visiteurs aujourd'hui</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['visitors_today'] }}</h2>
                                        <p class="mb-0"><span class="col-green">+{{ $stats['visitors_today'] }}</span> Nouveaux</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/3.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visiteurs ce mois -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Visiteurs ce mois</h5>
                                        <h2 class="mb-3 font-18">{{ $stats['visitors_this_month'] }}</h2>
                                        {{-- <p class="mb-0"><span class="col-orange">↗</span> Cumul mensuel</p> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/4.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des derniers visiteurs -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Derniers visiteurs</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Session</th>
                                    <th>IP</th>
                                    <th>Pays</th>
                                    <th>Ville</th>
                                    <th>Dernière activité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentVisitors as $visitor)
                                    <tr>
                                        <td>{{ $visitor->session_id }}</td>
                                        <td>{{ $visitor->ip_address }}</td>
                                        <td>{{ $visitor->country }}</td>
                                        <td>{{ $visitor->city }}</td>
                                        <td>{{ $visitor->last_activity_at?->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats par pays -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Top pays</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($topCountries as $country)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $country->country }}
                                    <span class="badge badge-primary badge-pill">{{ $country->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Stats par appareil -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Appareils utilisés</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($deviceStats as $device)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ ucfirst($device->device_type) }}
                                    <span class="badge badge-info badge-pill">{{ $device->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('partials.backend.app-setting')
@endsection
