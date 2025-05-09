<?php
use Carbon\Carbon;

$contract = $departure->employee->contract_in_date($departure->departure);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PLATAFORMA VIRTUAL - MUSERPOL</title>
    <link rel="stylesheet" href='{{ public_path('/css/report-print.min.css') }}' media="all" />
    <style>
        body {
            border: 0;
            line-height: 2;
        }

        .noon {
            background-color: #c0c0c0;
            /* Color plomo claro */
            /* Otros estilos que desees aplicar */
        }
    </style>
</head>

<body>
    <!-- E N C A B E Z A D O   D O C U M E N T O -->
    <table class="w-100">
        <thead>
            <tr>
                <th class="w-50 text-left no-padding no-margins">
                    <div class="text-left">
                        <img src='{{ public_path('/img/logo.png') }}' class="w-30">
                    </div>
                </th>
                <th class="w-50 text-right no-paffing no-margins">
                    <div class="text-right">
                        <img src='{{ public_path('/img/escudo_bolivia.gif') }}' class="w-15">
                    </div>
                </th>
            </tr>
        </thead>
    </table>
    <hr width="100%"><!-- línea -->
    <!-- E N C A B E Z A D O   N O T A -->
    <div class="text-right">
        <div>
            {{ ucwords(mb_strtolower($contract->position->position_group->company_address->city->name)) }},
            {{ Carbon::parse($departure->created_at)->ISOFormat('LL') }}
        </div>
        <div>
            {{ $departure->cite }}
        </div>
    </div>
    <div class="text-left">
        <div>
            Señor:
        </div>
        <div>
            CNL. MSc. CAD. LUCIO ENRIQUE RENÉ JIMÉNEZ VARGAS
        </div>
        <div class="font-bold">
            DIRECTOR GENERAL EJECUTIVO<br>
            MUSERPOL
        </div>
        <div class="underline font-bold">
            Presente.-
        </div>
    </div>
    <!-- C U E R P O   N O T A -->
    <div class="py-15">
        <div class="text-right font-bold uppercase">
            REF.: SOLICITUD DE PERMISO POR VACACIONES
        </div>
    </div>

    <div class="text-left">
        <div class="py-15">
            De mi mayor consideración:
        </div>
        <div class="text-justify">
            <span>
                Por la presente, yo, <b>{{ $departure->employee->fullName() }}</b>, desempeñando el cargo de <b>{{ $contract->position->name }}</b>
                en el área de <b>{{ $contract->position->position_group->name }}</b>, me dirijo respetuosamente a su Autoridad con el propósito de 
                solicitar un PERMISO A CUENTA DE VACACIONES. Es importante destacar que esta solicitud cuenta con la autorización de mi Inmediato 
                Superior y Superior Jerárquico. He tomado las medidas necesarias para garantizar la continuidad de las actividades laborales 
                correspondientes a mi área.
            </span>
            </span>
        </div>
    </div>
    <div class="text-center">PERÍODO SOLICITADO</div>

    <table class="table-info w-100 m-b-10 text-center uppercase">
        <tr class="bg-grey-darker text-xs text-white">
            <td class="w-50">Desde</td>
            <td class="w-50">Hasta</td>
        </tr>
        <tr class="text-sm">
            <td class="w-50 py-5">
                <span>{{ Carbon::parse($departure->departure)->format('d/m/Y') }}</span>
                <span>&nbsp;</span>
                <span>{{ Carbon::parse($departure->departure)->format('H:i') }}</span>
            </td>
            <td class="w-50 py-5">
                <span>{{ Carbon::parse($departure->return)->format('d/m/Y') }}</span>
                <span>&nbsp;</span>
                <span>{{ Carbon::parse($departure->return)->format('H:i') }}</span>
            </td>
        </tr>
    </table>
    <br>
    {{-- listado de dias --}}
    <table class="table-info w-100 m-b-10 text-center uppercase">
        <tr>
            @foreach ($departure->days_on_vacation->sortBy('date') as $index => $vacation)
                @if ($index > 0 && $index % 4 == 0)
        </tr>
        <tr>
            @endif
            <td class="bg-grey-darker text-xs text-white">{{ Carbon::parse($vacation->date)->isoFormat('dddd') }}</td>
            @if ($vacation->day < 1)
                <td class="noon">M</td>
                <td class="noon">{{ Carbon::parse($vacation->date)->format('d/m/Y') }}</td>
            @else
                <td colspan="2">{{ Carbon::parse($vacation->date)->format('d/m/Y') }}</td>
            @endif
            @endforeach
        </tr>
    </table>
    {{-- sección de firmas --}}
    <br><br><br>
    <table class="w-100">
        <thead>
            <tr>
                <td class="w-50 text-center">
                    <hr width="300">Jefe Inmediato Superior
                </td>
                <td class="w-50 text-center">
                    <hr width="300">Superior Jerárquico
                </td>
            </tr>
            <tr>
                <td colspan="2" class="w-100 text-center">
                    <br><br>
                    <hr width="300">Solicitante
                </td>
            </tr>
        </thead>
    </table>
</body>

</html>
