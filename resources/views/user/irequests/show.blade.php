@extends('layouts.basic')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-12">
                            <img src="{{ url('/pictures', ['type' => 'irequests', 'id' => $request->id]) }}" style="width: 100%; height: auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection