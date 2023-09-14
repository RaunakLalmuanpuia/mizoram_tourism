<div>
    @foreach ($informations as $information)
    @php
        $slug = strtolower($information->title);
        $slug = explode(' ',$slug);
        $slug = implode('-', $slug);
    @endphp
    <li class="mt-2 hover:cursor-pointer hover:text-tourism-green">
        <a href="{{ Route('getInformation', $slug) }}">{{ $information->title }}</a>
    </li>
    @endforeach
</div>
