<div class="container mx-auto mt-20 rounded border">
  <div class="mt-5">
    <div class="text-center font-extrabold text-2xl">
      Total Checkin
      <br>
      {{ count($checkIns) }}
    </div>
    <table class="w-full">
      <thead>
        <tr class="bg-gray-800 text-white">
          <td class="p-4">Name</td>
          <td class="p-4">Branch Name</td>
          <td class="p-4">Contact</td>
        </tr>
      </thead>
      <tbody>
        @foreach ($checkIns as $checkIn)
          <tr>
            <td class="p-4">{{ $checkIn->name }}</td>
            <td class="p-4">{{ $checkIn->address }}</td>
            <td class="p-4">{{ $checkIn->contact }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
