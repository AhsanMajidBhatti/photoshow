@extends('layouts.app')

@section('content')
    <h3>{{$photo->title}}</h3>
    <p>{{$photo->description}}</p>
    <a class="button primary" href="/albums/{{$photo->album_id}}">Back To Gallary</a>
    <hr>
    <img src="/storage/photo/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
    <br><br>
    {!! Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{  Form::hidden('_method', 'DELETE')  }}
        {{  Form::submit('Delete Photo', ['class' => 'button alert'])  }}
    {!! Form::close() !!}
@endsection