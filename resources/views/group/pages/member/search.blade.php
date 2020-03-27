<div id="kq">

    @if($response->isEmpty())
        <li style="color: red">No Result</li>
    @endif

    @foreach($response as $value)
        <li><a onclick="chose(this)"> {{ $value->email }}</a></li>
    @endforeach

    <script>
        function chose(obj) {
            $('#member').val(obj.text);
            $('#kq').remove();
        }
    </script>
</div>
