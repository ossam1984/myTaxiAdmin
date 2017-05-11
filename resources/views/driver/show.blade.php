@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h2>Driver info</h2>
                <div class="panel panel-default">
                    <div class="panel-heading">Basic Info</div>
                    <div class="panel-body">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="name">Full name:</label>
                                <span id="name">{{ $driver->name }}</span><br>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <span id="email">{{ $driver->user->email ?? " - "}}</span><br>
                            </div>

                            <div class="form-group">
                                <label for="created_at">Creation date:</label>
                                <span id="created_at">{{ $driver->user->created_at ?? " - "}}</span><br>
                            </div>
                            <div class="form-group">
                                <label for="driver_licence_no">Licence Number:</label>
                                <span id="driver_licence_no">{{ $driver->driver_licence_no ?? " - "}}</span><br>
                            </div>
                        </div>
                        <div class="col-xs-6 ">
                            <img src="{{ $driver->image }}" alt="profile pic" class="img-responsive"><br>

                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <span id="phone">{{ $driver->user->phone ?? " - "}}</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Technical Info</div>
                    <div class="panel-body">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="dev_id">Device ID:</label>
                                <span id="dev_id">{{ $driver->user->dev_id ?? " - "}}</span>
                            </div>
                            <div class="form-group">
                                <label for="dev_token">Device Token:</label>
                                <span id="dev_token">{{ $driver->user->dev_token ?? " - "}}</span>
                            </div>

                        </div>
                        <div class="col-xs-6">

                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">More Data</div>
                    <div class="panel-body">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="dev_id">Total rides:</label>
                                <span id="dev_id">{{ $driver->user->dev_id ?? " - "}}</span>
                            </div>
                            <div class="form-group">
                                <label for="dev_token">Total Kilometers:</label>
                                <span id="dev_token">{{ $driver->user->dev_token ?? " - "}}</span>
                            </div>

                        </div>
                        <div class="col-xs-6">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
