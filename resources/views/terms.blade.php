@extends('layouts.main')

@section('title', 'Periodes')

@section('content')
    @if (session()->has('edit_terms_success'))
        <div class="alert alert-success">{!! session('edit_terms_success') !!}</div>
    @endif
    {!! form($form) !!}
    <script>
        let terms = {!! json_encode($terms->toArray()) !!};
        let datetimeElems = document.querySelectorAll('.form-group > label + input.form-control');
        let datetimeElemsLen = datetimeElems.length;

        let dateTImeElemsIndex = 0;

        for(let i = 0; i < datetimeElemsLen / 2; i++) {
            datetimeElems[dateTImeElemsIndex].defaultValue = terms[i]['start'].replace(/ /g, 'T');
            dateTImeElemsIndex += 2;
        }

        dateTImeElemsIndex = 1;

        for(let i = 0; i < datetimeElemsLen / 2; i++) {
            datetimeElems[dateTImeElemsIndex].defaultValue = terms[i]['end'].replace(/ /g, 'T');
            dateTImeElemsIndex += 2;
        }
    </script>
@endsection
