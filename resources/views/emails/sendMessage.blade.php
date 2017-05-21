<div>
    <p>
        Hello, {{ $advert->user->name }}. You have new message from Latvijas Portals service.
    </p>
    <p>
        From: {{ $request->name }}
    </p>
    <p>
        Message:
    </p>
    <p>
        {{ $request->message }}
    </p>
    <p>
        Your advert: <a href="{{ route('advert.show', $advert->id) }}">{{ route('advert.show', $advert->id) }}</a>
    </p>
    <p>
        Your wrote:
    </p>
    <p>
        {{ $advert->getText() }}
    </p>

</div>