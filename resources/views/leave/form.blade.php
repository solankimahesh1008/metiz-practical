<form method="post" action="{{ route('leave.submit') }}">
    @csrf
    <div>
    <input type="text" name="employee_code" placeholder="Employee Code" required>
    </div>
    <div>
     <input type="date" name="from_date" id="from_date" required>
    </div>
    <div>
        <input type="date" name="to_date" id="to_date" required>
    </div>
    <div>
    <select name="leave_type" required> 
        <option value="">-- Select Leave Type --</option>
        @foreach($leaveTypes as  $leaveType)
            <option value="{{ $leaveType->leaveType }}">{{ $leaveType->leaveType }}</option>
        @endforeach
    </select>   
</div>  
    <div>
    <textarea name="comments" rows="3" maxlength="300" required></textarea>
    </div>
    <button type="submit">Submit</button>
</form>
<script>
    var today = new Date().toISOString().split('T')[0];

    document.getElementById("from_date").setAttribute("min", today);

    document.getElementById("from_date").addEventListener("change", function() {
        document.getElementById("to_date").setAttribute("min", this.value);
    });
</script>