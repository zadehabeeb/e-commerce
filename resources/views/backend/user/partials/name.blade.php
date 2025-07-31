<div style="display: flex; flex-direction: row; gap: 10px;">
    @if ($row->avatar)
        <img src="{{ asset($row->avatar) }}" width="40" style="border-radius: 7px;">
        <p style="height:5px ; align-self:center">{{ $row->name }}</p>
    @else
        <span>{{ $row->name }}</span>
    @endif
</div>
