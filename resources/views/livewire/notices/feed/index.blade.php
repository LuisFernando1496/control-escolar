<div>
    @foreach ($notices as $notice)
    @include('livewire.notices.feed.card', 
    [
        "titulo" => $notice->title,
        "descripcion" => $notice->body,
        "date" => date('Y/m/d', strtotime($notice->created_at)),
        "uuid" => $notice->uuid,
        "type" => $notice->type
    ])    
    @endforeach
</div>
