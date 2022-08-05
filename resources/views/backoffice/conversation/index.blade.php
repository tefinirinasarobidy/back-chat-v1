@extends('backoffice.app')

@section('content')
<div class="mt-5">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <form action="{{route('conversation.resete')}}" method="POST">
        @csrf
        <button class="btn btn-primary">reset conversation</button>
    </form>
</div>
@endsection