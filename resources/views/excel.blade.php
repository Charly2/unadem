<style>
    .verde{
        background-color: #5cb85c;

    }
    .center{
        text-align: center;
    }

    tr td {

    }

    tr > td {

    }
</style>
<table>


    <tr>
        <td colspan="20" class="center">Reporte general de Evaluación de Desempeño Docente </td>
    </tr>
    <tr>
        <td class="verde"></td>
        <td class="verde"></td>
        <td class="verde"></td>
        <td class="verde"></td>
        <td>Planeación Didáctica</td>
    </tr>
    <tr>
        <td class="verde">Folio</td>
        <td class="verde">Apellido Paterno</td>
        <td class="verde">Apellido Materno</td>
        <td class="verde">Nombre(s)</td>
    </tr>
    @foreach($docente as $d)
    <tr>
        <td>{{$d->folio}}</td>
        <td>{{$d->apPaterno}}</td>
        <td>{{$d->apMaterno}}</td>
        <td>{{$d->nombres}}</td>

    </tr>
    @endforeach
</table>
