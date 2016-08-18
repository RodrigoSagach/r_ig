@extends('layouts.admin')

@section('title', 'Adquirir Cota')

@section('breadcrumb')
    <li class="breadcrumb-link">
        <a href="{{ route('admin::finances::index') }}">Finanças</a>
    </li>
    <li class="breadcrumb-link">
        <a href="{{ route('admin.finance.quotas.index') }}">Cotas</a>
    </li>
    <li class="breadcrumb-current-item">Attach</li>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-icon glyphicon glyphicon-plus"></span>
                <span class="panel-title">Attach</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="{{ route('admin.finance.quotas.attach') }}" method="POST">
                        {!! csrf_field() !!}

                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <p class="form-control-static">{{ $client->email }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('howmuch') ? ' has-error' : '' }}">
                                <label for="howmuch">Quantidade</label>
                                <input type="text" id="howmuch" name="howmuch" class="form-control" placeholder="Quantas cotas" value="{{ old('howmuch') }}">
                            @if ($errors->has('howmuch'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('howmuch') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('quota') ? ' has-error' : '' }}">
                                <label for="quota">Cota</label>
                                <select id="quota" name="quota" class="form-control">
                                @foreach($quotas as $quota)
                                    <option value="{{ $quota->id }}">{{ $quota->text }} ({{ format_money($quota->amount) }})</option>
                                @endforeach
                                </select>
                            @if ($errors->has('quota'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quota') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-8 col-md-offset-2">
                            <button type="submit" class="form-control btn btn-success btn-block">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Attach
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection