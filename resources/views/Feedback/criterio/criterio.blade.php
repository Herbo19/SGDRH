@extends('layout')
@section('title','SGDRH - Criterio de avaliação')

@section('content')


<!-- Begin Page Content -->
<div class="row">
    <div class="col-sm-3">
        <form method="POST" action="{{ route('feedback.criterio.store') }}">
            @csrf

            @if(Session::has('msg'))
            <p class="text-success">{{session('msg')}}</p>
            @endif

            @if(Session::has('tipo-eliminado'))
            <p class="text-danger">{{session('tipo-eliminado')}}</p>
            @endif

            <div class="form-group">
                <label for="criterio">Criterio</label>
                <input type="text" name="criterio" id="titulo" class="form-control @error('criterio') is-invalid @enderror">
                <div>
                    @error('titulo')
                        <span class=""><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-info btn-block">Criar</button>
        </form>
        </div>


    <div class="col-sm-9">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Critérios de avaliação</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Criterio</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Criterio</th>
                                <th>Opções</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($criterios as $criterio)
                            <tr>
                                <td>{{ $criterio->idCriterio }}</td>
                                <td><a href="{{ route('criterio.editar',$criterio->idCriterio) }}">{{ $criterio->criterio }}</a></td>
                                <td>
                                    <a onclick="return confirm('Pretende eliminar estes dados?')" href="{{ route('criterio.eliminar',$criterio->idCriterio) }}"
                                    class="btn btn-danger btn-sm">Eliminar</a>

                                    <a href="{{ route('criterio.editar',$criterio->idCriterio) }}" class="btn btn-primary btn-sm">Atualizar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- End of Main Content -->


@endsection
