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
                        <div class="col-sm-12">
                            <form method="post">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" name="response" placeholder="Optional: Leave a comment"></textarea>
                                </div>
                                <div class="flex-sbtwn">
                                    <button type="submit" name="status" value="2" class="btn btn-raised btn-warning">Reject</button>
                                    <button type="submit" name="status" value="1" class="btn btn-raised btn-primary">Accept</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection