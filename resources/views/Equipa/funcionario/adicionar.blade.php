@extends('layout')
@section('title','SGDRH - adicionar funcionario-Equipa')


@section('content')
    <div class="container">
        <h1>Detalhes da Equipa</h1>
        <p>Nome da Equipa: {{ $team->nome_equipa }}</p>
        <p>Descrição da Equipa: {{ $team->descricao }}</p>

        <h2>Adicionar Funcionario a equipa</h2>
        <form action="{{ route('funcionario.atribuir_equipa') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="employee_id">Selecione um funcionario:</label>
                <select class="form-control" id="employee_id" name="employee_id">
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->nome_completo.' '.$employee->sobrenome }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="team_id" id="team_id" value="{{ $team->idEquipa }}">
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>
@endsection
