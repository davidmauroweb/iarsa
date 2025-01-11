<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Patente</th>
            <th>Potencia</th>
            <th>Resto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($eqs as $u)
        <tr>
            @php $resto = $u->max-$u->control;
            $por = $resto/$u->max @endphp
            <td>{{$u->codigo}}</td>
            <td>{{$u->tipo}}</td>
            <td>{{$u->marca}}</td>
            <td>{{$u->modelo}}</td>
            <td>{{$u->patente}}</td>
            <td>{{$u->potencia}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
