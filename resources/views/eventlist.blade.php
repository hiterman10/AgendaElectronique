@if($events->isNotEmpty())
    <table id="displayevent" data-order='[[ 3, "desc" ]]' class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="97%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Creation Date</th>
                <th>Creator</th>
                <th>Participants</th>
                <th>Action</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($events as $event)
            @php
                $item=array();
                $item['ID']= $event->id;
                $item['NAME']= $event->name;
                $item['START_DATE']= $event->start_date;
                $item['END_DATE']= $event->end_date;
                $item['DESCRIPTION']= $event->description;
                $item['PARTICIPANTS']= $event->participants;
                $info_data = json_encode($item, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            @endphp
            <tr>
                <td>
                    <textarea style='display:none;' id='info_event{{ $loop->iteration }}' name=info_event{{ $loop->iteration }}'>{{ $info_data }}</textarea>
                    {{ $event->name }}
                </td>
                <td>{{ $event->start_date }}</td>
                <td>{{ $event->end_date }}</td>
                <td>{{ $event->created_at }}</td>
                <td>Author</td>
                <td>{{ $event->participants }}</td>
                <td>
                    <button class="text-gray-300 hover:text-gray-700 bg-indigo-500 rounded-full px-2 py-2" onclick="showDescription('{{ $loop->iteration }}')">Show description </button>
                </td>
                <td>
                    <button class="btn btn-warning" onclick="modifyEvent('{{ $loop->iteration }}')">Modify </button>
                    <button class="btn btn-danger" onclick="confifmationDeleteEvent('{{ $loop->iteration }}')"> Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
<div class="py-16">
    <div class="text-center">
      <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide"></p>
      <h1 class="mt-2 text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">No event for the moment 😕
        .</h1>
      <p class="mt-2 text-base text-gray-500">You can create a new event.</p>
    </div>
@endif

<script>
	setTimeout(function(){ $('#displayevent').DataTable(); }, 300);
</script>
