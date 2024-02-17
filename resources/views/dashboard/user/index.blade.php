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
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOM & PRENOM</th>
                                <th>COMPTE</th>
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
                                    <a href="#" data-ajax-popup="true" data-title="Edit User" data-size="lg" data-url="{{route('users.edit', $user->id)}}"
                                        class="btn btn-info btn-sm">Edit
                                    </a>

{{-- 
                                    <button type="button" class="btn btn-sm btn-neutral Num_batiment" data-toggle="modal" data-target="#batimentModal" data-id="{{$batiment->Num_Bat}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger delete_batiment" data-toggle="modal" data-target="#batimentModal" data-id="{{$batiment->Num_Bat}}">
                                        <i class="fa fa-trash"></i>
                                    </button> 

                                    <button type="button" class="btn btn-success btn-sm Num_batiment" data-toggle="modal"
                                        data-target="#editBatimentModal"  data-id="{{$batiment->Num_Bat}}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button> --}}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $batiments->links() }}                                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
