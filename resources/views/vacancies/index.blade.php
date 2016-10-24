<?php
/** @var \App\Vacancy[] $vacancys */

$title = 'Вакансии';
?>

@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="container vacancies">
    <div class="row">
        <div class="">
            <div class="panel panel-default vacancy-list">
                <div class="panel-heading"> {{$title}}
                    <a href="{{ route('vacancy.parse') }}" class="btn btn-default add-button">Запустить парсер</a>
                    <form class="city-form" method="GET" action="{{ route('vacancy.index') }}" >
                            <div class="form-group form-inline" >
                                <input name="city" type="text" value="{{ $city  }}" placeholder="Город"
                                       class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary ">Найти</button>
                    </form>
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table" >

                        <!-- Table Headings -->
                        <thead>
                        <th>Название[id/id на hh]</th>
                        <th>Работодатель</th>
                        <th>Заработная плата</th>
                        <th>Обязанности</th>
                        <th>Требования</th>
                        <th>Город </th>
                        <th>Дата </th>
                        <th>Время создания/обновления у нас</th>
                        <th>На HH</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($vacancies as $vacancy)
                            <tr>
                                <td>
                                    {{ $vacancy->title }} [{{ $vacancy->id }} / {{ $vacancy->external_id }}]
                                </td>
                                <td>
                                    {{ $vacancy->employer_name }} [{{ $vacancy->employer_id }}]
                                </td>
                                <td>
                                    {{ $vacancy->salary }}
                                </td>
                                <td>
                                    {{ $vacancy->responsibility }}
                                </td>
                                <td>
                                    {{ $vacancy->requirement }}
                                </td>
                                <td>
                                    {{ $vacancy->city }}
                                </td>
                                <td>
                                    {{ $vacancy->date }}
                                </td>
                                <td>
                                    {{ $vacancy->created_at }}
                                    <br>
                                    {{ $vacancy->updated_at }}

                                </td>
                                <td>
                                    <a href="https://hh.ru/vacancy/{{ $vacancy->external_id }}" target="_blank">на HH</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $vacancies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
