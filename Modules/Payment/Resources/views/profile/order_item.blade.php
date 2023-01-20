<table class="table mb-0 table-center table-nowrap">
    <thead>
        <tr>
            <th scope="col" class="border-bottom">عکس </th>
            <th scope="col" class="border-bottom">نام</th>
            <th scope="col" class="border-bottom">قیمت</th>
        </tr>
    </thead>
    @php
        $courses = $orderItem->courses;
    @endphp
    <tbody>
        @foreach ($courses as $coure)
            <tr>
                <th scope="row">{{ $coure->id }}</th>
                <td>{{ $coure->title }}</td>
                <td>{{ $coure->price }} هزار تومان </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- 
    FIXME display product order with coont
--}}
