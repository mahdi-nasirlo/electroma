<div class="table-responsive p-0 container bg-white shadow rounded">
    <table class="table mb-0 table-center">
        <thead class="bg-primary">
            <tr>
                <th scope="col" class="border-bottom text-white">نام دوره </th>
                <th scope="col" class="border-bottom text-white">شهریه</th>
                <th scope="col" class="border-bottom text-white">مدرس دوره</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $course->title }}</td>
                <td>
                    @if ($course->discountItem)
                        <del class="text-danger">{{ number_format($cours->price) }}</del>
                    @endif
                    {{ number_format($course->discounted_price) }} تومان
                </td>
                <td>{{ $course->user->name }}</td>
            </tr>
        </tbody>
    </table>
</div>
