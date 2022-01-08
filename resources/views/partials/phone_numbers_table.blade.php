<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Country</th>
        <th scope="col">State</th>
        <th scope="col">Country code</th>
        <th scope="col">Phone num</th>
    </tr>
    </thead>
    <tbody>
        @foreach($numbers as $number)
            <tr>
                <td>{{$number->country_name}}</td>
                <td>{{$number->state}}</td>
                <td>{{$number->phone_country_code}}</td>
                <td>{{$number->pure_phone_number}}</td>
            </tr>
        @endforeach
    </tbody>
</table>