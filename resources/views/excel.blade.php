<style>
    .verde{
        background-color: #5cb85c;

    }
    .naranja{
        background-color: #b87b00;

    }
    .azul{
        background-color: #00a6e2;

    }
    .center{
        text-align: center;
    }

    tr td {
        border: 1px solid red;
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
        @foreach($criterios as $c )
            <td class="azul" colspan="{{sizeof($c['items'])}}">{{$c['titulo']}}</td>
        @endforeach

        <td class="naranja"></td>
        <td class="naranja"></td>
        <td class="naranja"></td>
    </tr>
    <tr>
        <td class="verde">Folio</td>
        <td class="verde">Apellido Paterno</td>
        <td class="verde">Apellido Materno</td>
        <td class="verde">Nombre(s)</td>
        @foreach($criterios as $c )
            @foreach($c['items'] as $cc )
                <td class="azul" >{{$cc}}</td>
            @endforeach
        @endforeach
        <td class="naranja">Observaciones generales</td>
        <td class="naranja">Comentarios</td>
        <td class="naranja">Calificación final</td>
    </tr>
    @foreach($docente as $d)
    <tr>
        <td>{{$d['evalucion']->folio}}</td>
        <td>{{$d['evalucion']->apPaterno}}</td>
        <td>{{$d['evalucion']->apMaterno}}</td>
        <td>{{$d['evalucion']->nombres}}</td>

        @foreach($d['calificaciones'] as $dd)
            <td>{{$dd}}</td>
        @endforeach

        <td>
        @foreach($d['obs'] as $dd)
            {{$dd->observacion}}
        @endforeach
        </td>
        <td>
            {{$d['evalucion']->comentario}}
        </td>
        <td>
            {{$d['evalucion']->calificacion}}
        </td>
    </tr>
    @endforeach
</table>
