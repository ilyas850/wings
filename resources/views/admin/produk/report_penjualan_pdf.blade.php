<style media="screen">
    table {
        border-collapse: collapse;
    }

    tr.b {
        line-height: 80px;
    }
</style>

<body>
    <table width="100%">
        <tr>
            <td>
                <center>
                    <h4><b>REPORT PENJUALAN</b></h4>
                </center>
            </td>
        </tr>
    </table>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th><span style="font-size:85%">No</span></th>
                <th><span style="font-size:85%">Transaction</span></th>
                <th><span style="font-size:85%">User</span></th>
                <th><span style="font-size:85%">Total</span></th>
                <th><span style="font-size:85%">Date</span></th>
                <th><span style="font-size:85%">Item</span></th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($data1 as $item)
                <tr>
                    <td style="font-size:85%">
                        <center>{{ $i++ }}</center>
                    </td>
                    <td style="font-size:85%">
                        <center>{{ $item->doc_code }} - {{ $item->doc_number }}</center>
                    </td>
                    <td style="font-size:85%">{{ $item->user }}</td>
                    <td style="font-size:85%">
                        <center>{{ __('Rp. ') }}
                            {{ number_format($item->total, 0, ',', '.') }}</center>
                    </td>
                    <td style="font-size:85%">
                        <center>
                            {{ \Carbon\Carbon::parse($item->date)->isoFormat('D MMMM Y', 'Do MMMM YYYY') }}

                        </center>
                    </td>
                    <td style="font-size:85%">
                        <center>
                            @foreach ($data2 as $dt)
                                @if ($item->doc_code == $dt->doc_code && $item->doc_number == $dt->doc_number)
                                    {{ $dt->product_name }} X {{ $dt->quantity }} <br>
                                @endif
                            @endforeach
                        </center>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
