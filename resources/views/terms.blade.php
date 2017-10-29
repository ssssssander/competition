@extends('layouts.main')

@section('title', 'Periodes')

@section('content')
    {!! form($form) !!}
@endsection

{{--
@extends('layouts.main')

@section('title', 'Periodes')

@section('content')
    {!! form($form) !!}
    <script>
        $('.start').each(function(i) {
            $('.start')[i].defaultValue = {!! json_encode($terms->toArray()) !!}[i]['start'].replace(/ /g, 'T');
        });

        $('.end').each(function(i) {
            $('.end')[i].defaultValue = {!! json_encode($terms->toArray()) !!}[i]['end'].replace(/ /g, 'T');
        });
    </script>
@endsection
--}}
