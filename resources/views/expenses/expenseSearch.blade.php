@foreach($expenses as $expense)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $expense->title }}</td>
        <td>{{ $expense->expenseType->title }}</td>
        <?php
        $date = new DateTime($expense->date);
        $expense_date = date_format($date, 'd-M-y');

        ?>
        <td>{{ $expense_date }}</td>
        <td>${{ $expense->amount }}</td>
        <td>{{ $expense->short_note }}</td>
        <td>{{ $expense->payment_type }}</td>
        <td>
            @if($expense->status == 1)
                <span class="label label-success">Paid</span>
            @else
                <span class="label label-warning">Hold</span>
            @endif
        </td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="text-primary-600"><a href="{{ route('expenses.edit',$expense->id) }}"><i class="icon-pencil7"></i></a></li>
                <li class="text-danger-600" id="{{ $expense->id }}"><a href="#" class="delete_expense"><i class="icon-trash"></i></a></li>
            </ul>
        </td>
    </tr>
@endforeach