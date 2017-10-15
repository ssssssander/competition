@extends('layouts.main')

@section('title', 'Periodes')

@section('content')
    @if (session()->has('edit_terms_success'))
        <div class="alert alert-success alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          {{ session('edit_terms_success') }}
        </div>
    @endif
    {!! form($form) !!}
    <script>
        let datetimeStartElems = document.getElementsByClassName('start');
        let datetimeEndElems = document.getElementsByClassName('end');
        let termsStartDates = [];
        let termsEndDates = [];

        for(let i = 0; i < datetimeStartElems.length; i++) {
            termsStartDates.push({!! json_encode($terms->toArray()) !!}[i]['start']);
            datetimeStartElems[i].defaultValue = termsStartDates[i].replace(/ /g, 'T');
        }

        for(let i = 0; i < datetimeEndElems.length; i++) {
            termsEndDates.push({!! json_encode($terms->toArray()) !!}[i]['end']);
            datetimeEndElems[i].defaultValue = termsEndDates[i].replace(/ /g, 'T');
        }
    </script>
@endsection
