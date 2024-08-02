@extends('backend.layouts.app')

@section('title', __('Estadísticas'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Estadísticas')
        </x-slot>

        <x-slot name="body">
            <div class="row py-5 justify-content-center">
                <div class="col-md-3">
                    <div class="card p-2">
                        <h5 class="card-title">Usuarios totales:</h5>
                        <div class="card-body content-center">
                            <span class="display-1">{{ $data['totalUsers'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-2">
                        <h5 class="card-title">Usuarios sin nungún reto completados:</h5>
                        <div class="card-body content-center">
                            <span class="display-1">{{ $data['noActivitiesCount'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-2">
                        <h5 class="card-title">Usuarios con algún reto completado:</h5>
                        <div class="card-body content-center">
                            <span class="display-1">{{ $data['anyActivitiesCount'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-2">
                        <h5 class="card-title">Usuarios con todos los retos completados:</h5>
                        <div class="card-body content-center">
                            <span class="display-1">{{ $data['completedActivitiesCount'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-5 justify-content-center">
                <div class="col-md-3">
                    <div class="card p-2">
                        <h5 class="card-title">Usuarios participantes en el muro:</h5>
                        <div class="card-body content-center">
                            <span class="display-1">{{ $data['usersPostedInWallCount'] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-2">
                        <h5 class="card-title">Participaciones en el muro:</h5>
                        <div class="card-body content-center">
                            <span class="display-1">{{ $data['wallPostsCount'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-5 justify-content-start">
                <div class="col-md-6">
                    <div class="card p-2">
                        <h5 class="card-title">Ranking de desafíos:</h5>
                        <div class="card-body content-center">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre del reto</th>
                                    <th scope="col">Usuarios participantes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['activitiesRanking'] as $key => $row)
                                    <tr>
                                        <th scope="row">{{$key + 1}}</th>
                                        <td class="text-left">{{$row->title}}</td>
                                        <td>{{$row->users}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-2">
                        <h5 class="card-title">Ranking de usuarios:</h5>
                        <div class="card-body content-center">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Retos totales</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['userRanking'] as $key => $row)
                                    <tr>
                                        <th scope="row">{{$key + 1}}</th>
                                        <td class="text-left">{{$row->name}}</td>
                                        <td>{{$row->challenges}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </x-slot>
    </x-backend.card>
@endsection
