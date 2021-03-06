@extends('layouts.app')

@section('content')
    <h1>{{$album->name}}</h1>

    <a href="/" class="button secondary">Go Back</a>
    <a href="/photos/create/{{$album->id}}" class="button">Upload Photo To Album</a>
    {!! Form::open(['action' => ['AlbumsController@destroy', $album->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{  Form::hidden('_method', 'DELETE')  }}
        {{  Form::submit('Delete Album', ['class' => 'button alert'])  }}
    {!! Form::close() !!}
    <hr>

    @if(count($album->photo) > 0)
    <?php
      $colcount = count($album->photo);
  	  $i = 1;
    ?>
    <div id="photos">
      <div class="row text-center">
        @foreach($album->photo as $photo)
          @if($i == $colcount)
             <div class='medium-4 columns end'>
               <a href="/photos/{{$photo->id}}">
                  <img class="thumbnail" src="/storage/photo/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
                </a>
               <br>
               <h4>{{$photo->title}}</h4>
          @else
            <div class='medium-4 columns'>
              <a href="/photos/{{$photo->id}}">
                <img class="thumbnail" src="/storage/photo/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
              </a>
              <br>
              <h4>{{$photo->title}}</h4>
          @endif
        	@if($i % 3 == 0)
          </div></div><div class="row text-center">
        	@else
            </div>
          @endif
        	<?php $i++; ?>
        @endforeach
      </div>
    </div>
  @else
    <p>No Photos To Display</p>
  @endif
@endsection