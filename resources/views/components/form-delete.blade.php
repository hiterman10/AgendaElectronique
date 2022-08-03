<form id="event_delete" method="POST" action="{{ url('/event/delete') }}">
    @csrf @method('DELETED')
    <input type="hidden" name="eventId" id="eventId"/>
</form>
