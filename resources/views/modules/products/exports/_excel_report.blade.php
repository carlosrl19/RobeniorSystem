<table>
    <thead>
        <tr class="text-center">
            <th></th>
        </tr>
    </thead>
    <tbody>
        <!-- Header text -->
        <tr style="border: 1px solid #000">
            <td></td>
            <td colspan="7"
                style="font-size: 16px; font-weight: bold; background-color: #fff; text-align: center; text-decoration: underline;">
                INVENTARIO ROBENIOR SYSTEM 01
            </td>
        </tr>

        <!-- Blank rows -->
        <tr>
            <td></td>
            <td colspan="7" style="background-color: #fff"></td>
        </tr>

        <!-- Header table -->
        <tr>
            <td style="height: 40px"></td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 100px;">
                CÓDIGO
            </td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 230px;">
                NOMBRE
            </td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 200px;">
                CATEGORIA
            </td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 170px;">
                NOMENCLATURA
            </td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 200px;">
                MARCA
            </td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 180px;">
                MODELO
            </td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 150px;">
                ESTADO
            </td>
            <td style="border: 1px solid #000; color: #ffffff; background-color: #D70654; font-size: 11px; font-weight: bold; text-align: center; width: 120px;">
                PRECIO
            </td>
        </tr>

        @foreach($inventories as $inventory)
        <tr>
            <td style="font-size: 10px;"></td>
            <td style="font-size: 10px;">{{ $inventory->product_code }}</td>
            <td style="font-size: 10px;">{{ $inventory->product_name }}</td>
            <td style="font-size: 10px;">{{ $inventory->category->category_name }}</td>
            <td style="font-size: 10px;">{{ $inventory->product_nomenclature }}</td>
            <td style="font-size: 10px;">{{ $inventory->product_brand }}</td>
            <td style="font-size: 10px;">{{ $inventory->product_model ? $inventory->product_model : '--' }}</td>
            @if($inventory->product_status == 0)
            <td style="background-color: red; color: #ffffff; font-size: 10px;">MALO</td>
            @elseif($inventory->product_status == 1)
            <td style="background-color: #9DC08B; color: #ffffff; font-size: 10px;">NUEVO</td>
            @elseif($inventory->product_status == 2)
            <td style="background-color: orange; color: #ffffff; font-size: 10px;">SEMINUEVO</td>
            @elseif($inventory->product_status == 3)
            <td style="background-color: darkgray; color: #ffffff; font-size: 10px;">USADO</td>
            @else
            <td style="background: #000000; color: white; font-size: 10px;">ERROR</td>
            @endif

            <td style="font-size: 10px;">{{ $inventory->product_price }}</td>
        </tr>
        @endforeach

        <tr></tr>
        <!-- Total Project Investment Row -->
        <tr>
            <td></td>
            <td colspan="7"
                style="color: #ffffff; background-color: #D70654; border-top: 1px solid #000; text-align: center; font-weight: bold; font-size: 10px;">
                TOTAL GENERAL
            </td>
            <td
                style="color: #ffffff; background-color: #D70654; border-top: 1px solid #000; text-align: center; font-weight: bold; font-size: 10px;">
                {{ $inventory_total_value }} <!-- Formateo a dos decimales -->
            </td>
        </tr>

    </tbody>
</table>