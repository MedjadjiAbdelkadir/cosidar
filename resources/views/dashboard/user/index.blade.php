@extends('layouts.admin.master')
@section('css')

@section('title')
LISTE DES UTILISATEURS
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @include('dashboard.user.create')
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button"class="button x-small"  data-toggle="modal" data-target="#createUserModal">
                    Create User
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOM & PRENOM</th>
                                <th>COMPTE</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ ucfirst($user->name) }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button type="button" class="btn @if($user->user_status == 1) btn-success @else btn-danger @endif btn-sm" data-toggle="modal" data-target="#changeStatusUserModal{{ $user->id }}">
                                        @if($user->user_status == 1)
                                        Active
                                        @else
                                        Deactive
                                        @endif
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    {{-- <button type="button"  class="btn btn-info btn-sm" data-toggle="modal" data-target="#showUserModal{{ $user->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button> --}}
                                </td>
                            </tr>
                            @include('dashboard.user.edit')
                            {{-- @include('dashboard.user.show') --}}
                            @include('dashboard.user.delete')
                            @include('dashboard.user.changeStatus')
                            @endforeach

                        </tbody>
                    </table>
                    {{ $users->links() }}                                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
