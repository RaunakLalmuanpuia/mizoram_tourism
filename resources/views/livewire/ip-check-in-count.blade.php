<div class="container md:w-1/4 mx-auto mt-20 rounded border">
  <div class="text-center">
    <div class="text-4xl bg-gray-800 text-white p-10">
      Number of Visitors
      <br>
      Checked In
    </div>
    <div class="text-9xl font-extrabold p-10">
      {{ $guestCount }}
    </div>
  </div>
  <div class="mt-5">
    {{-- <table class="w-full">
      <thead>
        <tr class="bg-gray-800 text-white">
          <td class="text-center p-4">IP Address</td>
        </tr>
      </thead>
      <tbody>
        @foreach ($guests as $guest)
          <tr>
            <td class="text-center p-4">{{ $guest->ip_address }}</td>
          </tr>
        @endforeach
      </tbody>
    </table> --}}
  </div>
</div>
