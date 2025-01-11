<table>
    <thead>
        <tr>
            <td colspan="11">@php echo $titulo @endphp</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Fecha</td>
            <td>Usuario</td>
            <td>Obra</td>
            <td>Equipo</td>
            <td>Item</td>
            <td>Horas</td>
            <td>Service</td>
            <td>Combustible</td>
            <td>Aceite</td>
            <td>Lubricante</td>
            <td>Obs.</td>
        </tr>
        @foreach ($partes as $p)
        <tr>
            <td>{{$p->fecha}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->nombre}}</td>
            <td>{{$p->codigo}}</td>
            <td>{{$p->item}}</td>
            <td>{{$p->horas}}</td>
            <td>@php echo $p->max - $p->control @endphp</td>
            <td>{{$p->combustible}}</td>
            <td>{{$p->aceite}}</td>
            <td>{{$p->lubricante}}</td>
            <td>{{$p->obs}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
