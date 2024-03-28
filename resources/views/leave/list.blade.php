 <h1>Leave Records</h1>

  <a href="{{ route('leave.form') }}" class="btn btn-primary">Create Leave</a>
    <table>
        <thead>
            <tr>
                <th>Leave Type</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Number of Days</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveRecords as $leaveRecord)
                <tr>
                    <td>{{ $leaveRecord->leaveType }}</td>
                    <td>{{ $leaveRecord->fromdate }}</td>
                    <td>{{ $leaveRecord->todate }}</td>
                    <td>{{ $leaveRecord->numberofDays }}</td>
                    <td>{{ $leaveRecord->comment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>