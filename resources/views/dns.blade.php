<table class="table table-sm">
    <thead>
        <tr>
            <th scope="col">
                Type
            </th>
            <th scope="col">
                Value
            </th>
            <th scope="col">
                Name
            </th>
            <th scope="col">
                TTL
            </th>
        </tr>
    </thead>
    <tbody>
        @if ($ptrrecs[0]['response'] != 0)
            @foreach ($ptrrecs as $ptr)
                <tr data-toggle="tooltip" title="Answer from {{ $ptr['answer_from'] }}">
                    <td>
                        {{ $ptr['type'] }}
                    </td>
                    <td>
                        <a href="/dns/{{ $ptr['ptrdname'] }}">{{ $ptr['ptrdname'] }}</a>
                    </td>
                    <td>
                        {{ $ptr['name'] }}
                    </td>
                    <td>
                        {{ $ptr['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if ($nameservers[0]['response'] != 0)
            @foreach ($nameservers as $ns)
                <tr data-toggle="tooltip" title="Answer from {{ $ns['answer_from'] }}">
                    <td>
                        {{ $ns['type'] }}
                    </td>
                    <td>
                        <a href="/dns/{{ $ns['nsdname'] }}">{{ $ns['nsdname'] }}</a>
                    </td>
                    <td>
                        {{ $ns['name'] }}
                    </td>
                    <td>
                        {{ $ns['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if ($arecs != 0)
            @foreach ($arecs as $a)
                <tr data-toggle="tooltip" title="Answer from {{ $a['answer_from'] }}">
                    <td>
                        {{ $a['type'] }}
                    </td>
                    <td>
                        <a href="/ipwhois/{{ $a['address'] }}">{{ $a['address'] }}</a>
                    </td>
                    <td>
                        {{ $a['name'] }}
                    </td>
                    <td>
                        {{ $a['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif 
        @if ($aaaarecs != 0)
            @foreach ($aaaarecs as $a)
                <tr data-toggle="tooltip" title="Answer from {{ $a['answer_from'] }}">
                    <td>
                        {{ $a['type'] }}
                    </td>
                    <td>
                        <a href="/ipwhois/{{ $a['address'] }}">{{ $a['address'] }}</a>
                    </td>
                    <td>
                        {{ $a['name'] }}
                    </td>
                    <td>
                        {{ $a['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif 
        @if ($cnames != 0)
            @foreach ($cnames as $cname)
                <tr data-toggle="tooltip" title="Answer from {{ $cname['answer_from'] }}">
                    <td>
                        {{ $cname['type'] }}
                    </td>
                    <td>
                        <a href="/dns/{{ $cname['cname'] }}">{{ $cname['cname'] }}</a>
                    </td>
                    <td>
                        {{ $cname['name'] }}
                    </td>
                    <td>
                        {{ $cname['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if ($mxrecs[0]['response'] != 0)
            @foreach ($mxrecs as $mx)
                <tr data-toggle="tooltip" title="Answer from {{ $mx['answer_from'] }}">
                    <td>
                        {{ $mx['type'] }}{{ $mx['preference'] }} 
                    </td>
                    <td>
                        <a href="/dns/{{ $mx['exchange'] }}">{{ $mx['exchange'] }}</a>
                    </td>
                    <td>
                        {{ $mx['name'] }}
                    </td>
                    <td>
                        {{ $mx['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if ($txtrecs[0]['response'] != 0)
            @foreach ($txtrecs as $txt)
                <tr data-toggle="tooltip" title="Answer from {{ $txt['answer_from'] }}">
                    <td>
                        {{ $txt['type'] }} 
                    </td>
                    <td>
                        {{ $txt['rdata'] }}
                    </td>
                    <td>
                        {{ $txt['name'] }}
                    </td>
                    <td>
                        {{ $txt['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if ($spfrecs[0]['response'] != 0)
            @foreach ($spfrecs as $spf)
                <tr data-toggle="tooltip" title="Answer from {{ $spf['answer_from'] }}">
                    <td>
                        {{ $spf['type'] }} 
                    </td>
                    <td>
                        {{ $spf['rdata'] }}
                    </td>
                    <td>
                        {{ $spf['name'] }}
                    </td>
                    <td>
                        {{ $spf['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if ($srvrecs[0]['response'] != 0)
            @foreach ($srvrecs as $spf)
                <tr data-toggle="tooltip" title="Answer from {{ $srv['answer_from'] }}">
                    <td>
                        {{ $srv['type'] }} 
                    </td>
                    <td>
                        {{ $srv['rdata'] }}
                    </td>
                    <td>
                        {{ $srv['name'] }}
                    </td>
                    <td>
                        {{ $srv['ttl'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if ($soarecs[0]['response'] != 0)
            @foreach ($soarecs as $soa)
                <tr data-toggle="tooltip" title="Answer from {{ $soa['answer_from'] }}">
                    <td>
                        {{ $soa['type'] }} 
                    </td>
                    <td>
                        <b>Primary NS:</b> <a href="/dns/{{ $soa['mname'] }}">{{ $soa['mname'] }}</a><br/>
                        <b>Responsible party:</b> <a href="mailto:{{ $soa['rname'] }}">{{ $soa['rname'] }}</a>
                    </td>
                    <td>
                        {{ $soa['name'] }}
                    </td>
                    <td>
                        {{ $soa['ttl'] }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Serial
                    </th>
                    <th>
                        Refresh
                    </th>
                    <th>
                        Retry, Minimum
                    </th>
                    <th>
                        Expire
                    </th>
                </tr>
                <tr>
                    <td>
                        {{ $soa['serial'] }}
                    </td>
                    <td>
                        {{ $soa['refresh'] }}
                    </td>
                    <td>
                        {{ $soa['retry'] }}, {{ $soa['minimum'] }}
                    </td>
                    <td>
                        {{ $soa['expire'] }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
