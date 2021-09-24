<section class="text-center">
    <h1>Result</h1>
    <h3>Thanks {{Auth::user()->name}} for attempt {{$quiz_result->quiz->name}}</h3>
    <br>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th class="w-50">Total Attampt</th>
                <td class="w-50">{{$quiz_result->total_attempt}}</td>
            </tr>
            <tr>
                <th>Total Right</th>
                <td>{{$quiz_result->total_right}}</td>
            </tr>
            <tr>
                <th>Total Wrong</th>
                <td>{{$quiz_result->total_wrong}}</tr>
            </tr>
            <tr>
                <th>Result</th>
                <td>{{ (($quiz_result->is_pass) ? 'Pass' : 'Fail')}}</tr>
            </tr>
        </tbody>
    </table>
    <div class="text-center"><a href="{{route('user-dashboard')}}"><button class="btn btn-info">Home</button></a></div>
</section>