@extends('layouts.admin.master')
@section('css')

@section('title')
    Select Create Batiment or Locaux
@stop
@endsection

@section('page-header')

@endsection

@section('content')
<div class="row">
    <div class="modal fade fixed" id="selectModalBatimentOrLocaux" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        Select Create Batiment or Locaux
                    </h5>
                </div>
                <div class="modal-body  h-100vh">
                    <div class="d-flex justify-content-between">
                        @if (auth()->user()->role == 'user_direction' ||
                                auth()->user()->role == 'user_sous_direction' ||
                                auth()->user()->role == 'user_consultation_direction')
                            <div class="col-sm-12 col-md-6">
                                <form action="{{ route('dashboard.batiments.create') }}" method="get">
                                    @csrf
                                    <input type="hidden" name="ilot_id" value="{{ $ilot->Num_ilot }}">
                                    <button type="submit" class="btn btn-md btn-primary ">Créer Batiment</button>
                                </form>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <form action="{{ route('dashboard.locaux.create') }}" method="get">
                                    @csrf
                                    <input type="hidden" name="batiment_id" value="{{ $batimentLoc->id }}">
                                    <button type="submit" class="btn btn-md btn-info">Créer Locau</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#selectModalBatimentOrLocaux').modal('show')
    });
</script>
@endsection
